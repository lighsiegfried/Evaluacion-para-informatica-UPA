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

        $(this).on('click', '#reporte_general', function(){
            cargarReporte();
        });

        $(this).on('click', '#reporte_creados_hoy', function(){
            cargarHoy();
        });

        $(this).on('click', '#reporte_creados_ayer', function(){
            cargarAyer();
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

        function cargarReporte(){
            let url;
            url = 'http://localhost:3000/ejecutar_reporte/';
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error al obtener los datos: ${response.statusText}`);
                    }
                    return response.json(); // Convierte la respuesta a JSON
                })
                .then(data => {
                    //traspasar data en json
                    data.data = data.data.map(item => ({ 
                        ...item, 
                        creacion: new Date(item.creacion).toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' }), 
                        fecha: new Date(item.fecha).toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' }) 
                    }));
                    
                    console.log("data reporte: ",data.data);
                    get_reporte_general(data.data);
                })
                .catch(error => {
                    console.error("Error al cargar el reporte:", error);
                    alert("Ocurrió un error al cargar el reporte. Revisa la consola para más detalles.");
                });
        }

        function cargarHoy(){
            let url;
            url = 'http://localhost:3000/ejecutar_reporte/';
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error al obtener los datos: ${response.statusText}`);
                    }
                    return response.json(); // Convierte la respuesta a JSON
                })
                .then(data => {
                    //traspasar data en json
                    data.data = data.data.map(item => ({ 
                        ...item, 
                        creacion: new Date(item.creacion).toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' }), 
                        fecha: new Date(item.fecha).toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' }) 
                    }));

                    const hoy = new Date().toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' });

                    // filtrar solo los elementos creados hoy, desde el front
                    data.data = data.data.filter(item => item.creacion === hoy);
                    
                    console.log("data reporte: ",data.data);
                    get_reporte_hoy(data.data);
                })
                .catch(error => {
                    console.error("Error al cargar el reporte:", error);
                    alert("Ocurrió un error al cargar el reporte. Revisa la consola para más detalles.");
                });
        }


        function cargarAyer(){
            let url;
            url = 'http://localhost:3000/ejecutar_reporte/';
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error al obtener los datos: ${response.statusText}`);
                    }
                    return response.json(); // Convierte la respuesta a JSON
                })
                .then(data => {
                    //traspasar data en json
                    data.data = data.data.map(item => ({ 
                        ...item, 
                        creacion: new Date(item.creacion).toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' }), 
                        fecha: new Date(item.fecha).toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' }) 
                    }));

                    const hoy = new Date();
                    hoy.setDate(hoy.getDate() -1); //resto un dia para general el dia despues o ayer, siempre
                    const diaAnterior = hoy.toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' });

                    // filtrar solo los elementos creados hoy, desde el front
                    data.data = data.data.filter(item => item.creacion === diaAnterior);

                    console.log("data reporte: ",data.data);
                    get_reporte_ayer(data.data);
                })
                .catch(error => {
                    console.error("Error al cargar el reporte:", error);
                    alert("Ocurrió un error al cargar el reporte. Revisa la consola para más detalles.");
                });
        }
     
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

        function get_reporte_general(data){
            get_limpiar();
            $('#reporte').html(set_spinner);
            $.ajax({ async: true, type: 'post', url: 'prueba_it_controlador.php', data: {
                accion: 'reporte_general',
                data
            }, success: function (data) {
                $('#reporte').html(data);
            }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*ESPERAR 30 MINUTOS*/ });
        };

        function get_reporte_hoy(data){
            get_limpiar();
            $('#reporte').html(set_spinner);
            $.ajax({ async: true, type: 'post', url: 'prueba_it_controlador.php', data: {
                accion: 'reporte_creados_hoy',
                data
            }, success: function (data) {
                $('#reporte').html(data);
            }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*ESPERAR 30 MINUTOS*/ });
        };

        function get_reporte_ayer(data){
            get_limpiar();
            $('#reporte').html(set_spinner);
            $.ajax({ async: true, type: 'post', url: 'prueba_it_controlador.php', data: {
                accion: 'reporte_creados_ayer',
                data
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