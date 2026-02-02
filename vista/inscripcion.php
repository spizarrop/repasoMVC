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
        <h2>Formulario de Inscripción</h2>
        <form action="index.php?c=Usuario&m=procesarInscripcion" method="POST">
            <label>Usuario:</label><br/>
            <input type="text" name="nombreUsuario"><br/>
            <label>Nombre y Apellidos:</label><br/>
            <input type="text" name="apeNombre"><br/>
            <label>Password:</label><br/>
            <input type="password" name="password"><br/>
            <label>Email:</label><br/>
            <input type="email" name="correo"><br/>
            <label>Teléfono:</label><br/>
            <input type="text" name="telefono"><br/>
            
            <label>Deportes:</label><br>
            <input type="checkbox" name="deportes[]" value="1"> Fútbol<br/>
            <input type="checkbox" name="deportes[]" value="2"> Baloncesto<br/>
            <input type="checkbox" name="deportes[]" value="3"> Tenis de mesa<br/><br/>
            
            <input type="checkbox" name="condiciones"> Acepto las condiciones **<br/>
            <button type="submit">ENVIAR</button>
        </form>
        <a href="index.php">Volver al inicio</a>
    </body>
</html>