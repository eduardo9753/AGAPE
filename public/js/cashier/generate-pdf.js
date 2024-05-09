$(function () {

    // PRECUENTA
    precuentaImpresionVentanaActual();
    function precuentaImpresionVentanaActual() {
        $('[id^="form-print-cashier"]').on('submit', function (e) {
            e.preventDefault(); // Para evitar la recarga de la página

            //variable formulario
            var form = this;

            // Obtener el valor de order_id
            var orderId = $(form).find('input[name="order_id"]').val();

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
                            timer: 1500
                        })

                        // Construir la URL del PDF
                        const urlPdf = `https://agapechicken.com/generar-pdf/${orderId}`;
                        //const urlPdf = `http://127.0.0.1:8000/generar-pdf/${orderId}`;

                        // Crear un nuevo objeto de tipo iframe
                        var iframe = document.createElement('iframe');
                        iframe.src = urlPdf;
                        iframe.style.display = 'none';

                        // Adjuntar el iframe al cuerpo del documento
                        document.body.appendChild(iframe);

                        // Esperar a que el iframe se haya cargado completamente
                        iframe.onload = function () {
                            // Llamar a la función de impresión del iframe
                            iframe.contentWindow.print();

                            // Recargar la página después de 3 segundos (ajustar según sea necesario)
                            setTimeout(function () {
                                location.reload();
                            }, 15000);
                        };

                    } else if (data.code == 0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: data.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else if (data.code == 2) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            title: data.msg,
                            showConfirmButton: false,
                            timer: 3500
                        }).then(function () {
                            location.reload();
                        });
                    }
                }
            });
        });
    }



    //COMANDA
    imprimirCocina();
    function imprimirCocina() {
        $('[id^="form-print-cashier-kitchen"]').on('submit', function (e) {
            e.preventDefault(); //PARA TETENER EL RECARGE DE LA PAGINA

            // Obtener el valor de order_id
            var orderId = $(this).find('input[name="order_id"]').val();

            // Construir la URL del PDF
            const urlPdf = `https://agapechicken.com/generar-pdf/comanda/${orderId}`;
            //const urlPdf = `http://127.0.0.1:8000/generar-pdf/comanda/${orderId}`;

            // Crear un nuevo objeto de tipo iframe
            var iframe = document.createElement('iframe');
            iframe.src = urlPdf;
            iframe.style.display = 'none';

            // Adjuntar el iframe al cuerpo del documento
            document.body.appendChild(iframe);

            // Esperar a que el iframe se haya cargado completamente
            iframe.onload = function () {
                // Llamar a la función de impresión del iframe
                iframe.contentWindow.print();
            };

            // Eliminar el iframe después de un tiempo de espera
            setTimeout(function () {
                document.body.removeChild(iframe);
            }, 15000);

        });
    }


    //para abrir la impresio y mandar a imprimir


});