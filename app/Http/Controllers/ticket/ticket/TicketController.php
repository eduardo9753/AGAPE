<?php

namespace App\Http\Controllers\ticket\ticket;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class TicketController extends Controller
{
    public function generatePdf($id)
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
    }

    protected function renderPdf($view, $data)
    {
        // Crear una nueva instancia de Dompdf
        $dompdf = new Dompdf();

        // Renderizar la vista Blade como HTML
        $html = View::make($view, $data)->render();

        // Cargar el HTML en Dompdf
        $dompdf->loadHtml($html);

        // (Opcional) Configurar opciones de Dompdf, como tamaño de página, orientación, etc.
        $dompdf->setPaper([0, 0, 150, 540], 'portrait');

        // Renderizar el PDF
        $dompdf->render();

        // Devolver el objeto Dompdf
        return $dompdf;
    }
}
