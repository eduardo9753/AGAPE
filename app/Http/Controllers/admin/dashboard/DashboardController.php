<?php

namespace App\Http\Controllers\admin\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Models\User;
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
}
