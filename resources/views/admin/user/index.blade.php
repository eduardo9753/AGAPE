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
                                        <i class="icon-home lh-1"></i>
                                        <a href="{{ route('admin.dashboard.index') }}" class="text-decoration-none">Admin</a>
                                    </li>
                                    <li class="breadcrumb-item">Crear</li>
                                    <li class="breadcrumb-item text-light">Crear Roles</li>
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
                                        @if (session('exito'))
                                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                <strong>Mensaje!</strong> {{ session('exito') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif

                                        <div class="table-responsive">
                                            <table class="table" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>NOMBRE</th>
                                                        <th>EMAIL</th>
                                                        <th>INSCRITO</th>
                                                        <th>EDITAR</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($users as $user)
                                                        <tr>
                                                            <td>{{ $user->id }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>
                                                                @if ($user->created_at)
                                                                    {{ $user->created_at->diffForHumans() }}
                                                                @else
                                                                    No hay fecha de creación establecida
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-outline-warning"
                                                                    href="{{ route('admin.users.edit', ['user' => $user]) }}">Asignar Rol</a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>Sin Usuarios por ahora</td>
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
