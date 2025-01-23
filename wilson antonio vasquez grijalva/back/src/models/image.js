const {Schema, model} = require('mongoose'); //conexion a mongoose, pero el modelo que necesitan es mysql

const imageSchema = new Schema({
        orderNumber: { type: Number},
        description: {type: String},
        filename:{ type: String },
        path:{ type: String },
        originalname:{ type: String },
        mimetype:{ type: String },
        size:{ type: Number },
        created_at:{ type: Date, default: Date.now() }
        

});


module.exports = model('Image', imageSchema);