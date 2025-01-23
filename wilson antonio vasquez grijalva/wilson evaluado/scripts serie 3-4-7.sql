-- serie 3,4,7 crear la DB y tablas  ---------------------------------------------------------------------

create database evaluacion_wilson_evaluado
character set utf8mb4
collate utf8mb4_unicode_ci;

-- tablas

create table `usuario` (
  `id` bigint(15)  AUTO_INCREMENT comment 'Solo sirve de referencia',
  `nombre` varchar(900) not null comment 'rdn de compra',
  `fecha` date not null  comment 'fecha actual',
  `telefono` int(11) not null comment 'telefono del cliente',
  `correo` varchar(900) not null ,
  `creacion` date not null comment 'fecha creacion',
	`EstadoUsuarioId` smallint(6) not null comment 'estados',
  primary key (`id`)
) engine=InnoDB AUTO_INCREMENT=1 default charset=latin1

drop table usuario

create table `EstadoUsuario` (
  `id` bigint(15) NOT NULL AUTO_INCREMENT comment 'Solo sirve de referencia',
  `titulo` varchar(50)  not null comment 'titulo cliente',
  `clave` varchar(50) not null comment 'nivel de confianza',
  primary key (`id`)
) engine=InnoDB AUTO_INCREMENT=1 default charset=latin1


select * from  usuario where id=3

update usuario set  EstadoUsuarioId=2 where id=3

update usuario set  creacion='2025-01-09' where id=3

update usuario set  creacion='2025-01-17' where id=1

select * from  EstadoUsuario

insert into EstadoUsuario (titulo,clave) 
values ("Activo","activo");

insert into EstadoUsuario (titulo,clave) 
values ("Baja Permanente","baja");


select id,nombre,telefono,correo,fecha,creacion,EstadoUsuarioId,titulo,clave from 
(
	select id,nombre,telefono,correo,fecha,creacion,EstadoUsuarioId from usuario
) t1 left join
(
	select id as id_est,titulo,clave from EstadoUsuario
) t2 on t1.EstadoUsuarioId = t2. id_est


-- ultima serie, agregar datos quemados
insert into usuario (nombre,fecha,telefono,correo,creacion,EstadoUsuarioId) 
values ("pedrito escamoso","1994-05-18",55448899,"pedri.to@hotmail.com","2025-01-22",2);

insert into usuario (nombre,fecha,telefono,correo,creacion,EstadoUsuarioId) 
values ("mark anthony","1990-04-08",53248899,"tu.vid@yahoo.com","2025-01-22",1);



insert into usuario (nombre,fecha,telefono,correo,creacion,EstadoUsuarioId) 
values ("mauricia latina","2003-09-28",85412537,"maurici.74@outlook.com","2024-12-22",1);

insert into usuario (nombre,fecha,telefono,correo,creacion,EstadoUsuarioId) 
values ("isabell castillo","2000-05-09",77442235,"casltle@gmail.com","2024-12-22",2);
