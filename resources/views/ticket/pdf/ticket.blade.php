<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden #{{ $order->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 0 auto;
            width: 80mm;
            /* Ancho del papel térmico */
            padding: 10px;
            text-align: center;
            font-size: 12px;
        }

        .header {
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 14px;
        }

        .info {
            text-align: left;
            margin-bottom: 10px;
        }

        .info p {
            margin: 0;
            line-height: 1.5;
        }

        .products {
            text-align: left;
            margin-bottom: 10px;
        }

        .products ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .products li {
            margin-bottom: 5px;
        }

        .products li span {
            display: inline-block;
            width: 40%;
            text-align: left;
        }

        .total {
            margin-bottom: 10px;
            text-align: left;
        }

        .total p {
            margin: 0;
        }

        .footer {
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Agape Chicken & Grill</h1>
            <p>------------------------------------------------</p>
            <p>PEDIDO #{{ $order->id }}</p>
            <p>------------------------------------------------</p>
        </div>
        <div class="info">
            <p>Domicilio:</p>
            <p>parque sinchi roc, Av. Universitaria 9311, Comas 15316</p>
            <p>hora: {{ \Carbon\Carbon::parse($order->payment_time)->format('h:i A') }}</p>
            <p></p>
            <p></p>
        </div>
        <div class="products">
            <p>Productos</p>
            <ul>
                @foreach ($order->orderDishes as $orderDish)
                    <li>
                        <span>{{ $orderDish->quantity }}</span>
                        <span>{{ $orderDish->dish->name }}</span>
                        <span>S/. {{ $orderDish->dish->price }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="total">
            <p>total: S/. {{ $totalAmount }}</p>
        </div>
        <div class="footer">
            <p>Gracias por su compra</p>
        </div>
    </div>
</body>

</html>
