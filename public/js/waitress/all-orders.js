$(function () {

    count_order = $('#count_order_waitress').val();
    if(count_order >= 1){ setInterval(contador,2000); }
    function contador(){ fecthAllOders(); /*console.log('mesera')*/;}
    

    //FECTH DE PRODUCTOS EN LA TABLA 
    //EN XAMP DEBES DE TRABAJAR CON ESTA RUTA , YA CUANDO LO SUBES AL HOSTING QUITAS EL "/pedidos/public"
    //fecthAllOders();
    function fecthAllOders() {
        // /pedidos/public/waitress/orders/fecth  : EN LOCAL
        // /waitress/orders/fecth   : EN PRODUCCION
        $.get('/waitress/orders/fecth', {}, function (data) {
            $('#allWaitressOrders').html(data.result).fadeIn();
            //console.log('datos: ' + data.result);
        }, 'json');
    }

})