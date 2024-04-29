<?php

namespace App\Http\Livewire\Waitress;

use App\Models\Category;
use App\Models\Dish;
use App\Models\Order;
use App\Models\OrderDish;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Orders extends Component
{
    //tabla orderDish
    public $orderDetails;

    //tabla categorias
    public $categories;

    //tabla productos
    public $products;

    //id del prodcuto "paltos o bebidas"
    public $product_id;

    //id de la tabla "mesa"
    public $table_id;
    public $name;

    //ide de la categoria
    public $category_id;

    //ultimo orden generada por el mesero
    public $last_order;

    //total del monto
    public $totalAmount;


    public function mount(Table $table)
    {
        $this->table_id = $table->id;
        $this->name = $table->name;

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

        // Retornar la vista con los datos necesarios
        return view('livewire.waitress.orders', [
            'totalAmount' => $this->totalAmount,
        ]);
    }

    // Método para platos a la orden
    public function create()
    {
        // Validar que los campos obligatorios estén completos
        $this->validate([
            'table_id' => 'required|exists:tables,id',
            'category_id' => 'required|exists:categories,id',
            'product_id' => 'required|exists:dishes,id',
            'table_id' => 'required|exists:tables,id'
        ]);

        // Buscar una orden pendiente para la mesa seleccionada
        $order = Order::where('state', 'PENDIENTE')
            ->where('table_id', $this->table_id)
            ->first();

        //contador de pedidos para que se reinicie cada dia
        $ordersCount = DB::table('orders')
            ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
            ->count();

        if ($ordersCount) {
            $ordersCount = $ordersCount + 1;
        } else {
            $ordersCount = 1;
        }

        // Si no hay una orden pendiente para la mesa, crear una nueva orden
        if (!$order) {
            $order = Order::create([
                'state' => 'PENDIENTE',
                'table_id' => $this->table_id,
                'order_number' => $ordersCount,
                'user_id' => auth()->user()->id
            ]);
        }

        // Agregar el plato al pedido
        OrderDish::create([
            'order_id' => $order->id,
            'dish_id' => $this->product_id,
            'quantity' => 1, // Puedes cambiar esto según la lógica de tu aplicación
            'state' => 'PEDIDO', //estado de cada plato
        ]);

        // Recuperar los detalles de los platos asociados a esta orden
        $this->orderDetails = OrderDish::where('order_id', $order->id)->with('dish')->get();
        $this->category_id = null;
        $this->product_id = null;

        // direccionamos a las mesas
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
                    session()->flash('message', 'Cantidad restada.');
                } else {
                    session()->flash('message', 'Error al restar la cantidad.');
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
        // Obtener la orden pendiente
        $order = Order::where('state', 'PENDIENTE')->where('user_id', auth()->user()->id)->latest()->first();

        if ($order) {
            // Eliminar todos los detalles de los pedidos asociados a esta orden
            OrderDish::where('order_id', $order->id)->delete();

            // Cancelar la orden
            $order->delete();

            // Emitir un mensaje de éxito
            session()->flash('message', 'Pedidos cancelados correctamente.');
        } else {
            // Emitir un mensaje de error si no se encuentra la orden
            session()->flash('message', 'No se encontró ninguna orden pendiente para esta mesa.');
        }
        // Actualizar los detalles del pedido
        $this->reload();
        return redirect()->route('waitress.table.index');
    }

    //para pedir la orden a cocina y mandar a caja
    public function order()
    {
        // Obtener la orden pendiente
        $order = Order::where('state', 'PENDIENTE')->where('user_id', auth()->user()->id)->latest()->first();
        $update = $order->update(['state' => 'PEDIDO']);

        if ($update) {
            $tables = Table::find($this->table_id);
            $tables->update(['state' => 'INACTIVO']);
        } else {
            session()->flash('message', 'Error del pedido.');
        }
        // Actualizar los detalles del pedido
        $this->reload();
        return redirect()->route('waitress.table.index');
    }

    public function filterProductsByCategory()
    {
        // Obtener el ID de la categoría seleccionada
        $categoryId = $this->category_id;

        // Verificar si se seleccionó una categoría
        if ($categoryId) {
            // Obtener los productos correspondientes a la categoría seleccionada
            $products = Dish::where('category_id', $categoryId)->get();
        } else {
            // Si no se seleccionó una categoría, obtener todos los productos
            $products = Dish::all();
        }
        // Actualizar la propiedad $products con los productos filtrados
        $this->products = $products;
    }

    //refrezcar los datos de los pedidos
    public function reload()
    {
        $last_order = Order::where('state', 'PENDIENTE')->where('user_id', auth()->user()->id)->latest()->first();
        $this->categories = Category::all();
        $this->products = Dish::all();

        //cuando hay un pedido en la base de datos
        if ($last_order) {
            $this->last_order = $last_order;
            $this->orderDetails = OrderDish::where('order_id', $last_order->id)->with('dish')->get();
        } else {
            // Si no hay ningún pedido, inicializa las propiedades a un valor predeterminado o nulo
            $this->last_order = null;
            $this->orderDetails = collect(); // Puedes usar collect() para crear una colección vacía
        }
    }
}
