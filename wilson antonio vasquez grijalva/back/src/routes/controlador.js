const moment = require("moment");
const db = require("../db/dbmysql.js");

const tabla = 'usuario';

async function agregar(body) {
    const errores = [];
  
    // validar campos
    const { nombre, fecha, telefono, correo } = body;
  
    if (!nombre || !fecha || !telefono || !correo) {
      errores.push("Todos los campos (nombre, fecha, teléfono, correo) son obligatorios.");
    }
  
    // nombre
    if (nombre && !/^[a-zA-Z\s]+$/.test(nombre)) {
      errores.push("El nombre solo puede contener letras.");
    }
  
    // telefono
    if (telefono && !/^\d{1,11}$/.test(telefono)) { //actualmente son 8 sin embargo pueden registrar numeros extranjeros con mayor cantidad, se dejo en 11 prueba.
      errores.push("El telefono debe contener solo numeros y tener un maximo de 11 dígitos.");
    }
  
    // fecha
    if (fecha && !moment(fecha, "DD-MM-YYYY", true).isValid()) {
      errores.push("La fecha debe tener el formato 'dd-mm-YYYY'.");
    }
  
    // mayor de edad
    if (fecha && moment().diff(moment(fecha, "DD-MM-YYYY"), "years") < 18) {
      errores.push("El usuario debe ser mayor de edad.");
    }
  
    // e-mail o correos general
    if (correo && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) {
      errores.push("El correo electronico no tiene un formato valido.");
    }
  
    // si existieran otra clase de errores:
    if (errores.length > 0) {
      throw new Error(errores.join(" Error JSON incompleto "));
    }

     // convierte al formato 'YYYY-MM-DD' para insertar en la db
    const fechaConvertidaDb = moment(fecha, "DD-MM-YYYY").format("YYYY-MM-DD");
  
    // Asignar estado activo y fecha de creación
    const usuario = {
      ...body,
      fecha: fechaConvertidaDb,
      EstadoUsuarioId: 1, // Estado activo
      creacion: moment().format("YYYY-MM-DD"), // hoy , actualidad
    };
  
    // Guardar en la base de datos
    const resultado = await db.insertar(tabla, usuario);

    return { id: resultado.insertId };
  }


module.exports = {
    agregar,
};