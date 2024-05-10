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
                @include('template.nav-mesera')
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
                                        {{-- <a href="{{ route('waitress.order.index') }}" class="text-decoration-none">Mesera</a> --}}
                                    </li>
                                    <li class="breadcrumb-item">Pedidos</li>
                                    <li class="breadcrumb-item text-light">Editar Pedidos</li>
                                </ol>
                                <!-- Breadcrumb end -->
                            </div>
                        </div>
                        <!-- Row end -->

                        <!-- Row start -->
                        <div class="row">

                            <div class="d-flex justify-content-between mb-3">
                                <form action="{{ route('waitress.table.update') }}" id="form-print-waitress" method="POST">
                                    @csrf
                                    <input type="text" name="table_id" value="{{ $order->table_id }}" hidden>
                                    <input type="text" name="order_id" id="order_id" value="{{ $order->id }}" hidden>
                                    <button type="submit" class="btn btn-info">
                                        PRECUENTA
                                    </button>
                                </form>

                                <form action="{{ route('waitress.order.delete', ['order' => $order]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">ELIMINAR PEDIDO</button>
                                </form>

                                <div>
                                    <a href="{{ route('waitress.table.index') }}" class="btn btn-outline-warning">Mesas</a>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="card mb-2">
                                    <div class="card-body">
                                        @livewire('waitress.order-update', ['order' => $order], key($order->id))
                                    </div>
                                </div>
                            </div>

                            {{-- PARA EDITAR LA MESA --}}

                            <div class="col-xl-12">
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <form action="{{ route('waitress.order.table.change') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-3 col-12">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Mesa Actual</label>
                                                        <div class="input-group">
                                                            <input type="text" name="order_id" class="form-control"
                                                                value="{{ $order->id }}" hidden>
                                                            <input type="text" name="table_id" class="form-control"
                                                                value="{{ $table->id }}" hidden>
                                                            <input type="text" class="form-control"
                                                                value="{{ $table->name }}">
                                                            <span class="input-group-text">
                                                                <i class="icon-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-12">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Mesa Requerida</label>
                                                        <div class="input-group">
                                                            <select name="table_change_id" class="form-select">
                                                                @foreach ($tables as $table)
                                                                    <option value=" {{ $table->id }}"
                                                                        class="text-bg-dark">
                                                                        {{ $table->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <span class="input-group-text">
                                                                <i class="icon-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3 col-12">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Actualizar</label>
                                                        <button type="submit" class="btn btn-primary w-100">
                                                            Cambiar Mesa
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
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
