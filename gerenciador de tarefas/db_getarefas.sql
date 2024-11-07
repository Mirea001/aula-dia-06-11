﻿
create database db_getarefas

use db_getarefas

create table usuarios(
       usu_codigo         int primary key auto_increment,
       nome               varchar(45),
       email              varchar(45)
);

create table tarefas(
       tar_codigo         int primary key auto_increment,
       setor              varchar(45),
       prioridade         varchar(45),
       descricao          varchar(45),
       status             varchar(45)
);

alter table tarefas
add column usu_codigo int,
add constraint fk_usu_codigo foreign key (usu_codigo) references usuarios (usu_codigo);
