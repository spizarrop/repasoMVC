CREATE DATABASE deportes;
USE  deportes;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla Deportes
--

CREATE TABLE Deportes (
  idDeporte tinyint unsigned AUTO_INCREMENT PRIMARY KEY,
  nombreDep varchar(15) NOT NULL
  );
  
--
-- Estructura de tabla para la tabla Usuarios
--

CREATE TABLE Usuarios (
  idUsuario smallint unsigned AUTO_INCREMENT PRIMARY KEY,
  nombreUsuario varchar(30) NOT NULL UNIQUE,
  apeNombre varchar(60) NOT NULL,
  password varchar(100) NOT NULL,
  correo varchar(60) NOT NULL,
  telefono char(9) NULL,
  perfil ENUM('c','u') NOT NULL
);

CREATE TABLE Usuarios_deportes (
	idDeporte tinyint unsigned NOT NULL,
	idUsuario smallint unsigned	NOT NULL,
	PRIMARY KEY (idDeporte, idUsuario)
);