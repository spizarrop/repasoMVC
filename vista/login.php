<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Inicio de Sesión</title>
    </head>
    <body>
        <?php 
        if (!empty($objControlador->mensaje)){
            echo "<p style='color:red'>".$objControlador->mensaje."</p>";
        }
        ?>
        <h2>Identificación de Usuario</h2>
        <form action="index.php?c=Usuario&m=procesarLogin" method="POST">
            <div>
                <label for="nombreUsuario">Usuario:</label><br>
                <input type="text" name="nombreUsuario">
            </div>
            <br>
            <div>
                <label for="password">Contraseña:</label><br>
                <input type="password" name="password">
            </div>
            <br>
            <button type="submit">ENTRAR</button>
        </form>
        <br>
        <a href="index.php">Volver al inicio</a>
    </body>
</html>