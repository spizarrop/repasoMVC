-- Usuario administrador para pruebas locales
CREATE USER 'admin_deportes'@'localhost' IDENTIFIED BY 'Admin1234!';

-- Usuario con permisos limitados
CREATE USER 'usuario_deportes'@'localhost' IDENTIFIED BY 'Usuario123!';

-- Le damos todos los permisos sobre la base de datos deportes al administrador
GRANT ALL PRIVILEGES ON deportes.* TO 'admin_deportes'@'localhost';
-- SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, etc.

-- Le damos los permisos solo los permisos mínimos necesarios por seguridad
GRANT SELECT, INSERT, UPDATE, DELETE ON deportes.* TO 'usuario_deportes'@'localhost';
-- SELECT para leer datos de tablas (usuarios, deportes, inscripciones)
-- INSERT para crear nuevos registros (usuarios, inscripciones)
-- UPDATE para modificar registros existentes (por ejemplo modificar datos de usuario)
-- DELETE para eliminar registros (por ejemplo eliminar inscripciones)
