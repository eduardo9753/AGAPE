<?php

namespace App\Http\Controllers\waitress\order;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Client\ConnectionException as ClientConnectionException;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\Exception\ConnectionException;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //PARA TOMAR LA ORDEN DEL CLIENTE
    public function index()
    {
        return view('waitress.order.index');
    }

    //lista de ordenes de la cajera
    public function list()
    {
        return view('waitress.order.list');
    }

    //traendo los pedidos con AJAX para poder cobrarlos
    public function fetchOrders()
    {
        $orders = Order::with(['orderDishes'])->where('state', 'PEDIDO')->latest()->get();

        $data = view('waitress.order.all-orders', [
            'orders' => $orders
        ])->render();

        return response()->json([
            'code' => 1,
            'result' => $data
        ]);
    }

    //para poder modificar el pedido del cliente "agregar mas platos"
    public function show(Order $order)
    {
        //dd($order);
        return view('waitress.order.show', [
            'order' => $order
        ]);
    }

    //para eliminar una orden 
    public function delete(Order $order)
    {
        $table = Table::find($order->table_id);
        $table->update(['state' => 'ACTIVO']);

        if ($order->delete()) {
            return redirect()->route('waitress.order.list')->with('mensaje', '¡La orden se ha eliminado correctamente!');
        } else {
            return redirect()->route('waitress.order.list')->with('mensaje', '¡Orden no eliminada!');
        }
    }

    //imprimir los datos de manera directa
    public function print(Order $order)
    {
        try {
            $table = Table::find($order->table_id);
            $table->update(['state' => 'PRECUENTA']);

            // Conecta a la impresora
            $printerName = "CUENTA";
            $connector = new WindowsPrintConnector($printerName);
            $printer = new Printer($connector);

            // Comandos de impresión
            $printer->text("Mesa: " . $table->name . "\n");
            $printer->text("---- Orden ----\n");

            // Itera sobre los platos de la orden y agrega la información al ticket
            foreach ($order->orderDishes as $detail) {
                $printer->text($detail->dish->name . " x" . $detail->quantity . " $" . $detail->dish->price * $detail->quantity . "\n");
            }

            // Calcula el monto total a pagar
            $totalAmount = $order->orderDishes->sum(function ($detail) {
                return $detail->quantity * $detail->dish->price;
            });

            $printer->text("Total: $" . $totalAmount . "\n");
            $printer->cut();

            // Cierra la conexión
            $printer->close();

            // Redirecciona de vuelta a la página anterior
            return back()->with('mensaje', 'Impresión enviada a la impresora.');
        } catch (ClientConnectionException $e) {
            // Captura la excepción de conexión
            return "Error: No se pudo conectar a la impresora. Verifica que la impresora esté disponible y la ruta sea correcta.";
        } catch (\Exception $e) {
            // Captura cualquier otra excepción
            return "Error: " . $e->getMessage();
        }
    }
}
