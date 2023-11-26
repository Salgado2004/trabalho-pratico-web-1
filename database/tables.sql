    create table usuario (
        id int auto_increment primary key,
        nome varchar(20) not null unique,
        email varchar(40) not null unique,
        senha varchar(256) not null,
        imagem int default 1,
        carro int default 1,
        fk_liga int null
    );

    create table liga (
        id int auto_increment primary key,
        nome varchar(20) not null unique,
        senha varchar(256),
        private boolean not null,
        imagem int default 1,
        fk_criador int not null
    );

    create table pontuacao (
        id int auto_increment primary key,
        modo_jogo boolean not null,
        tempo time,
        pontuacao int not null,
        data_reg timestamp,
        fk_usuario int not null
    );

    alter table usuario add constraint fk_liga_usuario
    foreign key (fk_liga) references liga(id);

    alter table liga add constraint fk_usuario_1
    foreign key (fk_criador) references usuario(id);

    alter table pontuacao add constraint fk_usuario_2
    foreign key (fk_usuario) references usuario(id);