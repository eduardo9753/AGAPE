<?php

namespace App\Http\Controllers\admin\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Models\Transaction;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //MENU PRINCIPAL DE DEL ADMIN
    public function index()
    {
        $users = User::all();
        $tables = Table::all();

        $ordersCount = DB::table('orders')
            ->whereIn('state', ['COBRADO', 'OCULTO'])
            ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
            ->count();

        $transactiopnCount = DB::table('transactions')
            ->whereDate('created_at', Carbon::today())
            ->count();

        $transactionsAmount = DB::table('transactions')
            ->whereDate('created_at', Carbon::today())
            ->sum('amount');

        return view('admin.dashboard.index', [
            'users' => $users,
            'tables' => $tables,
            'ordersCount' => $ordersCount,
            'transactiopnCount' => $transactiopnCount,
            'transactionsAmount' => $transactionsAmount
        ]);
    }

    public function reportePdf(Request $request)
    {
        $totalAmount = Transaction::whereBetween('payment_date', [$request->fecha_inicio, $request->fecha_final])
            ->sum('amount');

        $totalOrders = Transaction::whereBetween('payment_date', [$request->fecha_inicio, $request->fecha_final])
            ->distinct('order_id')
            ->count('order_id');

        $totalYAPEOrders = Transaction::whereBetween('payment_date', [$request->fecha_inicio, $request->fecha_final])
            ->where('payment_method', 'YAPE')
            ->sum('amount');

        $totalEFECTIVOrders = Transaction::whereBetween('payment_date', [$request->fecha_inicio, $request->fecha_final])
            ->where('payment_method', 'EFECTIVO')
            ->sum('amount');

        $totalTARJETAOrders = Transaction::whereBetween('payment_date', [$request->fecha_inicio, $request->fecha_final])
            ->where('payment_method', 'TARJETA')
            ->sum('amount');

        $pdf = PDF::loadView('ticket.pdf.reporte', [
            'totalAmount' => $totalAmount,
            'totalOrders' => $totalOrders,
            'request' =>  $request,
            'totalYAPEOrders' => $totalYAPEOrders,
            'totalEFECTIVOrders' => $totalEFECTIVOrders,
            'totalTARJETAOrders' => $totalTARJETAOrders
        ]);

        return $pdf->stream('reportes.pdf');
    }
}
