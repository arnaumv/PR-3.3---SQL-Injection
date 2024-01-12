<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form method="post">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Nueva Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="confirm_password">Confirmar Nueva Contraseña:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br>
        <button type="submit">Cambiar Contraseña</button>
        <button onclick="location.href='Login.php'">Salir</button>
    </form>
   



<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        // Si el usuario no está logeado, redirigir a la página de inicio de sesión
        header("Location: login.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = $_POST["username"];
        $contraseña = $_POST["password"];
        $confirmacion = $_POST["confirm_password"];
        
        if ($contraseña == $confirmacion) {
            try {
                $hostname = "localhost";
                $dbname = "mylogin";
                $username = "arnau";
                $pw = "P@ssw0rd1234";
                $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
            } catch (PDOException $e) {
                echo "Failed to get DB handle: " . $e->getMessage() . "\n";
                exit;
            }

            $querystr = "UPDATE users SET contrasenya = SHA2(:contrasena, 256) WHERE nom = :usuario";
            $query = $pdo->prepare($querystr);

            $query->bindParam(':usuario', $usuario);
            $query->bindParam(':contrasena', $contraseña);

            $query->execute();

            echo "Contraseña actualizada con éxito";
            
            unset($pdo);
            unset($query);
        } else {
            echo "Las contraseñas no coinciden";
        }
    }
?>


</body>
</html>