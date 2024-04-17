<?php

namespace App\Http\Controllers\cashier\order;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Table;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //lista de las ordenes en estado 'PEDIDO'
    public function index()
    {
        return view('cashier.order.index');
    }


    //traendo los pedidos con AJAX para poder cobrarlos
    public function fetchOrders()
    {
        $orders = Order::with(['orderDishes'])->where('state', 'PEDIDO')->latest()->get();

        $data = view('cashier.order.all-orders', [
            'orders' => $orders
        ])->render();

        return response()->json([
            'code' => 1,
            'result' => $data
        ]);
    }

    //vista donde sale el cliente y los pedidos para poder cobrar
    public function list(Order $order)
    {
        $totalAmount = 0;
        $totalAmount = $order->orderDishes->sum(function ($detail) {
            return $detail->quantity * $detail->dish->price;
        });

        return view('cashier.list.index', [
            'order' => $order,
            'totalAmount' => $totalAmount,
        ]);
    }

    //para guardar el cobro si es factura o pedido de mesa
    public function pay(Order $order, Request $request)
    {
        $totalAmount = 0;
        $totalAmount = $order->orderDishes->sum(function ($detail) {
            return $detail->quantity * $detail->dish->price;
        });

        if ($request->is_factura == '1') {
            //guardar al cliente 
            $customer = Customer::create([
                'name' => $request->client_name,
                'identity' => $request->client_id
            ]);

            //actualizamos la orden con el id del cliente
            if ($customer) {
                $save =  $order->update([
                    'state' => 'COBRADO',
                    'customer_id' => $customer->id
                ]);

                if ($save) {
                    $payment = Transaction::create([
                        'amount' => $totalAmount,
                        'payment_method' => $request->payment_method,
                        'type_receipt' => 'FACTURA',
                        'payment_date' => date('Y-m-d'),
                        'payment_time' => date('H:i:s'),
                        'order_id' => $order->id,
                        'user_id' => auth()->user()->id
                    ]);

                    if ($payment) {
                        $order->update(['state' => 'COBRADO']);
                        $tables = Table::find($order->table_id);
                        $tables->update(['state' => 'ACTIVO']);
                        return redirect()->route('cashier.pay.index')->with('message', 'pago procesado correctamente');
                    } else {
                        return redirect()->route('cashier.pay.index')->with('message', 'pago no procesado');
                    }
                }
            }
        } else {
            $payment = Transaction::create([
                'amount' => $totalAmount,
                'payment_method' => $request->payment_method,
                'type_receipt' => $request->type_receipt,
                'payment_date' => date('Y-m-d'),
                'payment_time' => date('H:i:s'),
                'order_id' => $order->id,
                'user_id' => auth()->user()->id
            ]);

            if ($payment) {
                $order->update(['state' => 'COBRADO']);
                $tables = Table::find($order->table_id);
                $tables->update(['state' => 'ACTIVO']);
                return redirect()->route('cashier.pay.boleta')->with('message', 'pago procesado correctamente');
            } else {
                return redirect()->route('cashier.pay.boleta')->with('message', 'pago no procesado');
            }
        }
    }
}
