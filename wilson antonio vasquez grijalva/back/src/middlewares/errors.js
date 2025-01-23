function error (message, code){ //manejar errores en db de "mejor manera" y separada.
    let e = new Error(message);
    if(code){
        e.statusCode = code;
    }

    return e;

}

module.exports = error;