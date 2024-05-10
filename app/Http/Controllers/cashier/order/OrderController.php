<?php

namespace App\Http\Controllers\cashier\order;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Client\ConnectionException as ClientConnectionException;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\Exception\ConnectionException;
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
        $order = Order::find($order->id);
        $totalAmount = 0;
        $totalAmount = $order->orderDishes->sum(function ($detail) {
            return $detail->quantity * $detail->dish->price;
        });

        // Calcular el monto del IGV
        $igv = $totalAmount * 0.18; // La tasa estándar de IGV en Perú es del 18%

        // Calcular el monto total a pagar (subtotal + IGV)
        $totalToPay = $totalAmount + $igv;

        //para guardar la moneda del cliente
        if (isset($request->soles)) {
            $dineroCliente = $request->soles;
        } else if (isset($request->dolares)) {
            $dineroCliente = "$/." . $request->dolares;
        } else if (isset($request->tarjeta)) {
            $dineroCliente = $request->tarjeta;
        } else {
            $dineroCliente = 'dinero no ingreso';
        }

        $tables = Table::find($order->table_id);
        $tables->update(['state' => 'ACTIVO']);

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
                        'income_tax' => $igv,
                        'cash_payment' => $dineroCliente,
                        'payment_method' => $request->payment_method,
                        'type_receipt' => 'FACTURA',
                        'payment_date' => date('Y-m-d'),
                        'payment_time' => date('H:i:s'),
                        'order_id' => $order->id,
                        'user_id' => auth()->user()->id
                    ]);

                    if ($payment) {
                        $order->update(['state' => 'COBRADO']);
                        return redirect()->route('cashier.pay.index')->with('message', 'pago procesado correctamente');
                    } else {
                        return redirect()->route('cashier.pay.index')->with('message', 'pago no procesado');
                    }
                }
            }
        } else {
            $payment = Transaction::create([
                'amount' => $totalAmount,
                'income_tax' => $igv,
                'cash_payment' => $dineroCliente,
                'payment_method' => $request->payment_method,
                'type_receipt' => 'BOLETA',
                'payment_date' => date('Y-m-d'),
                'payment_time' => date('H:i:s'),
                'order_id' => $order->id,
                'user_id' => auth()->user()->id
            ]);

            if ($payment) {
                $order->update(['state' => 'COBRADO']);
                return redirect()->route('cashier.pay.boleta')->with('message', 'pago procesado correctamente');
            } else {
                return redirect()->route('cashier.pay.boleta')->with('message', 'pago no procesado');
            }
        }
    }

    //imprimir los datos de manera directa (metodo sin funcion)
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

    //para actualizar la mesa e imprimir el ticket
    public function update(Request $request)
    {
        //validamos si la orden ya ha sido cobrada y liberamos la mes
        $order = Order::find($request->order_id);
        if ($order->state == 'OCULTO' || $order->state == 'COBRADO') {
            $update = Table::find($request->table_id);
            $save = $update->update(['state' => 'ACTIVO']);

            if ($save) {
                return response()->json([
                    'code' => 2,
                    'msg' => 'ORDEN YA COBRADA, LIBERANDO MESA'
                ]);
            }
        } else if ($order->state == 'PEDIDO') {
            //validamos si la mesa esta libre , eso quiere decir que la mesa se ha cambiado
            $libre = Table::find($request->table_id);
            if ($libre->state == 'ACTIVO') {
                return response()->json([
                    'code' => 3,
                    'msg' => 'MESA MOVIDA, LIBERANDO MESA'
                ]);
            } else {
                // de  lo contrario activamos precuenta
                $update = Table::find($request->table_id);
                $save = $update->update(['state' => 'PRECUENTA']);
                if ($save) {
                    return response()->json([
                        'code' => 1,
                        'msg' => 'MESA CON PRECUENTA ACTIVADA'
                    ]);
                } else {
                    return response()->json([
                        'code' => 0,
                        'msg' => 'MESA SIN ACTUALIZAR'
                    ]);
                }
            }
        }
    }
}
