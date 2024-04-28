<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta de Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10px;
            /* Tamaño de fuente más pequeño */
        }

        .container {
            width: 180px;
            /* Ancho de la boleta */
            margin: 0 auto;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 14px;
            /* Tamaño de fuente del encabezado */
            margin: 0;
        }

        .info p {
            margin: 2px 0;
            /* Espaciado reducido */
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .table th,
        .table td {
            padding: 2px;
            border-bottom: 1px solid #ddd;
            text-align: left;
            font-size: 8px;
            /* Tamaño de fuente más pequeño */
        }

        .table th {
            background-color: #f2f2f2;
        }

        .total p {
            margin: 2px 0;
            /* Espaciado reducido */
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 10px;
            color: #777;
            font-size: 8px;
            /* Tamaño de fuente más pequeño */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <!-- Establecer el ancho máximo del logo -->
            <img src="{{ asset('img/logo.png') }}" alt="Logo de la empresa" style="max-width: 100%;">
        </div>

        <div class="header">
            <p>------------------------------------------------</p>
            <p>AGAPE CHICKEN & GRILL</p>
            <p>------------------------------------------------</p>
            <p>------------------------------------------------</p>
            <p>MOZO: {{ $order->user->name }}</p>
            <p>------------------------------------------------</p>
            <p>------------------------------------------------</p>
            <p>COMANDA</p>
            <p>------------------------------------------------</p>
            <p>------------------------------------------------</p>
            <p>N:{{ $order->table->name }}</p>
            <p>------------------------------------------------</p>
            <p>------------------------------------------------</p>
            <p>PEDIDO #{{ $order->id }}</p>
            <p>------------------------------------------------</p>
        </div>
        <div class="info">
            <p>------------------------------------------------</p>
            <p>hora: {{ \Carbon\Carbon::parse($order->payment_time)->format('h:i A') }}</p>
            <p>------------------------------------------------</p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>PRODUCTO|</th>
                    <th>CANTIDA|</th>
                    <th>PRECIO|</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderDishes as $orderDish)
                    <tr>
                        <td>{{ $orderDish->dish->name }}|</td>
                        <td>{{ $orderDish->quantity }}|</td>
                        <td>S/.{{ number_format($orderDish->dish->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="total">
            <p>------------------------------------------------</p>
            <p><strong>Total:</strong> S/.{{ number_format($totalAmount, 2) }}</p>
            <p>------------------------------------------------</p>
        </div>
        <div class="footer">
            <p>GRACIAS POR SU COMPRA</p>
            <p>------------------------------------------------</p>
            <p>parque sinchi roca, Av. Universitaria 9311, Comas 15316</p>
            <p>------------------------------------------------</p>
        </div>
    </div>
</body>

</html>
