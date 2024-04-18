$(function () {

    setupEventHandlers();

    // Esta función se llama después de cargar los elementos dinámicos
    function setupEventHandlers() {
        $('#form-print-cashier').on('submit', function (e) {
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
                        alert(data.msg);
                        // Aquí podemos programar la impresión del PDF
                        // Parámetros para imprimir el PDF de origen
                        //const urlPdf = `https://agape.familc.com/generar-pdf/${orderId}`;
                        const urlPdf = "https://agape.familc.com/generar-pdf/17";
                        const nombreImpresora = "Microsoft Print to PDF";
                        const url = `http://localhost:8080/url?urlPdf=${urlPdf}&impresora=${nombreImpresora}`;

                        //peticion FETCH
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
                               respuesta.json()
                               .then(mensaje => {
                                  alert("Error: " + mensaje)
                               })
                            }
                        })
                            .catch(error => {
                                alert('El servidor de Impresión no se cuentra activado en este dispositivo: ' + error);
                            });

                    } else {
                        alert('no se actulizo la tabla');
                    }
                }
            });
        });
    }


});
