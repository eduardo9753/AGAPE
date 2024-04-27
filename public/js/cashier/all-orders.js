$(function () {

    count_order = $('#count_order').val();
    if(count_order >= 1){ setInterval(contador,1000); }
    function contador(){ fecthAllOders(); /*console.log('caja')*/;}
    

    //FECTH DE PRODUCTOS EN LA TABLA 
    //EN XAMP DEBES DE TRABAJAR CON ESTA RUTA , YA CUANDO LO SUBES AL HOSTING QUITAS EL "/pedidos/public"
    //fecthAllOders();
    function fecthAllOders() {
        // /pedidos/public/cajera/orders/fecth  : EN LOCAL
        // /cajera/orders/fecth   : EN PRODUCCION
        $.get('/cajera/orders/fecth', {}, function (data) {
            $('#allOrders').html(data.result).fadeIn();
            //console.log('datos: ' + data.result);
        }, 'json');
    }

})