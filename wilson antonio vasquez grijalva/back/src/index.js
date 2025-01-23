const express = require('express');
const path = require('path');
const morgan = require('morgan');
const { format, register } = require('timeago.js');
// const es = require('timeago.js/es');
const dotenv =require('dotenv') // Requerir dotenv e cargar las variables de entorno desde el archivo .env
dotenv.config();
const cors = require('cors');

//Initilizations
const app= express();
require('./database'); 


app.set('port', process.env.PORT || 3000);
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');


//MIDDLEWARES
// Configurar el middleware express.static para servir archivos estaticos
app.use(morgan('dev'));
app.use(express.json());
app.use(express.urlencoded({extended: true}));

//Static files
app.use(express.static(path.join(__dirname, 'public')));

//Configurar CORS para permitir solicitudes desde los origenes permitidos
app.use(cors({
    origin: ['http://192.168.15.3', 'http://192.168.15.8',"http://localhost"], // Reemplaza con tu dominio permitido
    optionsSuccessStatus: 200 // Configura el código de estado de éxito
}));


// Global Variables
app.use((req, res, next)=>{
    app.locals.format = (date) => { return format(date, 'es')};
    next();
});

//Routers
app.use(require('./routes/index.routes.js'));
// app.use(require('./routes/qr.routes.js'));

//INICIAR SERVIDOR
app.listen(app.get('port'), () =>{
    console.log(`SERVIDOR INICIADO EN EL  port ${app.get('port')}`);

});