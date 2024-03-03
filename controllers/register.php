<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="../CSS/style-Register.css">
</head>

<body>
    <div class="login-container">
        <h2>Formulario de Registro</h2>
        <form action="funtion_register.php" method="post">
            <div class="input-container">
                <label for="name">Nombre:</label><br>
                <input type="text" id="name" name="name" class="input-field"><br>
            </div>
            <div class="input-container">
                <label for="lastname">Apellido:</label><br>
                <input type="text" id="lastname" name="lastname" class="input-field"><br>
            </div>
            <div class="input-container">
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" class="input-field"><br>
            </div>
            <div class="input-container">
                <label for="password">Contraseña:</label><br>
                <input type="password" id="password" name="password" class="input-field"><br>
            </div>
            <div class="input-container">
                <label for="confirm_password">Confirmar Contraseña:</label><br>
                <input type="password" id="confirm_password" name="confirm_password" class="input-field"><br>
            </div>
            <input type="submit" value="Registrarse" class="button">
        </form>
        <p>¿Ya tienes cuenta? Inicia sesión</p>
        <form action="../">
            <button type="submit" class="bregister">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>