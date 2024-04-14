<?php

namespace App\Http\Livewire\Waitress;

use App\Models\Customer;
use App\Models\Dish;
use App\Models\Order;
use App\Models\OrderDish;
use App\Models\Table;
use Livewire\Component;

class Orders extends Component
{
    //tabla cliente
    public $customer_id;
    public $name;
    public $identity;

    //tabla producto
    public $product_id;

    //tabla orderDish
    public $orderDetails;

    //tabla table
    public $tables;

    //id de la tabla "mesa"
    public $table_id;

    //ultimo id de la oden
    public $last_order;

    //ultimo id del cliente
    public $last_customer_id;

    //total del monto
    public $totalAmount;


    public function mount()
    {
        // Actualiza los detalles del pedido
        $this->reload();

        // Inicializa $totalAmount
        $this->totalAmount = 0;
    }

    public function render()
    {
        // Obtener los detalles del pedido y calcular el monto total
        $this->totalAmount = $this->orderDetails->sum(function ($detail) {
            return $detail->quantity * $detail->dish->price;
        });

        $products = Dish::all();
        $tables = Table::where('state', 'ACTIVO')->get();
        // Retornar la vista con los datos necesarios
        return view('livewire.waitress.orders', [
            'products' => $products,
            'totalAmount' => $this->totalAmount,
            'tables' => $tables
        ]);
    }

    // Método para crear el pedido
    public function create()
    {
        // Validar que los campos obligatorios estén completos
        $this->validate([
            'name' => 'required|string',
            'identity' => 'required|string',
            'product_id' => 'required|exists:dishes,id',
            'table_id' => 'required|exists:tables,id'
        ]);

        // Buscar al cliente por su identidad
        $customer = Customer::where('identity', $this->identity)->first();

        // Si el cliente no existe, crearlo
        if (!$customer) {
            $customer = Customer::create([
                'name' => $this->name,
                'email' => '',
                'identity' => $this->identity
            ]);
        }

        // Buscar si el cliente ya tiene un pedido pendiente
        $order = Order::where('state', 'PENDIENTE')
            ->where('customer_id', $customer->id)
            ->first();

        // Si el cliente no tiene un pedido pendiente, crear uno nuevo
        if (!$order) {
            $order = Order::create([
                'state' => 'PENDIENTE',
                'customer_id' => $customer->id,
                'table_id' => $this->table_id, // Puedes cambiar esto según la lógica de tu aplicación
                'user_id' => auth()->user()->id
            ]);
        }

        // Agregar el plato al pedido
        OrderDish::create([
            'order_id' => $order->id,
            'dish_id' => $this->product_id,
            'quantity' => 1 // Puedes cambiar esto según la lógica de tu aplicación
        ]);

        // Recuperar los detalles de los platos asociados a esta orden
        $this->orderDetails = OrderDish::where('order_id', $order->id)->with('dish')->get();

        // Emitir un mensaje de éxito
        session()->flash('message', 'Pedido creado exitosamente.');
    }


    //boton para sumar cantidad a un pedido
    public function plus($id)
    {
        $orderDetails = OrderDish::find($id);

        if ($orderDetails) {
            $cantidad_actual = $orderDetails->quantity;
            $cantidad_final = $cantidad_actual + 1;
            $save = $orderDetails->update(['quantity' => $cantidad_final]);

            if ($save) {
                session()->flash('message', 'Cantidad agregada.');
            } else {
                session()->flash('message', 'Error al agregar la cantidad.');
            }
        } else {
            session()->flash('message', 'Detalle de pedido no encontrado.');
        }

        // Actualiza los detalles del pedido
        $this->reload();
    }

    //boton para restar cantidad  a un pedido
    public function minus($id)
    {
        $orderDetails = OrderDish::find($id);

        if ($orderDetails) {
            if ($orderDetails->quantity >= 2) {
                $cantidad_actual = $orderDetails->quantity;
                $cantidad_final = $cantidad_actual - 1;
                $save = $orderDetails->update(['quantity' => $cantidad_final]);

                if ($save) {
                    session()->flash('message', 'Cantidad agregada.');
                } else {
                    session()->flash('message', 'Error al agregar la cantidad.');
                }
            } else {
                session()->flash('message', 'La cantidad minima es uno.');
            }
        } else {
            session()->flash('message', 'Detalle de pedido no encontrado.');
        }

        // Actualiza los detalles del pedido
        $this->reload();
    }

    //boton para eliminar un pedido
    public function trash($id)
    {
        $orderDetails = OrderDish::find($id);
        if ($orderDetails->delete()) {
            session()->flash('message', 'Producto eliminado.');
        } else {
            session()->flash('message', 'Producto no eliminado.');
        }
        // Actualiza los detalles del pedido
        $this->reload();
    }

    //para eliminar todo la orden
    public function cancel()
    {
        // Me trae el ultimo pedido
        $order = Order::latest()->first();

        $customer = Customer::find($order->customer_id);
        if ($customer && $customer->delete()) {
            session()->flash('message', 'Pedido eliminado exitosamente.');
        } else {
            session()->flash('message', 'Error al eliminar el pedido.');
        }

        // Actualiza los detalles del pedido
        $this->reset();
        $this->reload();
    }

    //para pedir la order a cocina y mandar a caja
    public function order()
    {
        $order = Order::latest()->first();
        $update = $order->update(['state' => 'PEDIDO']);

        if ($update) {
            $tables = Table::find($this->table_id);
            $tables->update(['state' => 'INACTIVO']);
            session()->flash('message', 'Pedido generado correctamente.');
        } else {
            session()->flash('message', 'Error del pedido.');
        }

        // Actualiza los detalles del pedido
        $this->reset('name', 'identity');
        $this->reload();
    }

    //refrezcar los datos de los pedidos
    public function reload()
    {
        $last_order = Order::where('state', 'PENDIENTE')->latest()->first();

        //cuando hay un pedido en la base de datos
        if ($last_order) {
            $this->last_order = $last_order;
            $this->last_customer_id = $last_order->customer_id;
            $this->orderDetails = OrderDish::where('order_id', $last_order->id)->with('dish')->get();
        } else {
            // Si no hay ningún pedido, inicializa las propiedades a un valor predeterminado o nulo
            $this->last_order = null;
            $this->last_customer_id = null;
            $this->orderDetails = collect(); // Puedes usar collect() para crear una colección vacía
        }


        //inicializando primer id del palto
        $firstDish = Dish::first();
        $this->product_id = $firstDish ? $firstDish->id : null;

        //inicializando primer id de la mesa
        $firstTable = Table::where('state', 'ACTIVO')->first();
        $this->table_id = $firstTable ? $firstTable->id : null;

        //refrezcamos las mesas
        $this->tables = Table::where('state', 'ACTIVO')->get();
    }
}
