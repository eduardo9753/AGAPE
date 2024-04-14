@extends('layouts.app')


@section('body')

    <body>

        <!-- Page wrapper start -->
        <div class="page-wrapper">

            <!-- App container starts -->
            <div class="app-container">

                <!-- App header starts -->
                @include('helpers.header-start')
                <!-- App header ends -->

                <!-- App navbar starts -->
                @include('template.nav-caja')
                <!-- App Navbar ends -->

                <!-- App body starts -->
                <div class="app-body">

                    <!-- Container starts -->
                    <div class="container">

                        <!-- Row start -->
                        <div class="row">
                            <div class="col-12 col-xl-6">

                                <!-- Breadcrumb start -->
                                <ol class="breadcrumb mb-3">
                                    <li class="breadcrumb-item">
                                        <i class="icon-home lh-1"></i>
                                        <a href="{{ route('cashier.order.index') }}" class="text-decoration-none">Cajera</a>
                                    </li>
                                    <li class="breadcrumb-item">Pagar</li>
                                    <li class="breadcrumb-item text-light">Crear Pago</li>
                                </ol>
                                <!-- Breadcrumb end -->
                            </div>
                        </div>
                        <!-- Row end -->

                        <!-- Row start -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div>
                                            <form action="{{ route('cashier.pay.list', ['order' => $order]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="create-invoice-wrapper">
                                                    <!-- Row start -->
                                                    <div class="row">
                                                        <div class="col-sm-3 col-12">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Cliente</label>
                                                                <input type="text" value="{{ $customer->name }}"
                                                                    class="form-control" placeholder="Nombre del Cliente" />
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-3 col-12">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">DNI/CI</label>
                                                                <input type="text" value="{{ $customer->identity }}"
                                                                    class="form-control" placeholder="Ingresar DNI/CE" />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 col-12">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">TIPO</label>
                                                                <div class="input-group">
                                                                    <select class="form-select" name="type_receipt">
                                                                        <option value="BOLETA" class="text-bg-dark">
                                                                            BOLETA
                                                                        </option>
                                                                        <option value="FACTURA" class="text-bg-dark">
                                                                            FACTURA
                                                                        </option>
                                                                    </select>
                                                                    <span class="input-group-text">
                                                                        <i class="icon-calendar"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 col-12">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">METODO DE
                                                                    PAGO</label>
                                                                <div class="input-group">
                                                                    <select class="form-select" name="payment_method">
                                                                        <option value="YAPE" class="text-bg-dark">
                                                                            YAPE
                                                                        </option>
                                                                        <option value="PLIN" class="text-bg-dark">
                                                                            PLIN
                                                                        </option>
                                                                        <option value="TARJETA" class="text-bg-dark">
                                                                            TARJETA
                                                                        </option>
                                                                        <option value="EFECTIVO" class="text-bg-dark">
                                                                            EFECTIVO
                                                                        </option>
                                                                    </select>
                                                                    <span class="input-group-text">
                                                                        <i class="icon-calendar"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-12">
                                                            <div class="mb-3">
                                                                @if ($order->state == 'PEDIDO')
                                                                    <button type="submit" class="btn btn-primary">
                                                                        Cobrar
                                                                    </button>
                                                                @else
                                                                    <div class="alert border border-info alert-dismissible fade show"
                                                                        role="alert">
                                                                        <b>Info!</b> Ya ha sido cobrado este monto
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="alert"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Row end -->
                                                </div>
                                            </form>

                                            <!-- Row start -->
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="table-responsive w-100">
                                                        <table class="table table-striped table-bordered align-middle m-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="icon-add_task me-2 fs-4"></span>
                                                                            Plato
                                                                        </div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="d-flex align-items-center">
                                                                            <span
                                                                                class="icon-published_with_changes me-2 fs-4"></span>
                                                                            Cantidad
                                                                        </div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="d-flex align-items-center">
                                                                            <span
                                                                                class="icon-playlist_add_check me-2 fs-4"></span>
                                                                            Precio
                                                                        </div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="icon-calendar me-2 fs-4"></span>
                                                                            Monto
                                                                        </div>
                                                                    </th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($order->orderDishes as $key => $detail)
                                                                    <tr>
                                                                        <td>{{ $key + 1 }}</td>
                                                                        <td>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $detail->dish->name }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $detail->quantity }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $detail->dish->price }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $detail->quantity * $detail->dish->price }}">
                                                                        </td>

                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        @if (session()->has('message'))
                                                            <div class="alert alert-success mt-3">{{ session('message') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Row end -->

                                            <div class="col-12">
                                                <div class="d-flex justify-content-between mt-3">
                                                    <div class="text-end">

                                                    </div>

                                                    <div class="d-flex align-items-center gap-2">
                                                        <label for="" class="">TOTAL: </label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $totalAmount }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->

                    </div>
                    <!-- Container ends -->

                </div>
                <!-- App body ends -->

                <!-- App footer start -->
                <div class="app-footer">
                    <div class="container">
                        <span>© Bootstrap Gallery 2024</span>
                    </div>
                </div>
                <!-- App footer end -->

            </div>
            <!-- App container ends -->

        </div>
        <!-- Page wrapper end -->


    </body>
@endsection
