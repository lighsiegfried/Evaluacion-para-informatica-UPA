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

        $(this).on('click', '#reporte_boton', function(){
            get_reporte();  
        });

        // procesa, limpiar y envia
        window.processAndClearStorage = async function () {
            dataSerial = JSON.parse(localStorage.getItem('dataSerial'));

            // particiona la fecha
            let partes = dataSerial[1].value.split("-"); 

            // organiza a dia-mes-año
            let nuevaFecha = `${partes[2]}-${partes[1]}-${partes[0]}`; 

            // convertido
            dataSerial[1].value = nuevaFecha;

             // se construye JSON a enviar por ajax
                const usuario = {
                    nombre: dataSerial[0].value,
                    fecha: dataSerial[1].value,
                    telefono: dataSerial[2].value,
                    correo: dataSerial[3].value,
                }

                try {
                    const response = await fetch("http://localhost:3000/guardar_usuario", {
                      method: "POST",
                      headers: {
                        "Content-Type": "application/json",
                      },
                      body: JSON.stringify(usuario),
                    });
                
                    if (!response.ok) {
                      throw new Error("Error al guardar el usuario");
                    }
                
                    const resultado = await response.json();
                
                    // muestra el id y que se guardo el dato
                    alert(
                      `Usuario almacenado exitosamente. ID del usuario: ${resultado.id}`
                    );
                  } catch (error) {
                    alert(error.message);
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

        function get_reporte(){
            get_limpiar();
            $('#reporte').html(set_spinner);
            $.ajax({ async: true, type: 'post', url: 'prueba_it_controlador.php', data: {
                accion: 'reporte',
            }, success: function (data) {
                $('#reporte').html(data);
            }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*ESPERAR 30 MINUTOS*/ });
        };
        

        function get_limpiar(){
            $('#inicio').html('');
            $('#formulario').html('');
            $('#reporte').html('');
        };


        
});