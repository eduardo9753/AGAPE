$(function () {

    count_order = $('#count_table_waitress').val();
    if(count_order >= 1){ setInterval(contador,1000); }
    function contador(){ fecthAllTables(); /*console.log('mesas')*/;}
    

    //FECTH DE PRODUCTOS EN LA TABLA 
    //EN XAMP DEBES DE TRABAJAR CON ESTA RUTA , YA CUANDO LO SUBES AL HOSTING QUITAS EL "/pedidos/public"
    //fecthAllTables();
    function fecthAllTables() {
        // /pedidos/public/waitress/tables/fecth  : EN LOCAL
        // /waitress/tables/fecth   : EN PRODUCCION
        $.get('/waitress/tables/fecth', {}, function (data) {
            $('#allTablesWaitress').html(data.result).fadeIn();
            //console.log('datos: ' + data.result);
        }, 'json');
    }

})