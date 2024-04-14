<?php

namespace App\Http\Controllers\cashier\transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TransactionController extends Controller
{
    //lista de las ordenes pagadas
    public function index()
    {
        //faltaria agregar la fecha de hoy la hora
        $pays = Transaction::with('order')->latest()->get();
        return view('cashier.transaction.index', [
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
}
