<?php

namespace App\Http\Controllers\waitress\order;

use App\Http\Controllers\Controller;
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
    public function index(Table $table)
    {
        if ($table->state == 'INACTIVO') {
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
        //si orden de la mesa esta cobrada la liberamos y volvemos a la lista de mesas
        $order = Order::find($order->id);
        if ($order->state == 'OCULTO' || $order->state == 'COBRADO') {
            $update = Table::find($order->table_id);
            $save = $update->update(['state' => 'ACTIVO']);

            if ($save) {
                return redirect()->route('waitress.table.index');
            }
        } else {
            //de lo contrario vemos la lista de pedidos
            $table = Table::find($order->table_id);
            $tables = Table::where('state', 'ACTIVO')->get();
            return view('waitress.order.show', [
                'order' => $order,
                'table' => $table,
                'tables' => $tables
            ]);
        }
    }

    //para cambiar de mesa 
    public function tableChange(Request $request)
    {
        //dd($request);

        $table = Table::find($request->table_id);
        $save = $table->update(['state' => 'ACTIVO']);

        if ($save) {
            $order = Order::find($request->order_id);
            $update = $order->update(['table_id' => $request->table_change_id]);

            if ($update) {
                $change = Table::find($request->table_change_id);
                $save = $change->update(['state' => 'INACTIVO']);
                if ($save) {
                    return redirect()->route('waitress.table.index');
                } else {
                    return redirect()->route('waitress.table.index');
                }
            }
        }
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
