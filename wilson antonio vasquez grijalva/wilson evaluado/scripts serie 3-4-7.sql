-- serie 3 crear la DB y tablas  ---------------------------------------------------------------------

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


create table `EstadoUsuario` (
  `id` bigint(15) NOT NULL AUTO_INCREMENT comment 'Solo sirve de referencia',
  `titulo` varchar(50)  not null comment 'titulo cliente',
  `clave` varchar(50) not null comment 'nivel de confianza',
  primary key (`id`)
) engine=InnoDB AUTO_INCREMENT=1 default charset=latin1


select * from  usuario

select * from  EstadoUsuario

insert into EstadoUsuario (titulo,clave) 
values ("Activo","activo");

insert into EstadoUsuario (titulo,clave) 
values ("Baja Permanente","baja");