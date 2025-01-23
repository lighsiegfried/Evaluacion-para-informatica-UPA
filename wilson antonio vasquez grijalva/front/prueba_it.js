$(document).ready(function() {
    // variables  globales
    var set_spinner=`<div class="d-flex justify-content-center"> <div class="spinner-border text-primary" role="status"> <span class="sr-only"></span> </div> </div>`;
    var dataSerial="";
    //--------------------------------------------------------------------------------------------------------------------------------------------------------------
        
        //Botones de accion y funciones
        $(this).on('click', '#regresar_boton', function(){
            get_limpiar();
            get_contenido();
        });

        $(this).on('click', '#formulario_boton', function(){
            get_formulario();
        });

        // procesa y limpiar 
        window.processAndClearStorage = function () {
            dataSerial = JSON.parse(localStorage.getItem('dataSerial'));
        
            if (dataSerial) {
                //Informacion lista para mandar al servidor
                //console.log('Informacion lista para mandar al servidor: ', dataSerial);
            }
        };
    //--------------------------------------------------------------------------------------------------------------------------------------------------------------
    //Acciones

        //inicia funcion principal
        get_contenido();

        //contenedor de funciones a desplegar
        function get_contenido(){
            get_menu(); 
        };

        function get_menu(){
            get_limpiar();
            $('#inicio').html(set_spinner);
            $.ajax({ async: true, type: 'post', url: 'prueba_it_controlador.php', data: {
                accion: 'inicio',
            }, success: function (data) {
                $('#inicio').html(data);
            }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*ESPERAR 30 MINUTOS*/ });
        };

        function get_formulario(){
            get_limpiar();
            $('#formulario').html(set_spinner);
            $.ajax({ async: true, type: 'post', url: 'prueba_it_controlador.php', data: {
                accion: 'formulario',
            }, success: function (data) {
                $('#formulario').html(data);
            }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*ESPERAR 30 MINUTOS*/ });
        };

        function get_limpiar(){
            $('#inicio').html('');
            $('#formulario').html('');
        };

});