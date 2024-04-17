<?php

namespace App\Http\Controllers\cashier\transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TransactionController extends Controller
{
    //lista de las ordenes pagadas tipo FACTURA
    public function index()
    {
        $pays = Transaction::with('order')
            ->whereHas('order', function ($query) {
                $query->whereNotNull('customer_id');
            })
            ->latest()
            ->get();
        return view('cashier.transaction.index', [
            'pays' => $pays
        ]);
    }

    //lista de las ordenes pagadas tipo boleta
    public function boleta()
    {
        $pays = Transaction::with('order')->latest()->get();
        return view('cashier.transaction.boleta', [
            'pays' => $pays
        ]);
    }


    //PDF DE LA FACTURA
    public function pdf(Transaction $pay)
    {
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
