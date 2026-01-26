<h2>Formulario de Inscripción</h2>
<form action="index.php?c=Usuario&m=procesarInscripcion" method="POST">
    <label>Usuario:</label> <input type="text" name="user" required><br>
    <label>Nombre y Apellidos:</label> <input type="text" name="nombre" required><br>
    <label>Password:</label> <input type="password" name="pass" required><br>
    <label>Email:</label> <input type="email" name="email" required><br>
    <label>Teléfono:</label> <input type="text" name="telefono"><br>
    
    <label>Deportes:</label><br>
    <input type="checkbox" name="deportes[]" value="1"> Fútbol<br>
    <input type="checkbox" name="deportes[]" value="2"> Baloncesto<br>
    <input type="checkbox" name="deportes[]" value="3"> Tenis de mesa<br>
    
    <input type="checkbox" name="condiciones"> Acepto las condiciones **<br>
    <button type="submit">ENVIAR</button>
</form>
<a href="index.php">Volver</a>