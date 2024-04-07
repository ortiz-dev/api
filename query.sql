create database if not exists dbdonantes_colombia character set 'utf8';

use dbdonantes_colombia; 

create table if not exists encabezados(
id int auto_increment not null,
codigo_donacion varchar(100),
fecha_publicacion datetime,
kg_total float(6,2),
costo_total float(11,2),
nombre_punto text,
id_punto varchar(100),
departamento varchar(100),
ciudad varchar(100),
direccion text, 
primary key(id)
);

create table if not exists detalles(
id int auto_increment not null,
codigo_donacion varchar(100),
id_punto varchar(100),
nombre_producto varchar(100),
codigo_producto varchar(100),
cantidad varchar(100),
kg_unitario float(6,2),
costo_unitario float(11,2),
fecha_publicacion datetime,
primary key(id)
);

create database if not exists dbdonantes_puntos character set 'utf8';

use dbdonantes_puntos; 

create table if not exists puntos(
id int auto_increment not null,
id_punto varchar(100),
nombre_punto varchar(100),
departamento varchar(100),
ciudad varchar(100),
direccion text,
primary key(id)
);

/*puntos*/
INSERT INTO `dbdonantes_puntos`.`puntos` (`id_punto`, `nombre_punto`, `departamento`, `ciudad`, `direccion`)VALUES('10', 'Punto FSG', 'Antioquia', 'Medellín', 'Carrera 50 #25-261');
INSERT INTO `dbdonantes_puntos`.`puntos` (`id_punto`, `nombre_punto`, `departamento`, `ciudad`, `direccion`) VALUES ('11', 'Punto ABC', 'Atlántico', 'Barranquilla', 'Calle 75B No, 42F-83 Barrio Ciudad Jardín');
INSERT INTO `dbdonantes_puntos`.`puntos` (`id_punto`, `nombre_punto`, `departamento`, `ciudad`, `direccion`) VALUES ('12', 'Punto RET', 'Córdoba', 'Monteria', 'Calle 27 N. 4-42, Montería');
INSERT INTO `dbdonantes_puntos`.`puntos` (`id_punto`, `nombre_punto`, `departamento`, `ciudad`, `direccion`) VALUES ('13', 'Punto OJZ', 'Magdalena', 'Santa Marta', 'Cra 2 Nº 20-48 Centro');

