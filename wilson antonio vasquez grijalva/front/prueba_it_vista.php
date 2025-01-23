<?php
//clase vista para visualizar cada modulo de vistas por separado y organiza el codigo html
class prueba_it_vista{
    public function __construct(){
    }
    function inicio()
        {
        ?>
            <div class="text-center"> <h2>Bienvenido Wilson!</h2> </div>
            <div class="mt-3"></div>
                <div class="d-inline-flex p-2 bd-highlight"> 
                    <div class="col-md-auto">
                        <div class="card shadow">
                            <div class="card-header d-flex justify-content-between" id="encabezado" >
                                <h5><i class="bi bi-clipboard-data" style="font-size: 1.7rem;"></i>Informacion </h5>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-md-center">
                                    <div class="col-md-auto">
                                        <div class="table-responsive">
                                            <div class="mt-3"></div>
                                            <div class="d-flex justify-content-center">
                                                <div class="col-auto">
                                                    <button id="formulario_boton" type="button" class="btn btn-outline-primary btn-lg ">Formulario</button>
                                                </div>
                                            </div>
                                            <div class="mt-2"></div>
                                            <hr>
                                            <div class="mt-2"></div>
                                            <div class="d-flex justify-content-center">
                                                
                                                <div class="col-auto">
                                                    <button id="reporte_boton" type="button" class="btn btn-outline-success btn-lg ">Reportes</button>
                                                </div>
                                            </div>
                                            <div class="mt-4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
    } 


    function formulario()
    {
    ?>  
        <div id="seccion_formulario"> 
            <div class="text-center"> <h2>FORMULARIO</h2> </div>
            <form id="formulario_consulta" method="post">
                <div class="mx-5"> 
                    <div class="card shadow">
                        <div class="d-flex justify-content-between card-header ">
                            <h5><i class="bi bi-clipboard-data" style="font-size: 1.7rem;"></i>Formulario  </h5> <div >  <?php $this->boton_atras(); ?></div>
                        </div>
                        <div class="card-body">
                            <div class="justify-content-center">
                                <div class="col-md-auto">
                                    <div class="d-flex justify-content-start mt-3">
                                        <div class="col-3 text-right" title="USER">
                                            Nombre de usuario:
                                        </div>
                                        <div class="col" title="USER">
                                            <input class="form-control form-control-sm" pattern="[A-Za-z\s]+" title="Por favor, ingresa solo letras y espacios." name="name_user" id="name_user" type="text" required>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-start mt-3">
                                        <div class="col-3 text-right" title="NACIMIENTO">
                                            Fecha de nacimiento:
                                        </div>
                                        <div class="col" title="NACIMIENTO">
                                            <input class="form-control form-control-sm" name="fec" id="fec" type="date" required>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-start mt-3">
                                        <div class="col-3 text-right" title="EDAD">
                                            Edad:
                                        </div>
                                        <div class="col" title="EDAD">
                                            <input class="form-control form-control-sm" name="edad" id="edad" type="number" disabled value="0">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-start mt-3" title="TELEFONO">
                                        <div class="col-3 text-right">
                                            Numero de telefono:
                                        </div>
                                        <div class="col" title="TELEFONO">
                                            <input class="form-control form-control-sm" name="tel" id="tel" type="number" step="any" required>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-start mt-3" title="E-MAIL">
                                        <div class="col-3 text-right">
                                            Correo:
                                        </div>
                                        <div class="col" title="E-MAIL">
                                            <input class="form-control form-control-sm" name="mail" id="mail" type="email" placeholder="ejemplo@mail.com" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button id="capturar" type="submit" class="btn btn-primary">
                                <i class="material-icons">search</i> Buscar
                            </button>  
                        </div>
                        <div class="mt-3"></div>    
                    </div>
                </div>
            </form>
        </div>
        <script>
            //funcion especial para esta vista...

            //evita numeros y simbolos en el input de usuario
            $(document).on('input', '#name_user', function () {
                $(this).val($(this).val().replace(/[^A-Za-z\s]/g, ''));
            });

            $(document).on('input', '#tel', function () {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });

            //valida el correo
            document.getElementById('mail').addEventListener('input', function() {
                const email = this.value;
                const cambio = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                if (!cambio.test(email)) {
                this.setCustomValidity('Por favor, ingrese un correo electrónico válido.');
                } else {
                this.setCustomValidity('');
                }
            });

            $('#formulario_consulta').on('submit', function(event) {
                event.preventDefault(); 
                var dataSerializada = $(this).serializeArray(); // lo convierte a un array
                localStorage.setItem('dataSerial', JSON.stringify(dataSerializada)); //serializo y envio la variable al js principal, no es la mejor pero la mas optima para este ejercicio.
                //limpia eventos guardados previamente
                if (window.processAndClearStorage) {
                    window.processAndClearStorage();
                }

            });

            //calculo de edad
            function calcularEdad(fechaNacimiento) {
                var fechaNach = new Date(fechaNacimiento);
                var hoy = new Date();
                var edad = hoy.getFullYear() - fechaNach.getFullYear();
                return edad; 
            }

            
            document.addEventListener("change", function (event) {
                if (event.target && event.target.id === "fec") {
                    var fechaSeleccionada = event.target.value;
                    var edad = calcularEdad(fechaSeleccionada);
                    $("#edad").val(edad);
                }
            });

        </script>
    <?php
    } 

