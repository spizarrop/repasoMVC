INSERT INTO Deportes(nombreDep) VALUES
('fútbol'),
('baloncesto'),
('padel'),
('tenis de mesa');
	
INSERT INTO usuarios (nombreUsuario, apeNombre, password, correo, telefono, perfil) VALUES
('coordinador', 'Coordinador Escuelas Deportivas', '123456', 'CoordED@evg.es',  '654321123','c'),
('usuario1', 'usuario 1 Escuelas Deportivas', '1234', 'usuario1@evg.es',  '667788991','u'),
('usuario2', 'usuario 2 Escuelas Deportivas', '1234', 'usuario2@evg.es',  NULL,'u'),
('usuario3', 'usuario 3 Escuelas Deportivas', '1234', 'usuario3@evg.es',  NULL,'u'),
('usuario4', 'usuario 4 Escuelas Deportivas', '1234', 'usuario4@evg.es',  NULL,'u');

INSERT INTO Usuarios_deportes (idDeporte,idUsuario) VALUES
(1,2),
(3,2),
(3,4),
(1,5),
(2,5),
(3,5);