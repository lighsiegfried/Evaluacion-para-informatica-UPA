const mysql = require('mysql');
/*-------------------------------- Inicio DB para prueba plana v2  --------------------------------*/
const HOST_PLANO = process.env.HOST_PLANO;
const USER_PLANO = process.env.USER_PLANO ;
const SERVER_PASSWORD_PLANO = process.env.SERVER_PASSWORD_PLANO;
const DATABASE_PLANO = process.env.DATABASE_PLANO;

const dbConfig_plano = {
    host: HOST_PLANO, 
    user: USER_PLANO, 
    password: SERVER_PASSWORD_PLANO, 
    database: DATABASE_PLANO, 
    charset: 'utf8mb4', 
};

let connection_plano;

    async function createConnection_plano() {
        connection_plano = mysql.createConnection(dbConfig_plano);
    
        return new Promise((resolve, reject) => {
            connection_plano.connect((error) => {
                if (error) {
                    console.error('Error al conectar a la base de datos pt1:', error);
                    reject(error);
                } else {
                    console.log('Conexión exitosa a la base de datos pt1.');
                    resolve(connection_plano);
                }
            });
    
            connection_plano.on('error', (error) => {
                if (error.code === 'PROTOCOL_CONNECTION_LOST') {
                    console.error('Conexión a la base de datos perdida pt1. Reconectando...');
                    connection_plano.destroy();
                    connection_plano = null;
                } else {
                    throw error;
                }
            });
        });
  }
  
  function closeConnection_plano() {
    if (connection_plano) {
      connection_plano.end((error) => {
        if (error) {
          console.error('Error al cerrar la conexión a la base de datos pt1: ', error);
        } else {
          console.log('Conexión cerrada a la base de datos pt1.');
        }
      });
    }
  }
/*-------------------------------- Fin DB para prueba plana v2 --------------------------------*/
/* ----------------- Funciones para planos inicio modulo ----------------- */ 
createConnection_plano();


async function insertar(tabla, data) {
  try {
      const resultado = await new Promise((resolve, reject) => {
          connection_plano.query(`insert into ${tabla} set ?`, data, (error, resultado) => {
              if (error) {
                  reject(error);
              } else {
                  resolve(resultado);
              }
          });
      });
      return resultado;
  } catch (error) {
      throw error;
  }
}

function todos(tabla){
  return new Promise ( (resolve, reject) => {
    connection_plano.query(`select * from ${tabla} order by id desc`, (error,resultado) => {
        return error ? reject(error): resolve(resultado);
    }); 
  });
}

function uno(tabla, id) { //consulta de datos para obtener fecha y pasarla a fecha_modificacion para la nueva version ingresada.
  return new Promise((resolve, reject) => {
    connection_plano.query(`select * from ${tabla} where id='${id}' `, (error,resultado) => {
      if (error) {
        reject(error);
      } else {
        if (resultado.length > 0) {
          resolve(resultado[0]);
        } else {
          resolve(null);
        }
      }
    });
  });
}



/* ----------------- Funciones para planos fin modulo ----------------- */ 
  
  module.exports = { 
    createConnection_plano,
    closeConnection_plano,
    insertar,
    uno,
    todos,
  };