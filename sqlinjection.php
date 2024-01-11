<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL INJECTION</title>
    <style>

        form {
            padding: 20px;
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }







    </style>
</head>

<body>
    

    <form method="post">
        <h2>Login amb SHA Vulnerable</h2>
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Iniciar Sesió</button>
    </form>
    
    <?php
    //phpinfo();
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
        
        $querystr = "SELECT nom FROM users WHERE nom ='$usuario'  AND contrasenya=SHA2('$contraseña', 256)";
        //echo "$querystr<br><br>";
        $query = $pdo->prepare($querystr);

        $query->execute();
        
        $filas = $query->rowCount();
        if ($filas > 0) {
            echo "Usuari Correcte, $usuario";
        } else {
            echo "Usuari o contrasenya incorrectes";
        }
        unset($pdo);
        unset($query);
    }
    

    ?>




</body>
</html>