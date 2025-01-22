
CREATE DATABASE db_cicloparqueadero;


USE db_cicloparqueadero;


CREATE TABLE usuarios (
    id_usuario INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    celular VARCHAR(15),
    clave VARCHAR(50) NOT NULL
);


CREATE TABLE parqueadero (
    id_parqueadero INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);


CREATE TABLE entrada (
    id_entrada INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_parqueadero INT(11) NOT NULL,
    fecha_hora DATETIME NOT NULL,
    id_usuario INT(11) NOT NULL,
    FOREIGN KEY (id_parqueadero) REFERENCES parqueadero(id_parqueadero),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);
