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
                                    <li class="breadcrumb-item">Pagos</li>
                                    <li class="breadcrumb-item text-light">Lista Pagos Boletas</li>
                                </ol>
                                <!-- Breadcrumb end -->
                            </div>
                        </div>
                        <!-- Row end -->

                        <!-- Row start -->
                        <div class="row">
                            <div class="col-md-3">
                                <a class="btn btn-info" href="">ACTUALIZAR</a>
                            </div>
                            <div class="col-xl-12">
                                @if (session()->has('message'))
                                    <div class="alert border border-info alert-dismissible fade show" role="alert">
                                        <b>Info!</b> {{ session('message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="card mb-2">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>MONTO</th>
                                                        <th>METODO</th>
                                                        <th>CREADO</th>
                                                        <th>TIPO</th>
                                                        <th>ESTADO</th>
                                                        <th>MESA</th>
                                                        <th>FECHA</th>
                                                        <th>PDF</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @forelse ($pays as $pay)
                                                        <tr>
                                                            <td>{{ $pay->id }}</td>
                                                            <td>{{ $pay->amount }}</td>
                                                            <td>{{ $pay->payment_method }}</td>
                                                            <td>
                                                                @if ($pay->created_at)
                                                                    {{ $pay->created_at->diffForHumans() }}
                                                                @else
                                                                    No hay fecha de creación establecida
                                                                @endif
                                                            </td>
                                                            <td>{{ $pay->type_receipt }}</td>
                                                            <td>{{ $pay->order->state }}</td>
                                                            <td>{{ $pay->order->table->name }}</td>
                                                            <td>{{ $pay->payment_date }}</td>
                                                            <td>
                                                                <a target="_blank" class="btn btn-outline-danger"
                                                                    href="{{ route('cashier.pdf.boleta', ['pay' => $pay]) }}">PDF</a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>Sin pagos por ahora</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
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
