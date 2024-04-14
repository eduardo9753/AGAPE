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
                                    <li class="breadcrumb-item">Lista</li>
                                    <li class="breadcrumb-item text-light">Lista de Roles</li>
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
                                        <div class="table-responsive mt-4">
                                            <table class="table table-striped table-bordered align-middle m-0" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>NOMBRE</th>
                                                        <th>EDITAR</th>
                                                        <th>ELIMINAR</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($roles as $role)
                                                        <tr>
                                                            <td>{{ $role->id }}</td>
                                                            <td>{{ $role->name }}</td>

                                                            <td>
                                                                <a class="btn btn-outline-warning"
                                                                    href="{{ route('admin.roles.edit', ['role' => $role]) }}">permisos</a>
                                                            </td>

                                                            <td>
                                                                <form
                                                                    action="{{ route('admin.roles.destroy', ['role' => $role]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button class="btn btn-outline-danger">Eliminar</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>Sin Roles por ahora</td>
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
