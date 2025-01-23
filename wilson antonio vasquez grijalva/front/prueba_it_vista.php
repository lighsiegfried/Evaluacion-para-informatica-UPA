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


    function boton_atras()
    {
        ?>
            <button id="regresar_boton" type="button" class="btn btn-outline-info ">Regresar a inicio</button>
        <?php
    } 


}