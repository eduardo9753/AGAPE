$(function () {

    setupEventHandlers();

    // Esta función se llama después de cargar los elementos dinámicos
    function setupEventHandlers() {
        $('#form-print-cashier').on('submit', function (e) {
            e.preventDefault(); //PARA TETENER EL RECARGE DE LA PAGINA

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
                        //aqui podemos programar el print del pdf
                        //parametros para imprimir el pdf de origen
                        //const urlPdf = "https://parzibyte.github.io/plugin-silent-pdf-print-examples/delgado.pdf";
                        const urlPdf = "https://agape.familc.com/generar-pdf/16";
                        const nombreImpresora = "CUENTA";
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
                                alert('Error al descargar PDF');
                            }
                        })
                            .catch(error => {
                                alert('Error: ' + error);
                            });

                    } else {
                        alert('no se actulizo la tabla');
                    }
                }
            });
        });
    }


});
