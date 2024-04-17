<div class="row">
    @foreach ($orders as $order)
        <div class="col-md-4">
            <div class="card mb-2">
                <div class="card-header">
                    <h5 class="card-title text-primary">Pedido: #{{ $order->id }} </h5>
                    <h5 class="card-title text-primary">Mesa: {{ $order->table->name }}</h5>

                    <div class="d-flex justify-content-between mt-2">
                        <form action="{{ route('cashier.order.delete', ['order' => $order]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger"><span
                                    class="fs-3 icon-x-octagon"></span></button>
                        </form>

                        <a href="{{ route('cashier.order.show', ['order' => $order]) }}" class="btn btn-success">
                            <span class="fs-3 icon-create"></span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($order->orderDishes as $orderDish)
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title">Plato: {{ $orderDish->dish->name }}</h5>
                                <h5 class="card-title">Cantidad: {{ $orderDish->quantity }}</h5>
                                {{-- <p class="card-text">{{ $orderDish->dish->description }}</p>
                                <div class="d-flex gap-2 mt-2">
                                    <a href="#" class="btn btn-outline-danger">eliminar id:
                                        {{ $orderDish->id }}</a>
                                    <a href="#" class="btn btn-outline-success">Another link</a>
                                </div>
                                --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

</div>
