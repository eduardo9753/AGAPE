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
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
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
            padding: 2px; /* Padding más pequeño */
            border-bottom: 1px solid #ddd;
            text-align: left;
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
            <img src="{{ asset('img/logo.png') }}" alt="Logo de la empresa">
        </div>
        <div class="header">
            <h6>Orden #{{ $order->id }}</h6>
        </div>
        <div class="address">
            <h5><strong>Razón Social:</strong> Ágape Chicken & Grill</h5>
            <h5><strong>Dirección: </strong> parque sinchi roc, Av. Universitaria 9311, Comas 15316</h5>
            <h5><strong>RUC: </strong> 20523287568 </h5>
        </div>
        <div class="info">
            <h5><strong>Mesa:</strong> {{ $order->table->name }}</h5>
            <h5><strong>Fecha:</strong>
                {{ \Carbon\Carbon::parse($order->payment_date)->formatLocalized('%d de %B de %Y') }}</h5>
            <h5><strong>Hora:</strong> {{ \Carbon\Carbon::parse($order->payment_time)->format('h:i A') }}</h5>
            <h5><strong>Número de Boleta:</strong> BOL-000{{ $order->id }}</h5>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        <h5>Produc</h5>
                    </th>
                    <th>
                        <h5>Precio</h5>
                    </th>
                    <th>
                        <h5>Cant</h5>
                    </th>
                    <th>
                        <h5>Total</h5>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderDishes as $orderDish)
                    <tr>
                        <td>
                            <h5>{{ $orderDish->dish->name }}</h5>
                        </td>
                        <td>
                            <h5>{{ $orderDish->dish->price }}</h5>
                        </td>
                        <td>
                            <h5>{{ $orderDish->quantity }}</h5>
                        </td>
                        <td>
                            <h5>{{ number_format($orderDish->dish->price * $orderDish->quantity, 2) }}</h5>
                        </td>
                        <!-- Aquí se calcula el total -->
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="total">
            <h5><strong>Total Pagado:</strong> S/.{{ $totalAmount }}</h5>
        </div>
        <div class="footer">
            <h5>Gracias por su compra - <strong>{{ $order->table->name }}</strong></h5>
        </div>
    </div>
</body>

</html>
