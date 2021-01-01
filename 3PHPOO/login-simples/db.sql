create table usuario(
id int auto_increment not null primary key,
nome varchar(50) not null,
email varchar(120) not null,
senha varchar(16) not null
);

insert into usuario (nome,email,senha) values ('teste','teste@teste','123456');


