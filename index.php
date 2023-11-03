<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timidudas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

</head>
<body>
    <h1 style="margin-left:20px;">Command</h1>
    <form style="margin:20px;" id="form" method="post">
        <input type="text" name="inpTexto" id="inpTexto">
        <input id="submit" type="button" value="enviar">
    </form>
    <?php
 /*        include_once "../models/dataBase.php";
        include_once "../models/clase.php";
        include_once "../models/post.php"; */

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode($_POST['data'], true);
            var_dump($data);
            // Aquí puedes procesar los datos recibidos
        
            // Luego, puedes enviar una respuesta al cliente
            $response = array(
            'status' => 'success',
            'message' => 'Datos recibidos correctamente',
            'data' => $data
            );
        
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    ?>
    <script>
        document.getElementById('form').addEventListener('submit', function(event) {
        event.preventDefault();

        var url = 'Controllers/API.php';

        var formData = new FormData(event.target);
        var object = {};
        formData.forEach(function(value, key){
            object[key] = value;
        });
        var json = JSON.stringify(object);

        fetch(url, {
            method: 'POST',
            headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'data=' + json,
        })
        .then(response => response.text())
        .then(data => alert('Datos enviados correctamente'))
        .catch((error) => {
            console.error('Error:', error);
        });
        });

        
    </script>
</body>
</html>