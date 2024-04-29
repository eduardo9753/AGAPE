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
    public function index(Table $table)
    {
        if($table->state == 'INACTIVO'){
            return redirect()->route('waitress.table.index');
        }
        return view('waitress.order.index', [
            'table' => $table
        ]);
    }

    //lista de ordenes de la cajera
    public function list()
    {
        return view('waitress.order.list');
    }

    //traendo los pedidos con AJAX para poder cobrarlos
    public function fetchOrders()
    {
        $orders = Order::with(['orderDishes'])->where('state', 'PEDIDO')->where('user_id', auth()->user()->id)->latest()->get();

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
            return redirect()->route('waitress.table.index')->with('mensaje', '¡La orden se ha eliminado correctamente!');
        } else {
            return redirect()->route('waitress.table.index')->with('mensaje', '¡Orden no eliminada!');
        }
    }

    //para actualizar la mesa e imprimir el ticket
    public function update(Request $request)
    {
        $update = Table::find($request->table_id);
        $save = $update->update(['state' => 'PRECUENTA']);
        if ($save) {
            return response()->json([
                'code' => 1,
                'msg' => 'MESA CON PRECUENTA ACTIVADA'
            ]);
        }
    }
}
