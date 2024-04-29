<?php

namespace App\Http\Controllers\cashier\transaction;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Table;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TransactionController extends Controller
{
    //lista de las ordenes pagadas tipo FACTURA
    public function index()
    {
        $today = Carbon::today();

        $pays = Transaction::with('order')
            ->where('type_receipt', 'FACTURA')
            ->whereHas('order', function ($query) {
                $query->whereNotNull('customer_id');
                $query->where('state', 'COBRADO'); // Filtrar por estado 'COBRADO'
            })
            ->whereDate('payment_date', $today)
            ->latest()
            ->get();
        return view('cashier.transaction.index', [
            'pays' => $pays
        ]);
    }

    //lista de las ordenes pagadas tipo boleta
    public function boleta()
    {
        $today = Carbon::today();
        $pays = Transaction::with('order')
            ->where('type_receipt', 'BOLETA')
            ->whereHas('order', function ($query) {
                $query->where('state', 'COBRADO');
            })
            ->whereDate('payment_date', $today)
            ->latest()
            ->get();
        return view('cashier.transaction.boleta', [
            'pays' => $pays
        ]);
    }


    //PDF DE LA FACTURA
    public function pdf(Transaction $pay)
    {
        $order_id = $pay->order_id;
        $order = Order::find($order_id);
        $order->update(['state' => 'OCULTO']);

        $table = Table::find($order->table_id);
        $table->update(['state' => 'ACTIVO']);

        // Cargar la vista y renderizarla como una cadena de texto
        $totalAmount = 0;
        $totalAmount = $pay->order->orderDishes->sum(function ($detail) {
            return $detail->quantity * $detail->dish->price;
        });
        $pdf = PDF::loadView('cashier.pdf.factura', [
            'pay' => $pay,
            'totalAmount' => $totalAmount
        ]);
        $pdfContent = $pdf->output();

        // Devolver la cadena de texto como respuesta
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf');
    }

    //PDF BOLETA
    public function pdfBoleta(Transaction $pay)
    {
        $order_id = $pay->order_id;
        $order = Order::find($order_id);
        $order->update(['state' => 'OCULTO']);

        $table = Table::find($order->table_id);
        $table->update(['state' => 'ACTIVO']);

        // Cargar la vista y renderizarla como una cadena de texto
        $totalAmount = 0;
        $totalAmount = $pay->order->orderDishes->sum(function ($detail) {
            return $detail->quantity * $detail->dish->price;
        });
        $pdf = PDF::loadView('cashier.pdf.boleta', [
            'pay' => $pay,
            'totalAmount' => $totalAmount
        ]);
        $pdfContent = $pdf->output();

        // Devolver la cadena de texto como respuesta
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf');
    }
}
