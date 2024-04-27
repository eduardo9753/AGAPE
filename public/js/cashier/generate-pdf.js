$(function () {

    precuentaImpresionVentanaActual();

    // Esta función se llama después de cargar los elementos dinámicos
    function precuentaImpresionVentanaActual() {
        $('[id^="form-print-cashier"]').on('submit', function (e) {
            e.preventDefault(); //PARA TETENER EL RECARGE DE LA PAGINA

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
                        }, 10000);// Espera 10 segundos antes de eliminar el iframe (ajusta este valor según sea necesario)

                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'no se actulizo la tabla',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            });
        });
    }

    //funcion para abrir el pdf en la misma venta y mandar a imprimir
    imprimirCocina();
    function imprimirCocina() {
        $('[id^="form-print-cashier-kitchen"]').on('submit', function (e) {
            e.preventDefault(); //PARA TETENER EL RECARGE DE LA PAGINA

            // Obtener el valor de order_id
            var orderId = $(this).find('input[name="order_id"]').val();

            // Construir la URL del PDF
            const urlPdf = `https://agapechicken.com/generar-pdf/${orderId}`;

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
            }, 10000); // Espera 10 segundos antes de eliminar el iframe (ajusta este valor según sea necesario)
        });
    }


    //para abrir la impresio y mandar a imprimir


});