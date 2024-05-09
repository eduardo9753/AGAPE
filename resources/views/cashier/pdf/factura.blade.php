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
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
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
            font-size: 32px;
            margin: 0;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 5px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .total {
            margin-top: 20px;
            text-align: right;
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

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 150px;
        }

        .address {
            margin-bottom: 20px;
        }

        .address p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo de la empresa">
        </div>
        <div class="header">
            <h1>Factura de Venta</h1>
        </div>
        <div class="address">
            <p><strong>Razon Social:</strong> Agape Chicken & Grill</p>
            <p><strong>Direccion: </strong> parque sinchi roc, Av. Universitaria 9311, Comas 15316</p>
            <p><strong>RUC: </strong> 20523287568 </p>
        </div>
        <div class="info">
            <p><strong>Cliente:</strong> {{ $pay->order->customer->name }}</p>
            <p><strong>Fecha:</strong>
                {{ \Carbon\Carbon::parse($pay->payment_date)->formatLocalized('%d de %B de %Y') }}</p>
            <p><strong>Hora:</strong> {{ \Carbon\Carbon::parse($pay->payment_time)->format('h:i A') }}</p>
            <p><strong># de pedido:</strong> #00{{ $pay->order->order_number }}</p>
            <p><strong>pago con:</strong> {{ $pay->cash_payment }}</p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pay->order->orderDishes as $orderDish)
                    <tr>
                        <td>{{ $orderDish->dish->name }}</td>
                        <td>{{ $orderDish->dish->price }}</td>
                        <td>{{ $orderDish->quantity }}</td>
                        <td>{{ number_format($orderDish->dish->price * $orderDish->quantity, 2) }}</td>
                        <!-- Aquí se calcula el total -->
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="total">
            <p><strong>Total Pagado:</strong> S/.{{ $totalAmount }}</p>
        </div>
        <div class="footer">
            <p>Gracias por su compra - <strong>{{ $pay->order->customer->name }}</strong></p>
        </div>
    </div>
</body>

</html>
