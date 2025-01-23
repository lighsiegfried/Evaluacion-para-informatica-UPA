<?php

//manejar visualizacion por medio de controles, mayor versatilidad al intercambiar bloques de vistas.
//se uso php por facilidad y sin instalar tantas librerias
require_once('prueba_it_vista.php');
$vista=new prueba_it_vista();

if(isset($_POST['accion'])){
    $accion=$_POST['accion'];
    switch($accion){ 
            //seccion que despliega las vistas por bloques interactivos

            case 'inicio':
                $vista->inicio();
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
