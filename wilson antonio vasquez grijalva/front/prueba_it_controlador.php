<?php
require_once('prueba_it_vista.php');
$vista=new prueba_it_vista();

if(isset($_POST['accion'])){
    $accion=$_POST['accion'];
    switch($accion){
         
            //seccion que despliega las vistas por bloques interactivos

            case 'inicio':
                $vista->inicio();
            break;

            case 'formulario':
                $vista->formulario();
            break;

            case 'reporte':
                $vista->reporte();
            break;

            case 'reporte_general':
                $data  = $_POST['data'];
                $vista->reporte_general($data);
            break;

            case 'reporte_creados_hoy':
                $data  = $_POST['data'];
                $vista->reporte_creados_hoy($data);
            break;

            case 'reporte_creados_ayer':
                $data  = $_POST['data'];
                $vista->reporte_creados_ayer($data);
            break;

        default:
            $respuesta=[];
            $respuesta['estado']=0;
            $respuesta['contenido']="Accion no registrada($accion) en controlador";
            echo json_encode($respuesta);
    }
    unset($_POST);
    exit;
}
