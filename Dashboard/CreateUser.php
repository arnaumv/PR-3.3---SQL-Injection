<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
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
        <h2>Registro de Usuario</h2>
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Registrar</button>
    </form>
    
    <?php
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = $_POST["username"];
        $contraseña = $_POST["password"];
        
        $querystr = "INSERT INTO users (nom, contrasenya) VALUES ('$usuario', SHA2('$contraseña', 256))";
        $query = $pdo->prepare($querystr);

        $query->execute();
        
        $filas = $query->rowCount();
        if ($filas > 0) {
            echo "Usuario registrado con éxito, $usuario";
        } else {
            echo "No se pudo registrar el usuario";
        }
        unset($pdo);
        unset($query);
    }
    ?>
</body>
</html>