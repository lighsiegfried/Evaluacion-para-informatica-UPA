const { Router } = require('express');
const router = Router();
const respuesta  = require("../red/respuestas.js"); //control respuestas
const controlador = require("./controlador.js"); //control consultas internas sql
const error = require('../red/errors.js');

/* --------------- END POINTs PRUEBA ----------------- */
        /* --------------- inicia modulo --------------- */
  router.post("/guardar_usuario", agregar);
  router.get("/ejecutar_reporte/:id", uno); //consulta 1 , el id 
  router.get("/ejecutar_reporte", todos);   //consulta todos
  router.use(error);


  async function agregar (req, res , next) {
    try {
      const resultado = await controlador.agregar(req.body);
      res.status(201).json({
        message: "Registro guardado exitosamente.",
        id: resultado.id, 
      });
    } catch (err) {
      next(err);
    }
  };

  async function todos (req, res, next) {
    //res.json({message: "port 3000 desplegadoo!!!"})
    try {
      const items = await controlador.todos();
      respuesta.success(req,res, items , 200);
    } catch (err){
      next(err);
    }
  };

  async function uno (req, res, next) {
    try {
        const items = await controlador.uno(req.params.id);
        respuesta.success(req,res, items , 200);
      } catch (err){
        next(err);
      }
  };

/* --------------- END POINTs PRUEBA ----------------- */

  function obtenerFechaActual() { //funcion de fechas
      const fecha = new Date();
      const dia = fecha.getDate();
      const mes = fecha.getMonth() + 1;
      const año = fecha.getFullYear();
      return `${dia}/${mes}/${año}`;
    }

module.exports = router;

