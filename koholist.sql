create database koholist;
use koholist;

create table usuario(
id_usuario int AUTO_INCREMENT primary key,
nome varchar(40),
email varchar(40),
senha varchar(32)
);