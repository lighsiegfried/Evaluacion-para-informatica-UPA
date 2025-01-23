const mongoose = require('mongoose');
//prueba de conexion con mongoDB
mongoose.connect('mongodb://localhost/datos', {
  useNewUrlParser: true,
  useUnifiedTopology: true
})
  .then(() => console.log(''))
  .catch(err => console.error(''));
