<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API</title>
</head>
<body>
    <?php

    include_once "../models/dataBase.php";
    include_once "../models/clase.php";
    include_once "../models/post.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);
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
</body>
</html>