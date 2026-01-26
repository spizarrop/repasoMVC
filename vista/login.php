<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Inicio de Sesión</title>
    </head>
    <body>
        <h2>Identificación de Usuario</h2>
        <?php if (isset($datos) && is_string($datos)): ?>
            <p style="color: red;"><?= $datos ?></p>
        <?php endif; ?>
        <form action="index.php?c=Usuario&m=procesarLogin" method="POST">
            <div>
                <label>Usuario:</label><br>
                <input type="text" name="user" required>
            </div>
            <br>
            <div>
                <label>Contraseña:</label><br>
                <input type="password" name="pass" required>
            </div>
            <br>
            <button type="submit">ENVIAR</button>
        </form>
        <br>
        <a href="index.php">Volver al inicio</a>
    </body>
</html>