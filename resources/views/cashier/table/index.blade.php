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
                                    <li class="breadcrumb-item">Mesas</li>
                                    <li class="breadcrumb-item text-light">Lista de Mesas</li>
                                </ol>
                                <!-- Breadcrumb end -->
                            </div>
                        </div>
                        <!-- Row end -->

                        <!-- Row start -->
                        <a class="btn btn-info mb-3" href="">ACTUALIZAR</a>
                        <div class="row gx-2">
                            {{--  <input type="text" id="count_table_cashier" name="count_table_cashier" value="1" hidden> M --}}

                            @foreach ($tables as $table)
                                <div class="col-sm-4 col-6">
                                    <div class="card px-3 py-2 mb-2 d-flex flex-row align-items-center">
                                        <div class="position-relative shape-block">
                                            <img src="https://cdn-icons-png.flaticon.com/512/607/607008.png"
                                                class="img-fluid img-4x" alt="Bootstrap Themes" />
                                            <i class="icon-book-open"></i>
                                        </div>
                                        <div class="ms-2">
                                            <h3 class="m-0 fw-semibold">{{ $table->name }}</h3>
                                            @if ($table->state == 'ACTIVO')
                                                <button class="btn btn-primary btn-sm">LIBRE</button>
                                            @elseif ($table->state == 'INACTIVO')
                                                @php
                                                    $order = $table->getLastOrderWithinTwoDays();
                                                @endphp
                                                @if ($order)
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-12">
                                                            <button class="btn btn-danger btn-sm">OCUPADO</button>
                                                        </div>

                                                        <div class="col-lg-4 col-md-12">
                                                            {{-- FORM DE PRECUENTA --}}
                                                            <form action="{{ route('cashier.table.update') }}"
                                                                id="form-print-cashier-{{ $order->id }}" method="POST">
                                                                @csrf
                                                                <input type="text" name="table_id"
                                                                    value="{{ $order->table_id }}" hidden>
                                                                <input type="text" name="order_id" id="order_id"
                                                                    value="{{ $order->id }}" hidden>
                                                                <button type="submit" class="btn btn-info btn-sm">
                                                                    PRECUENTA
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <div class="col-lg-4 col-md-12">
                                                            {{-- FORM DE MANDAR A COCINA --}}
                                                            <form id="form-print-cashier-kitchen-{{ $order->id }}">
                                                                <input type="text" name="table_id"
                                                                    value="{{ $order->table_id }}" hidden>
                                                                <input type="text" name="order_id" id="order_id"
                                                                    value="{{ $order->id }}" hidden>
                                                                <button type="submit" class="btn btn-danger btn-sm">
                                                                    COCINA
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="ms-2">
                                                                <h6 class="badge bg-danger">Orden fuera de fecha</h6>
                                                                <a href="{{ route('cashier.table.liberar', ['table' => $table]) }}"
                                                                    class="btn btn-dark">Liberar {{ $table->name }}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                @php
                                                    $order = $table->getLastOrderWithinTwoDays();
                                                @endphp
                                                @if ($order)
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-12">
                                                            <button
                                                                class="btn btn-info btn-sm">{{ $table->state }}</button>
                                                        </div>

                                                        <div class="col-lg-4 col-md-12">
                                                            {{-- FORM DE PRECUENTA --}}
                                                            <form action="{{ route('cashier.table.update') }}"
                                                                id="form-print-cashier" method="POST">
                                                                @csrf
                                                                <input type="text" name="table_id"
                                                                    value="{{ $order->table_id }}" hidden>
                                                                <input type="text" name="order_id" id="order_id"
                                                                    value="{{ $order->id }}" hidden>
                                                                <button type="submit" class="btn btn-info btn-sm">
                                                                    PRECUENTA
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <div class="col-lg-4 col-md-12">
                                                            {{-- FORM DE MANDAR A COCINA --}}
                                                            <form id="form-print-cashier-kitchen">
                                                                <input type="text" name="table_id"
                                                                    value="{{ $order->table_id }}" hidden>
                                                                <input type="text" name="order_id" id="order_id"
                                                                    value="{{ $order->id }}" hidden>
                                                                <button type="submit" class="btn btn-danger btn-sm">
                                                                    COCINA
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="ms-2">
                                                                <h6 class="badge bg-danger">Orden fuera de fecha</h6>
                                                                <a href="{{ route('cashier.table.liberar', ['table' => $table]) }}"
                                                                    class="btn btn-dark">Liberar {{ $table->name }}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                            {{-- <div class="col-sm-12" id="allTablesCashier"></div> --}}
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
