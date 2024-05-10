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
                                        <a href="{{ route('waitress.table.index') }}" class="text-decoration-none">Mesera</a>
                                    </li>
                                    <li class="breadcrumb-item">Mesas</li>
                                    <li class="breadcrumb-item text-light">Lista de Mesas</li>
                                </ol>
                                <!-- Breadcrumb end -->
                            </div>
                        </div>
                        <!-- Row end -->

                        <!-- Row start -->
                        <a class="btn btn-info" href="">ACTUALIZAR</a>
                        <a href="{{ route('waitress.table.index') }}" class="btn btn-outline-warning">Mesas</a>
                        <a href="{{ route('waitress.order.list') }}" class="btn btn-outline-primary">Tus Ordenes</a>
                        <div class="row gx-2 mb-3">
                            @if (session()->has('mensaje'))
                                <div class="alert border border-danger alert-dismissible fade show" role="alert">
                                    <b>Aviso!</b>{{ session('mensaje') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <input type="text" id="count_table_waitress" name="count_table_waitress" value="1"
                                hidden>

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
                                                <a href="{{ route('waitress.order.index', ['table' => $table]) }}">
                                                    <button class="btn btn-primary btn-sm">LIBRE</button>
                                                </a>
                                            @elseif ($table->state == 'INACTIVO')
                                                @php
                                                    $order = $table->orders->last(); // Obtener la última orden asociada a la mesa
                                                @endphp
                                                <a href="{{ route('waitress.order.show', ['order' => $order]) }}"
                                                    class="btn btn-danger btn-sm">
                                                    OCUPADO
                                                </a>
                                            @else
                                                @php
                                                    $order = $table->orders->last(); // Obtener la última orden asociada a la mesa
                                                @endphp
                                                <a href="{{ route('waitress.order.show', ['order' => $order]) }}"
                                                    class="btn btn-info btn-sm">
                                                    CON {{ $table->state }}
                                                </a>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            @endforeach


                            {{-- <div class="col-sm-12" id="allTablesWaitress"></div> --}}
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
