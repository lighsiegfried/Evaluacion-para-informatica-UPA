//estructura de respuestas

exports.success = function (req , res, mensaje = '', status = 200) {
    res.status(status).send({
        error: false,
        status: status,
        data: mensaje
    });
}

exports.error = function (req , res, mensaje = 'Error interno', status = 500) {
    res.status(status).send({
        error: true,
        status: status,
        data: mensaje
    });
}