$(function () {

    setupEventHandlers();

    // Esta función se llama después de cargar los elementos dinámicos
    function setupEventHandlers() {
        $('#form-print-cashier').on('submit', function (e) {
            e.preventDefault(); //PARA TETENER EL RECARGE DE LA PAGINA

            //variable formulario
            var form = this;

            // Obtener el valor de order_id
            var orderId = $('#order_id').val();

            //metodo ajax
            $.ajax({
                url: $(form).attr('action'), //lee la ruta del formulario
                method: $(form).attr('method'), //metodo de envio GET|POST
                data: new FormData(form), //datos del formulario
                processData: false,
                contentType: false,
                dataType: 'json',

                beforeSend: function () {

                },

                success: function (data) {
                    if (data.code == 1) {
                        alert(data.msg);
                        //aqui podemos programar el print del pdf
                        //parametros para imprimir el pdf de origen
                        //const urlPdf = "https://parzibyte.github.io/plugin-silent-pdf-print-examples/delgado.pdf";
                        const urlPdf = "https://agape.familc.com/cajera/generate/factura/pdf/4";
                        const nombreImpresora = "EPSON";
                        const url = `http://localhost:8080/url?urlPdf=${urlPdf}&impresora=${nombreImpresora}`;

                        /*peticion FETCH
                        fetch(url).then(respuesta => {
                            if (respuesta.status === 200) {
                                alert('datos impresos');
                                // Descargar el PDF directamente
                                respuesta.blob().then(blob => {
                                    const url = window.URL.createObjectURL(blob);
                                    const a = document.createElement('a');
                                    a.href = url;
                                    a.download = 'boleta.pdf';
                                    document.body.appendChild(a);
                                    a.click();
                                    window.URL.revokeObjectURL(url);
                                });
                            } else {
                                alert('Error al descargar PDF: verifique la impresora esta compartida e instalada');
                            }
                        })
                            .catch(error => {
                                alert('El servidor de Impresión no se cuentra activado en este dispositivo: ' + error);
                            });*/

                        // Abrir una nueva ventana del navegador con el PDF generado
                        const nuevaVentana = window.open(urlPdf, '_blank');
                        // Una vez que la ventana se haya cargado completamente
                        nuevaVentana.onload = function () {
                            // Invocar el diálogo de impresión del navegador
                            nuevaVentana.print();
                        };

                    } else {
                        alert('no se actulizo la tabla');
                    }
                }
            });
        });
    }


    //para abrir la impresio y mandar a imprimir


});