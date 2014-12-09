create database bdphp default character set utf8 collate utf8_unicode_ci;
grant all on bdphp.* to userphp@localhost identified by 'clavephp';
flush privileges;

use bdphp;

CREATE TABLE IF NOT EXISTS `casa` (
    `id` int NOT NULL primary key auto_increment,
  `lugar` varchar(30) NOT NULL,
  `precio` integer(30) NOT NULL,
  `tipo` char(8) CHECK(tipo IN ('Venta','Alquiler')),
  `foto` varchar(100) NOT NULL,
    unique(lugar,precio,tipo,foto)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `admin` (
    `login` varchar(30) NOT NULL primary key,
    `nombre` varchar(40) NOT NULL,
    `clave` varchar(40) NOT NULL,
    `email` varchar(40) NOT NULL,
    `isactivo` tinyint(1) NOT NULL
) ENGINE=InnoDB;