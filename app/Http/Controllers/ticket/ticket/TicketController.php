<?php

namespace App\Http\Controllers\ticket\ticket;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class TicketController extends Controller
{
    //PRECUENTA
    public function generatePdf($id)
    {
        // Cargar la vista y renderizarla como una cadena de texto
        $order = Order::find($id);
        $totalAmount = $order->orderDishes->sum(function ($detail) {
            return $detail->quantity * $detail->dish->price;
        });
        $pdf = PDF::loadView('ticket.pdf.orden', [
            'order' => $order,
            'totalAmount' => $totalAmount
        ]);
        $pdfContent = $pdf->output();

        // Devolver la cadena de texto como respuesta
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf');
    }

    //COMANDA
    public function generatePdfComanda($id)
    {
        // Cargar la orden
        $order = Order::find($id);

        // Filtrar los platos según su estado
        $dishes = $order->orderDishes->where('state', 'NUEVO');

        // Calcular el total solo con los platos filtrados
        $totalAmount = $dishes->sum(function ($detail) {
            return $detail->quantity * $detail->dish->price;
        });

        // Si hay platos con estado "NUEVO", generar el PDF solo con esos platos
        if ($dishes->isNotEmpty()) {
            $pdf = PDF::loadView('ticket.pdf.comanda', [
                'order' => $order,
                'dishes' => $dishes,
                'totalAmount' => $totalAmount
            ]);
        } else {
            // Si no hay platos con estado "NUEVO", generar el PDF con los platos con estado "PEDIDO"
            $dishes = $order->orderDishes->where('state', 'PEDIDO');
            $totalAmount = $dishes->sum(function ($detail) {
                return $detail->quantity * $detail->dish->price;
            });

            $pdf = PDF::loadView('ticket.pdf.comanda', [
                'order' => $order,
                'dishes' => $dishes,
                'totalAmount' => $totalAmount
            ]);
        }

        // Obtener el contenido del PDF como una cadena de texto
        $pdfContent = $pdf->output();

        // Devolver la cadena de texto como respuesta
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf');
    }
}
