<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
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
            <!-- Establecer el ancho máximo del logo-->
            <img src="{{ asset('img/logo.png') }}" alt="Logo de la empresa" style="max-width: 100%;">
        </div>
        <div class="header">
            <h1>Reporte de Ventas - Agape</h1>
        </div>
        <div class="address">
            <p><strong>Razon Social:</strong> Agape Chicken & Grill</p>
            <p><strong>Direccion: </strong> parque sinchi roc, Av. Universitaria 9311, Comas 15316</p>
            <p><strong>RUC: </strong> 20523287568 </p>
        </div>
        <div class="info">
            <p><strong>Generado por:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Desde {{ $request->fecha_inicio }} al {{ $request->fecha_final }}</strong></p>
            <p><strong>Hora:</strong> {{ date('H:i:s') }}</p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th># de Ordenes cobradas</th>
                    <th>Monto Total</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>{{ $totalOrders }}</td>
                    <td>S/.{{ $totalAmount }}</td>
                    <!-- Aquí se calcula el total -->
                </tr>

            </tbody>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th>CANT. YAPE</th>
                    <th>CANT. EFECTIVO</th>
                    <th>CANT. TARJETA</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>S/.{{ $totalYAPEOrders }}</td>
                    <td>S/.{{ $totalEFECTIVOrders }}</td>
                    <td>S/.{{ $totalTARJETAOrders }}</td>
                </tr>

            </tbody>
        </table>
        <div class="total">
            <p><strong>Total Pagado:</strong> S/.{{ $totalAmount }}</p>
        </div>
        <div class="footer">
            <p>--- Para Tacuchi ---</strong></p>
        </div>
    </div>
</body>

</html>
