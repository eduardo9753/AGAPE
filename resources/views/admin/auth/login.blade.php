@extends('layouts.app')




@section('body')

    <body class="bg-one">
        <!-- Container start -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-5 col-sm-6 col-12">
                    <form action="{{ route('admin.login.store') }}" class="my-5" method="POST">
                        @csrf
                        <div class="card p-md-4 p-sm-3">
                            <div class="login-form">
                                <a href="{{ route('login') }}" class="mb-4 d-flex">
                                    <img src="{{ asset('img/logo.png') }}" class="img-fluid login-logo"
                                        alt="Bootstrap Gallery" />
                                </a>
                                <h2 class="mt-4 mb-4">Ágape Chicken & Grill</h2>
                                @if (session('mensaje'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Mensaje!</strong> {{ session('mensaje') }}.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email"
                                        placeholder="Ingresa tu gmail" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Ingresa tu contraseña" />
                                        <a href="#" class="input-group-text">
                                            <i class="icon-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="form-check m-0">
                                        <input class="form-check-input" name="remember" type="checkbox" value=""
                                            id="remember" />
                                        <label class="form-check-label" for="remember">Recordar</label>
                                    </div>
                                    <a href="#" class="text-danger text-decoration-underline">No
                                        recuerdas?</a>
                                </div>
                                <div class="d-grid py-3 mt-3">
                                    <button type="submit" class="btn btn-lg btn-danger">
                                        LOGIN
                                    </button>
                                </div>
                                {{--
                                <div class="text-center py-2">o Login con</div>
                                <div class="btn-group w-100">
                                    <button type="button" class="btn btn-sm btn-outline-light">
                                        Google
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-light">
                                        Facebook
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-light">
                                        Twitter
                                    </button>
                                </div>
                                <div class="text-center pt-4">
                                    <span>No Registrado?</span>
                                    <a href="#" class="text-success text-decoration-underline">
                                        Registrarme</a>
                                </div>
                                --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Container end -->
    </body>
@endsection
