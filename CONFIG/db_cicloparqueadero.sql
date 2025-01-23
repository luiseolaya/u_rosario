
--CREATE DATABASE db_cicloparqueadero


CREATE DATABASE IF NOT EXISTS db_cicloparqueadero;
USE db_cicloparqueadero;


CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    celular VARCHAR(15),
    clave VARCHAR(255) NOT NULL
);


CREATE TABLE IF NOT EXISTS parqueadero (
    id_parqueadero INT AUTO_INCREMENT PRIMARY KEY,
    sede_parqueadero VARCHAR(50) NOT NULL
);


CREATE TABLE IF NOT EXISTS entrada (
    id_entrada INT AUTO_INCREMENT PRIMARY KEY,
    id_parqueadero INT NOT NULL,
    fecha_hora DATETIME NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_parqueadero) REFERENCES parqueadero(id_parqueadero),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);
