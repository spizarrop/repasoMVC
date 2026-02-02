<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Inicio de Sesión</title>
    </head>
    <body>
        <div>
            <h2>Bienvenido <?= $_SESSION['nombreUsuario'] ?></h2>
        </div>
        <a href="index.php">Volver al inicio</a>
    </body>
</html>