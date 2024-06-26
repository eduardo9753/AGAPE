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
                            <div class="d-flex justify-content-between mb-3">
                                {{-- FORM DE PRECUENTA --}}
                                <form action="{{ route('cashier.table.update') }}" id="form-print-cashier" method="POST">
                                    @csrf
                                    <input type="text" name="table_id" value="{{ $order->table_id }}" hidden>
                                    <input type="text" name="order_id" id="order_id" value="{{ $order->id }}" hidden>
                                    <button type="submit" class="btn btn-info">
                                        PRECUENTA
                                    </button>
                                </form>

                                {{-- FORM DE MANDAR A COCINA --}}
                                <form id="form-print-cashier-kitchen">
                                    <input type="text" name="table_id" value="{{ $order->table_id }}" hidden>
                                    <input type="text" name="order_id" id="order_id" value="{{ $order->id }}" hidden>
                                    <button type="submit" class="btn btn-danger">
                                        COCINA
                                    </button>
                                </form>
                            </div>

                            <div class="col-xl-12">
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div>
                                            <form action="{{ route('cashier.order.pay', ['order' => $order]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="create-invoice-wrapper">
                                                    <!-- Row start -->
                                                    <div class="row">
                                                        <div class="col-sm-12 col-12">
                                                            <div class="card mb-2">
                                                                <div class="card-body">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="inlineRadioOptions" id="inlineRadio1"
                                                                            value="option1"
                                                                            onclick="toggleFields(this.value)" />
                                                                        <label class="form-check-label"
                                                                            for="inlineRadio1">FACTURA</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="inlineRadioOptions" id="inlineRadio2"
                                                                            value="option2"
                                                                            onclick="toggleFields(this.value)" />
                                                                        <label class="form-check-label"
                                                                            for="inlineRadio2">INVITACIÓN</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="facturaFields" style="display: none;">
                                                            <div class="row">
                                                                <div class="col-sm-8 col-12">
                                                                    <div class="mb-3">
                                                                        <label for=""
                                                                            class="form-label">Cliente/Razón Social</label>
                                                                        <input type="text" name="client_name"
                                                                            class="form-control"
                                                                            placeholder="Nombre del Cliente" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-4 col-12">
                                                                    <div class="mb-3">
                                                                        <label for=""
                                                                            class="form-label">DNI/CI/RUC</label>
                                                                        <input type="text" name="client_id"
                                                                            class="form-control"
                                                                            placeholder="Ingresar DNI/CE" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="is_factura" value="0">
                                                        </div>




                                                    </div>
                                                    <!-- Row end -->
                                                </div>


                                                <!-- Row start -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive w-100">
                                                            <table
                                                                class="table table-striped table-bordered align-middle m-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>
                                                                            <div class="d-flex align-items-center">
                                                                                <span
                                                                                    class="icon-add_task me-2 fs-4"></span>
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
                                                                                <span
                                                                                    class="icon-calendar me-2 fs-4"></span>
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
                                                                <div class="alert alert-success mt-3">
                                                                    {{ session('message') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Row end -->

                                                <div class="d-flex justify-content-between">
                                                    <div class=" gap-2">
                                                        <label for="" class="">TOTAL: </label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $totalAmount }}">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="col-sm-12 col-12 mt-3">
                                                            <div class="mb-3">
                                                                @if ($order->state == 'PEDIDO')
                                                                    <button type="submit" id="botonCobrar"
                                                                        class="btn btn-primary w-100">Cobrar</button>
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

                                                        {{-- PARA CALCULAR LOS VUELTOS --}}
                                                        <div class="input-group mt-4">
                                                            <span class="input-group-text" id="basic-addon1">S/.</span>
                                                            <input id="soles" name="soles" type="text" class="form-control"
                                                                placeholder="SOLES">
                                                        </div>
                                                        <div class="input-group mt-1">
                                                            <span class="input-group-text" id="basic-addon2">$/.</span>
                                                            <input id="dolares" name="dolares" type="text" class="form-control"
                                                                placeholder="DOLARES">
                                                        </div>
                                                        <div class="input-group mt-1">
                                                            <span class="input-group-text"
                                                                id="visaSpan">BILLETERAS</span>
                                                            <input id="tarjeta" name="tarjeta" type="text" class="form-control"
                                                                placeholder="">
                                                        </div>
                                                        <div class="input-group mt-1">
                                                            <span class="input-group-text" id="basic-addon4">VUELTO</span>
                                                            <input id="vuelto" type="text" class="form-control"
                                                                placeholder="VUELTO" readonly>
                                                        </div>



                                                        <div class="col-md-12 col-12 mt-3">
                                                            <div class="mb-3">
                                                                <div class="input-group">
                                                                    <select class="form-select" id="paymentMethodSelect"
                                                                        name="payment_method">
                                                                        <option value="EFECTIVO" class="text-bg-dark">
                                                                            EFECTIVO</option>
                                                                        <option value="YAPE" class="text-bg-dark">YAPE
                                                                        </option>
                                                                        <option value="PLIN" class="text-bg-dark">PLIN
                                                                        </option>
                                                                        <option value="TARJETA" class="text-bg-dark">
                                                                            TARJETA</option>
                                                                        <option value="TUNKY" class="text-bg-dark">TUNKY
                                                                        </option>
                                                                        <option value="AMEX" class="text-bg-dark">AMEX
                                                                        </option>
                                                                        <option value="IZIPAY" class="text-bg-dark">IZIPAY
                                                                        </option>
                                                                    </select>
                                                                    <span class="input-group-text">
                                                                        <i class="icon-calendar"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>

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

        <script>
            //FUNCION EN DONDE APARECE LOS INPUT DEL CLIENTE Y SU RUC
            function toggleFields(value) {
                var facturaFields = document.getElementById('facturaFields');
                var isFactura = document.querySelector('input[name="is_factura"]');

                if (value === 'option1') {
                    facturaFields.style.display = 'block';
                    isFactura.value = '1';
                } else {
                    facturaFields.style.display = 'none';
                    isFactura.value = '0';
                }
            }
        </script>

        
        <script>
            //PARA PDOER MOSTRAR EL BOTON DE COBRO CUANDO HAYA UN VALOR EN EL INPUT
            function actualizarEstadoBotonCobrar() {
                var soles = document.getElementById('soles');
                var dolares = document.getElementById('dolares');
                var tarjeta = document.getElementById('tarjeta');
                var botonCobrar = document.getElementById('botonCobrar');

                // Verificar si alguno de los campos tiene un valor
                if (soles.value.trim() !== '' || dolares.value.trim() !== '' || tarjeta.value.trim() !== '') {
                    // Si alguno tiene un valor, activar el botón de cobrar
                    botonCobrar.disabled = false;
                } else {
                    // Si ninguno tiene un valor, desactivar el botón de cobrar
                    botonCobrar.disabled = true;
                }
            }

            // Esta función se ejecuta cuando se carga la página
            document.addEventListener('DOMContentLoaded', function() {
                // Llamar a la función para actualizar el estado del botón de cobrar al cargar la página
                actualizarEstadoBotonCobrar();

                // Agregar eventos de entrada a los campos de soles, dólares y tarjeta
                document.getElementById('soles').addEventListener('input', actualizarEstadoBotonCobrar);
                document.getElementById('dolares').addEventListener('input', actualizarEstadoBotonCobrar);
                document.getElementById('tarjeta').addEventListener('input', actualizarEstadoBotonCobrar);
            });
        </script>

        <script>
            // Obtener el monto total de la compra
            var totalAmount = {{ $totalAmount }};
            var totalIngresado = 0;

            // Función para calcular el vuelto
            function calcularVuelto() {
                // Obtener los valores de los campos de entrada de los montos
                var soles = parseFloat(document.getElementById('soles').value);
                var dolares = parseFloat(document.getElementById('dolares').value);
                var tarjeta = parseFloat(document.getElementById('tarjeta').value);

                // Verificar si los valores parseados son falsy y asignar cero en ese caso
                soles = soles || 0;
                dolares = dolares || 0;
                tarjeta = tarjeta || 0;

                // Calcular el monto total ingresado
                totalIngresado = soles + (dolares * 3.77) + tarjeta;

                // Calcular el vuelto
                if (totalIngresado > totalAmount) {
                    var vuelto = totalIngresado - totalAmount;
                    document.getElementById('vuelto').value = vuelto.toFixed(2);
                } else {
                    document.getElementById('vuelto').value = 0;
                }
                // Actualizar el campo de entrada de "VUELTO" con el resultado
                // document.getElementById('vuelto').value = vuelto.toFixed(2);
            }

            // Asignar la función calcularVuelto a los eventos oninput de los campos de entrada de los montos
            document.getElementById('soles').oninput = calcularVuelto;
            document.getElementById('dolares').oninput = calcularVuelto;
            document.getElementById('tarjeta').oninput = calcularVuelto;
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Seleccionar el elemento select y el elemento span
                const paymentMethodSelect = document.getElementById('paymentMethodSelect');
                const visaSpan = document.getElementById('visaSpan');

                // Función para actualizar el texto del span
                function updateVisaSpan() {
                    // Obtener el valor seleccionado del select
                    const selectedPaymentMethod = paymentMethodSelect.value;

                    // Actualizar el texto del span según el método de pago seleccionado
                    switch (selectedPaymentMethod) {
                        case 'YAPE':
                            visaSpan.textContent = 'YAPE';
                            break;
                        case 'PLIN':
                            visaSpan.textContent = 'PLIN';
                            break;
                        case 'TARJETA':
                            visaSpan.textContent = 'TARJETA';
                            break;
                        case 'EFECTIVO':
                            visaSpan.textContent = 'EFECTIVO';
                            break;
                        case 'TUNKY':
                            visaSpan.textContent = 'TUNKY';
                            break;
                        case 'AMEX':
                            visaSpan.textContent = 'AMEX';
                            break;
                        case 'IZIPAY':
                            visaSpan.textContent = 'IZIPAY';
                            break;
                        default:
                            // Si no coincide con ninguna opción, dejar el texto del span como está
                            // Puedes ajustar esto según sea necesario
                            visaSpan.textContent = 'Otro método de pago';
                            break;
                    }
                }

                // Llamar a la función de actualización del span al cargar la página
                updateVisaSpan();

                // Agregar un evento de cambio al elemento select
                paymentMethodSelect.addEventListener('change', function() {
                    // Llamar a la función de actualización del span cuando cambie la selección
                    updateVisaSpan();
                });
            });
        </script>



    </body>
@endsection
