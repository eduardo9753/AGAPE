<?php

namespace App\Http\Controllers\ticket\ticket;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\View;

class TicketController extends Controller
{
    //generacion de pdf con descarga automatica
    /*public function generatePdf($id)
    {
        // Obtener los datos que quieres pasar a la vista
        $order = Order::find($id);
        $totalAmount = $order->orderDishes->sum(function ($detail) {
            return $detail->quantity * $detail->dish->price;
        });

        // Renderizar la vista Blade con los datos
        $pdf = $this->renderPdf('ticket.pdf.ticket', ['order' => $order, 'totalAmount' => $totalAmount]);

        // Generar el PDF y devolver la respuesta
        return $pdf->stream('boleta.pdf');
    }*/

    /*protected function renderPdf($view, $data)
    {
        // Crear una nueva instancia de Dompdf
        $dompdf = new Dompdf();

        // Renderizar la vista Blade como HTML
        $html = View::make($view, $data)->render();

        // Cargar el HTML en Dompdf
        $dompdf->loadHtml($html);

        // (Opcional) Configurar opciones de Dompdf, como tamaño de página, orientación, etc.
        //$dompdf->setPaper([0, 0, 150, 1000], 'portrait');        
        $dompdf->setPaper([0, 0, 150, 500], 'portrait');

        // Renderizar el PDF
        $dompdf->render();

        // Devolver el objeto Dompdf
        return $dompdf;
    }*/

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
