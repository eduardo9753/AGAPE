<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden #{{ $order->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            margin: 0.5px auto;
            background-color: #fff;
            padding: 0.5px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 5px;
        }

        .header h1 {
            color: #333;
            font-size: 1.2em; /* Tamaño de fuente más pequeño */
            margin: 0;
        }

        .info h5 {
            font-size: 0.8em; /* Tamaño de fuente más pequeño */
            margin: 5px 0;
        }

        .table th,
        .table td {
            border-bottom: 1px solid #ddd;
            text-align: right;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .total p {
            margin: 5px 0;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }

        .logo img {
            width: 100%; /* Ajusta el ancho de la imagen al contenedor */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            {{--<img src="{{ asset('asserts/images/login.svg') }}" alt="Logo de la empresa">--}}
        </div>
        <div class="header">
            <h6>Orden #{{ $order->id }}</h6>
        </div>
        <div class="address">
            <h6><strong>Razón Social:</strong> Ágape Chicken & Grill</h6>
            <h6><strong>Dirección: </strong> parque sinchi roc, Av. Universitaria 9311, Comas 15316</h6>
            <h6><strong>RUC: </strong> 20523287568 </h6>
        </div>
        <div class="info">
            <h6><strong>Mesa:</strong> {{ $order->table->name }}</h6>
            <h6><strong>Fecha:</strong>
                {{ \Carbon\Carbon::parse($order->payment_date)->formatLocalized('%d de %B de %Y') }}</h6>
            <h6><strong>Hora:</strong> {{ \Carbon\Carbon::parse($order->payment_time)->format('h:i A') }}</h6>
            <h6><strong>Número de Boleta:</strong> BOL-000{{ $order->id }}</h6>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        <h6>Produc</h6>
                    </th>
                    <th>
                        <h6>Precio</h6>
                    </th>
                    <th>
                        <h6>Cant</h6>
                    </th>
                    <th>
                        <h6>Total</h6>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderDishes as $orderDish)
                    <tr>
                        <td>
                            <h6>{{ $orderDish->dish->name }}</h6>
                        </td>
                        <td>
                            <h6>{{ $orderDish->dish->price }}</h6>
                        </td>
                        <td>
                            <h6>{{ $orderDish->quantity }}</h6>
                        </td>
                        <td>
                            <h6>{{ number_format($orderDish->dish->price * $orderDish->quantity, 2) }}</h6>
                        </td>
                        <!-- Aquí se calcula el total -->
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="total">
            <h6><strong>Total Pagado:</strong> S/.{{ $totalAmount }}</h6>
        </div>
        <div class="footer">
            <h6>Gracias por su compra - <strong>{{ $order->table->name }}</strong></h6>
        </div>
    </div>
</body>

</html>