    function reporte()
    {
    ?>
        <div id="seccion_reporte">
            <div class="text-center"> <h2>REPORTE</h2> </div>
            <div class="mt-3"></div>
            <form id="reportes" method="post">
                <div class="d-inline-flex p-2 bd-highlight"> 
                    <div class="col-md-auto">
                        <div class="card shadow">
                            <div class="card-header d-flex d-flex justify-content-between" >
                                <h5><i class="bi bi-clipboard-data" style="font-size: 1.7rem;"></i>Reporte </h5> <div >  <?php $this->boton_atras(); ?></div>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-md-center">
                                    <div class="col-md-auto">
                                        <div class="table-responsive">
                                            
                                            <div class="mt-3"></div> 
                                                <button id="reporte_general" type="button" class="btn btn-outline-success ">Reporte de todos los usuarios</button>
                                            <div class="mt-3"></div>
                                                <button id="reporte_creados_hoy" type="button" class="btn btn-outline-info ">Reporte creados hoy</button>
                                            <div class="mt-3"></div>
                                                <button id="reporte_creados_ayer" type="button" class="btn btn-outline-secondary ">Reporte creados ayer</button>
                                            <div class="mt-3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <?php
    } 


    function reporte_general($data)
    { 
        if ($data){
            ?>     
            <style>
                .form-check-input 
                {
                    scale: 2; 
                    margin-top: 10px;
                    margin-left: 0px;
                    margin-right: 0px;
                    box-shadow: none;
                }
                .enlace-especifico {
                    outline: none;
                    text-decoration: none;
                    padding: 2px 1px 0;
                }

                .enlace-especifico:visited {
                    color: #288df7; 
                }

                .enlace-especifico:focus {
                    border-bottom: 1px solid;
                    background: #d4abb0;
                }

                .enlace-especifico:hover {
                    border-bottom: 1px solid;
                    background: #d4abb0;
                }

                .enlace-especifico:active {
                    background: #7d0211;
                    color: #d4abb0;
                }
                .fox { 
                    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
                }
                .fox2 { 
                    box-shadow: 7px 7px 5px rgba(0, 0, 0, 0.2);
                }
            </style>
            <div class="mt-5 "></div>
            <div class="d-inline-flex p-2 bd-highlight"> 
                    <div class="d-flex justify-content-start">
                        <div class="col-md-auto">
                            <div class="card shadow">
                                <div class="card-header d-flex justify-content-between">
                                    <h5><i class="bi bi-clipboard-check" style="font-size: 1.7rem;"></i> Reporte de todos los usuarios</h5> <?php $this->boton_atras(); ?>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if ($data) {
                                        ?>
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-auto">
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-hover text-center">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">ID</th>
                                                                <th scope="col">Nombre</th>
                                                                <th scope="col">Telefono</th>
                                                                <th scope="col">Correo</th> 
                                                                <th scope="col">Fecha</th>
                                                                <th scope="col">Creacion</th>
                                                                <th scope="col">EstadoUsuarioId</th>
                                                                <th scope="col">Titulo</th>
                                                                <th scope="col">Clave</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($data as $key => $dato) { 
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $dato['id']; ?></td>
                                                                    <td><?php echo $dato['nombre']; ?></td>
                                                                    <td><?php echo $dato['telefono']; ?></td>
                                                                    <td><?php echo $dato['correo']; ?></td>
                                                                    <td><?php echo $dato['fecha']; ?></td>
                                                                    <td><?php echo $dato['creacion']; ?></td>
                                                                    <td><?php echo $dato['EstadoUsuarioId']; ?></td>
                                                                    <td><?php echo $dato['titulo']; ?> </td>
                                                                    <td><?php echo $dato['clave']; ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-auto">
                                                <div class="alert alert-warning shadow" role="alert">
                                                    Sin usuarios ingresados
                                                </div>
                                            </div>
                                        </div>  <div class="mt-3"></div>
                                        
                                        <?php
                                    }  ?>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <br>
            </div>
          <?php
        }
    }

    function reporte_creados_hoy($data)
    { 
        if ($data){
            ?>     
            <style>
                .form-check-input 
                {
                    scale: 2; 
                    margin-top: 10px;
                    margin-left: 0px;
                    margin-right: 0px;
                    box-shadow: none;
                }
                .enlace-especifico {
                    outline: none;
                    text-decoration: none;
                    padding: 2px 1px 0;
                }

                .enlace-especifico:visited {
                    color: #288df7; 
                }

                .enlace-especifico:focus {
                    border-bottom: 1px solid;
                    background: #d4abb0;
                }

                .enlace-especifico:hover {
                    border-bottom: 1px solid;
                    background: #d4abb0;
                }

                .enlace-especifico:active {
                    background: #7d0211;
                    color: #d4abb0;
                }
                .fox { 
                    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
                }
                .fox2 { 
                    box-shadow: 7px 7px 5px rgba(0, 0, 0, 0.2);
                }
            </style>
            <div class="mt-5 "></div>
            <div class="d-inline-flex p-2 bd-highlight"> 
                    <div class="d-flex justify-content-start">
                        <div class="col-md-auto">
                            <div class="card shadow">
                                <div class="card-header d-flex justify-content-between">
                                    <h5><i class="bi bi-clipboard-check" style="font-size: 1.7rem;"></i> Reporte de todos los usuarios <b>CREADOS HOY</b></h5> <?php $this->boton_atras(); ?>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if ($data) {
                                        ?>
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-auto">
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-hover text-center">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">ID</th>
                                                                <th scope="col">Nombre</th>
                                                                <th scope="col">Telefono</th>
                                                                <th scope="col">Correo</th> 
                                                                <th scope="col">Fecha</th>
                                                                <th scope="col">Creacion</th>
                                                                <th scope="col">EstadoUsuarioId</th>
                                                                <th scope="col">Titulo</th>
                                                                <th scope="col">Clave</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($data as $key => $dato) { 
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $dato['id']; ?></td>
                                                                    <td><?php echo $dato['nombre']; ?></td>
                                                                    <td><?php echo $dato['telefono']; ?></td>
                                                                    <td><?php echo $dato['correo']; ?></td>
                                                                    <td><?php echo $dato['fecha']; ?></td>
                                                                    <td><b><?php echo $dato['creacion']; ?></b></td>
                                                                    <td><?php echo $dato['EstadoUsuarioId']; ?></td>
                                                                    <td><?php echo $dato['titulo']; ?> </td>
                                                                    <td><?php echo $dato['clave']; ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-auto">
                                                <div class="alert alert-warning shadow" role="alert">
                                                    Sin usuarios ingresados
                                                </div>
                                            </div>
                                        </div>  <div class="mt-3"></div>
                                        
                                        <?php
                                    }  ?>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <br>
            </div>
          <?php
        }
    }

    function reporte_creados_ayer($data)
    { 
        if ($data){
            ?>     
            <style>
                .form-check-input 
                {
                    scale: 2; 
                    margin-top: 10px;
                    margin-left: 0px;
                    margin-right: 0px;
                    box-shadow: none;
                }
                .enlace-especifico {
                    outline: none;
                    text-decoration: none;
                    padding: 2px 1px 0;
                }

                .enlace-especifico:visited {
                    color: #288df7; 
                }

                .enlace-especifico:focus {
                    border-bottom: 1px solid;
                    background: #d4abb0;
                }

                .enlace-especifico:hover {
                    border-bottom: 1px solid;
                    background: #d4abb0;
                }

                .enlace-especifico:active {
                    background: #7d0211;
                    color: #d4abb0;
                }
                .fox { 
                    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
                }
                .fox2 { 
                    box-shadow: 7px 7px 5px rgba(0, 0, 0, 0.2);
                }
            </style>
            <div class="mt-5 "></div>
            <div class="d-inline-flex p-2 bd-highlight"> 
                    <div class="d-flex justify-content-start">
                        <div class="col-md-auto">
                            <div class="card shadow">
                                <div class="card-header d-flex justify-content-between">
                                    <h5><i class="bi bi-clipboard-check" style="font-size: 1.7rem;"></i> Reporte de todos los usuarios <b>CREADOS AYER</b></h5> <?php $this->boton_atras(); ?>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if ($data) {
                                        ?>
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-auto">
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-hover text-center">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">ID</th>
                                                                <th scope="col">Nombre</th>
                                                                <th scope="col">Telefono</th>
                                                                <th scope="col">Correo</th> 
                                                                <th scope="col">Fecha</th>
                                                                <th scope="col">Creacion</th>
                                                                <th scope="col">EstadoUsuarioId</th>
                                                                <th scope="col">Titulo</th>
                                                                <th scope="col">Clave</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($data as $key => $dato) { 
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $dato['id']; ?></td>
                                                                    <td><?php echo $dato['nombre']; ?></td>
                                                                    <td><?php echo $dato['telefono']; ?></td>
                                                                    <td><?php echo $dato['correo']; ?></td>
                                                                    <td><?php echo $dato['fecha']; ?></td>
                                                                    <td><b><?php echo $dato['creacion']; ?></b></td>
                                                                    <td><?php echo $dato['EstadoUsuarioId']; ?></td>
                                                                    <td><?php echo $dato['titulo']; ?> </td>
                                                                    <td><?php echo $dato['clave']; ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-auto">
                                                <div class="alert alert-warning shadow" role="alert">
                                                    Sin usuarios ingresados
                                                </div>
                                            </div>
                                        </div>  <div class="mt-3"></div>
                                        
                                        <?php
                                    }  ?>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <br>
            </div>
          <?php
        }
    }

    function boton_atras()
    {
        ?>
            <button id="regresar_boton" type="button" class="btn btn-outline-info ">Regresar a inicio</button>
        <?php
    } 


}