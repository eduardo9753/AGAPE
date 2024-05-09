$(function () {
    
    count_order = $('#count_order_delivery').val();
    if(count_order >= 1){ setInterval(contador,2000); }
    function contador(){ fecthAllOdersDelivery(); /*console.log('caja')*/;}
    

    //FECTH DE PRODUCTOS EN LA TABLA 
    //EN XAMP DEBES DE TRABAJAR CON ESTA RUTA , YA CUANDO LO SUBES AL HOSTING QUITAS EL "/pedidos/public"
    //fecthAllOdersDelivery();
    function fecthAllOdersDelivery() {
        // /pedidos/public/cajera/orders/delivery/fecth  : EN LOCAL
        // /cajera/orders/delivery/fecth   : EN PRODUCCION
        $.get('/cajera/orders/delivery/fecth', {}, function (data) {
            $('#allOrdersDelivery').html(data.result).fadeIn();
           //console.log('datos: ' + data.result);
        }, 'json');
    }

})