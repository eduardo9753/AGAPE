<?php

namespace App\Http\Controllers\delivery;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class DeliberyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //plantilla livewire para los deliberys que se puede integrar tanto en  caja como en mesera
    public function deliberyCashier()
    {
        return view('cashier.delivery.index');
    }

    //metodo en donde se cargara los pedidos de los deliverys
    public function orderdeliberyCashier()
    {
        return view('cashier.delivery.orders');
    }

    //metodo fectch de las ordenes con deliverys 
    public function fetchOrdersDelivery()
    {
        $orders = Order::with(['orderDishes'])->where('state', 'PEDIDO')->where('type', 'DELIBERY')->latest()->get();

        $data = view('cashier.delivery.all-orders', [
            'orders' => $orders
        ])->render();

        return response()->json([
            'code' => 1,
            'result' => $data
        ]);
    }

    //para eliminar una orden 
    public function delete(Order $order)
    {
        $table = Table::find($order->table_id);
        $table->update(['state' => 'ACTIVO']);

        if ($order->delete()) {
            return redirect()->route('cashier.delibery.order')->with('mensaje', '¡La orden se ha eliminado correctamente!');
        } else {
            return redirect()->route('cashier.delibery.order')->with('mensaje', '¡Orden no eliminada!');
        }
    }
}
