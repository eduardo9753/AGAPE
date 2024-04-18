<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Boleta</title>
</head>

<body>
    <div class="center bold underline">Boleta</div>
   
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
    <div class="bold">TOTAL: {{ $order->id }}</div>
</body>

</html>
