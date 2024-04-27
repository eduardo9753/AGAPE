$(function () {

    setupEventHandlers();

    // Esta función se llama después de cargar los elementos dinámicos
    function setupEventHandlers() {
        $('#form-print-waitress').on('submit', function (e) {
            e.preventDefault(); //PARA TETENER EL RECARGE DE LA PAGINA

            // Obtener el valor de order_id desde el campo oculto en el formulario
            var orderId = $('#order_id').val();

            //variable formulario
            var form = this;

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
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: data.msg,
                            showConfirmButton: false,
                            timer: 3500
                        })
                        //aqui podemos programar el print del pdf
                        //const urlPdf = "https://parzibyte.github.io/plugin-silent-pdf-print-examples/delgado.pdf";
                        const urlPdf = `https://agapechicken.com/generar-pdf/${orderId}`;
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

                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'no se actulizo la tabla',
                            showConfirmButton: false,
                            timer: 3500
                        })
                    }
                }
            });
        });
    }


});
