$(function () {

    count_order = $('#count_table_cashier').val();
    if(count_order >= 1){ setInterval(contador,100000); }
    function contador(){ fecthAllTables(); /*console.log('mesas')*/;}
    

    //FECTH DE PRODUCTOS EN LA TABLA 
    //EN XAMP DEBES DE TRABAJAR CON ESTA RUTA , YA CUANDO LO SUBES AL HOSTING QUITAS EL "/pedidos/public"
    fecthAllTables();
    function fecthAllTables() {
        // /pedidos/public/cajera/tables/fecth  : EN LOCAL
        // /cajera/tables/fecth   : EN PRODUCCION
        $.get('/cajera/tables/fecth', {}, function (data) {
            $('#allTablesCashier').html(data.result).fadeIn();
            //console.log('datos: ' + data.result);
        }, 'json');
    }

})