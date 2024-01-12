<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        // Si el usuario no está logeado, redirigir a la página de inicio de sesión
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bienvenido, <?php echo $_SESSION['username']; ?></h2>
        <button onclick="location.href='ChangePwd.php'">Canviar contrasenya</button>
        <button onclick="location.href='CreateUser.php'">Crear Usuario</button>
        <button onclick="location.href='Login.php'">Logout</button>
    </div>
</body>
</html>