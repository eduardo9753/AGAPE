<?php

namespace App\Http\Livewire\Waitress;

use App\Models\Category;
use App\Models\Dish;
use App\Models\Order;
use App\Models\OrderDish;
use App\Models\Table;
use Livewire\Component;

class OrderUpdate extends Component
{

    public $order;

    //tabla orderDish
    public $orderDetails;

    //tabla table
    public $tables;

    //tabla categorias
    public $categories;

    //tabla productos
    public $products;

    //id del prodcuto "paltos o bebidas"
    public $product_id;

    //id de la tabla "mesa"
    public $table_id;

    //ide de la categoria
    public $category_id;

    //ultimo orden generada por el mesero
    public $last_order;

    //total del monto
    public $totalAmount;

    // Montar el componente con el modelo de la orden
    public function mount(Order $order)
    {
        $this->order = $order;

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
        return view('livewire.waitress.order-update', [
            'totalAmount' => $this->totalAmount,
        ]);
    }

    // Método para crear el pedido
    public function create()
    {
        // Validar que los campos obligatorios estén completos
        $this->validate([
            'product_id' => 'required|exists:dishes,id',
        ]);

        // Agregar el plato al pedido
        OrderDish::create([
            'order_id' => $this->order->id,
            'dish_id' => $this->product_id,
            'quantity' => 1, // Puedes cambiar esto según la lógica de tu aplicación
            'state' => 'NUEVO', //estado de cada plato
        ]);

        // Recuperar los detalles de los platos asociados a esta orden
        $this->orderDetails = OrderDish::where('order_id', $this->order->id)->with('dish')->get();
        $this->reload();

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
        $last_order = $this->order;

        $this->categories = Category::all();
        $this->products = Dish::all();
        $this->table_id = $last_order->table->name;
    
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
