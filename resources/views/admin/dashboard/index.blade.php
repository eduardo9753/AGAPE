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
                @include('template.nav-admin')
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
                                        <i class="icon-house_siding lh-1"></i>
                                        <a href="{{ route('admin.dashboard.index') }}" class="text-decoration-none">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">Dashboards</li>
                                    <li class="breadcrumb-item text-light">Analytics</li>
                                </ol>
                                <!-- Breadcrumb end -->
                            </div>
                        </div>
                        <!-- Row end -->

                        <!-- Row start -->
                        <div class="row gx-2">
                            <div class="col-xl-6 col-12">
                                <!-- Row start -->
                                <div class="row gx-2">
                                    <div class="col-sm-6 col-12">
                                        <div class="card mb-2">
                                            <div class="card-header">
                                                <h5 class="card-title">ordenes cobradas hoy</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>cantidad</span>
                                                    <span class="fw-bold">{{ $ordersCount }}</span>
                                                </div>
                                                <div class="progress small">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="card mb-2">
                                            <div class="card-header">
                                                <h5 class="card-title">transacciones realizadas hoy</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>cantidad</span>
                                                    <span class="fw-bold">{{ $transactiopnCount }}</span>
                                                </div>
                                                <div class="progress small">
                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                        style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-12">
                                        <div class="card mb-2">
                                            <div class="card-header">
                                                <h5 class="card-title">Reportes</h5>
                                            </div>
                                            <div class="card-body">

                                                <form action="{{ route('admin.dashboard.reporte') }}" method="POST"
                                                    target="_blank">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Fecha
                                                                    Inicio</label>
                                                                <div class="input-group">
                                                                    <input type="date" class="form-control"
                                                                        name="fecha_inicio" value="{{ date('Y-m-d') }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Fecha
                                                                    Final</label>
                                                                <div class="input-group">
                                                                    <input type="date" class="form-control"
                                                                        name="fecha_final" value="{{ date('Y-m-d') }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-12">
                                                            <div class="mb-3">
                                                                <input type="submit" class="btn btn-danger w-100"
                                                                    value="GENERAR PDF">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-12">
                                        <div class="card mb-2">
                                            <div class="card-header">
                                                <h5 class="card-title">Flujos</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="scroll200">
                                                    <div class="my-2">
                                                        <div class="d-flex align-items-start">
                                                            <div class="media-box me-3 bg-primary rounded-5">
                                                                <i class="icon-thumbs-up"></i>
                                                            </div>
                                                            <div class="mb-4">
                                                                <h5>Monto total de hoy</h5>
                                                                <p class="mb-1">S/. {{ $transactionsAmount }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-12">
                                        <div class="card mb-2">
                                            <div class="card-header">
                                                <h5 class="card-title">Usuarios</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="border rounded-3">
                                                    <div class="table-responsive">
                                                        <table class="table align-middle custom-table m-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Usuario</th>
                                                                    <th>correo</th>
                                                                    <th>rol</th>
                                                                    <th>conexion</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($users as $user)
                                                                    <tr>
                                                                        <td>{{ $user->id }}</td>
                                                                        <td>
                                                                            <div class="fw-semibold">{{ $user->name }}
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <span
                                                                                class="badge bg-primary">{{ $user->email }}</span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="badge border border-light">
                                                                                @foreach ($user->getRoleNames() as $role)
                                                                                    {{ $role }}
                                                                                @endforeach
                                                                            </span>
                                                                        </td>

                                                                        <td>
                                                                            <div class="starReadOnly1 rating-stars my-2">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Row end -->
                            </div>
                            <div class="col-xl-6 col-12">
                                <div class="row gx-2">

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
                                                        <h6 class="badge bg-primary">{{ $table->state }}</h6>
                                                    @elseif ($table->state == 'INACTIVO')
                                                        <h6 class="badge bg-danger">OCUPADO</h6>
                                                    @else
                                                        <h6 class="badge bg-danger">{{ $table->state }}</h6>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

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
                        <span>© SysPedidos @php
                            echo date('Y');
                        @endphp </span>
                    </div>
                </div>
                <!-- App footer end -->

            </div>
            <!-- App container ends -->

        </div>
        <!-- Page wrapper end -->


    </body>
@endsection
