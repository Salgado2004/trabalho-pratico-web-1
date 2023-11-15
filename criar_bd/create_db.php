<?php
  require('credentials.php');

  // Create connection
  $conn = mysqli_connect($servername, $username, $password);
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // Create database
  $sql = "CREATE DATABASE $dbname";
  if (mysqli_query($conn, $sql)) {
      echo "Database created successfully<br>";
  } else {
      echo "Error creating database: " . mysqli_error($conn) . "<br>";
  }
  
  // Create database
  $sql = "use $dbname";
  if (mysqli_query($conn, $sql)) {
      echo "Database selected successfully<br>";
  } else {
      echo "Error creating database: " . mysqli_error($conn) . "<br>";
  }

  // sql to create table
  $sql = "
    create table usuario (
        id int auto_increment primary key,
        nome varchar(20) not null unique,
        email varchar(40) not null unique,
        senha varchar(20) not null,
        imagem varchar(50) null,
        fk_liga int null
    );

    create table liga (
        id int auto_increment primary key,
        nome varchar(20) not null unique,
        senha varchar(20) not null,
        imagem varchar(50) null,
        fk_criador int not null
    );

    create table pontuacao (
        id int auto_increment primary key,
        modo_jogo boolean not null,
        tempo time,
        pountuacao int,	
        data_reg timestamp,
        fk_usuario int not null
    );

    alter table usuario add constraint fk_liga_usuario
    foreign key (fk_liga) references liga(id);

    alter table liga add constraint fk_usuario_1
    foreign key (fk_criador) references usuario(id);

    alter table pontuacao add constraint fk_usuario_2
    foreign key (fk_usuario) references usuario(id);";

  if (mysqli_query($conn, $sql)) {
      echo "Table Comments created successfully<br>";
  } else {
      echo "Error creating table: " . mysqli_error($conn) . "<br>";
  }

  mysqli_close($conn);
?>
