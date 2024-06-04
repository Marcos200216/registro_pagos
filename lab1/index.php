<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Pagos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        form label {
            margin-bottom: 5px;
        }
        form input[type="text"],
        form input[type="number"],
        form input[type="date"] {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        form input[type="submit"]:hover {
            background-color: rgba(76, 175, 80, 0.7);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ingresar Pago</h2>
        <form method="post">
            <label for="id">ID:</label>
            <input type="number" name="id" required><br>
            <label for="deudor">Deudor:</label>
            <input type="text" name="deudor" required><br>
            <label for="cuota">Cuota:</label>
            <input type="number" name="cuota" required><br>
            <label for="cuota_capital">Cuota Capital:</label>
            <input type="text" name="cuota_capital" required><br>
            <label for="fecha_pago">Fecha de Pago:</label>
            <input type="date" name="fecha_pago" required><br>
            <input type="submit" value="Ingresar Pago">
        </form>

        <?php
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "registro_pagos";

        
        $conn = new mysqli($servername, $username, $password, $dbname);

       
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id'];
            $deudor = $_POST['deudor'];
            $cuota = $_POST['cuota'];
            $cuota_capital = $_POST['cuota_capital'];
            $fecha_pago = $_POST['fecha_pago'];

            
            $sql = "INSERT INTO pagos (id, deudor, cuota, cuota_capital, fecha_pago) VALUES ($id, '$deudor', $cuota, $cuota_capital, '$fecha_pago')";

            if ($conn->query($sql) === TRUE) {
                echo "Nuevo pago ingresado correctamente";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        
        $sql = "SELECT * FROM pagos";
        $result = $conn->query($sql);

        echo "<h2>Lista de Pagos</h2>";
        echo "<table border='1'>
        <tr>
        <th>ID</th>
        <th>Deudor</th>
        <th>Cuota</th>
        <th>Cuota Capital</th>
        <th>Fecha de Pago</th>
        </tr>";

        if ($result->num_rows > 0) {
           
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['deudor'] . "</td>";
                echo "<td>" . $row['cuota'] . "</td>";
                echo "<td>" . $row['cuota_capital'] . "</td>";
                echo "<td>" . $row['fecha_pago'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "0 resultados";
        }
        echo "</table>";

        $conn->close();
        ?>
    </div>
</body>
</html>
