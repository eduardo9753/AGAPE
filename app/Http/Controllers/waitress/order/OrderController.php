<?php

namespace App\Http\Controllers\waitress\order;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Table;
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
        $orders = Order::with(['customer', 'orderDishes'])->where('state', 'PEDIDO')->latest()->get();

        $data = view('waitress.order.all-orders', [
            'orders' => $orders
        ])->render();

        return response()->json([
            'code' => 1,
            'result' => $data
        ]);
    }

    //para poder modificar el pedido del cliente
    public function show(Order $order)
    {
        return view('waitress.order.show');
    }

    //para eliminar una orden 
    public function delete(Order $order)
    {
        $table = Table::find($order->table_id);
        $table->update(['state' => 'ACTIVO']);
        $customer = Customer::find($order->customer_id);
        if ($customer->delete()) {
            return redirect()->route('waitress.order.list')->with('mensaje', '¡La orden se ha eliminado correctamente!');
        } else {
            return redirect()->route('waitress.order.list')->with('mensaje', '¡Orden no eliminada!');
        }
    }
}
