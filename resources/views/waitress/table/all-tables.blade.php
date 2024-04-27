<div class="row">
    @foreach ($tables as $table)
        <div class="col-sm-4 col-6">
            <div class="card px-3 py-2 mb-2 d-flex flex-row align-items-center">
                <div class="position-relative shape-block">
                    <a href="{{ route('waitress.order.index', ['table' => $table]) }}"><img
                            src="{{ asset('assets/images/shape1.png') }}" class="img-fluid img-4x"
                            alt="Bootstrap Themes" /></a>
                    <i class="icon-book-open"></i>
                </div>
                <div class="ms-2">
                    <h3 class="m-0 fw-semibold">{{ $table->name }}</h3>
                    @if ($table->state == 'ACTIVO')
                        <h6 class="badge bg-primary">LIBRE</h6>
                    @elseif ($table->state == 'INACTIVO')
                        @php
                            $order = $table->orders->last(); // Obtener la última orden asociada a la mesa
                        @endphp
                        <h6 class="badge bg-danger">OCUPADO</h6>
                        <form id="form-print-cashier-kitchen">
                            <input type="text" name="table_id" value="{{ $table->id }}">
                            <input type="text" name="order_id" id="order_id" value="{{ $order->id }}">
                            <button type="submit" class="btn btn-danger">
                                <span class="fs-3 icon-outdoor_grill"></span>
                            </button>
                        </form>
                    @else
                        <h6 class="badge bg-info">{{ $table->state }}</h6>
                    @endif
                </div>

            </div>
        </div>
    @endforeach
</div>
