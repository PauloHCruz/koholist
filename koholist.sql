create database koholist;
use koholist;

create table usuario(
id_usuario int AUTO_INCREMENT primary key,
nome varchar(40),
email varchar(40),
senha varchar(32)
);

create table imagens(
id_imagem int AUTO_INCREMENT primary key,
nome_imagem varchar(40),
fk_id_usuario int,
FOREIGN key(fk_id_usuario) REFERENCES usuario (id_usuario) ON DELETE CASCADE
);
