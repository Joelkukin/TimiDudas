<?php
   
function test($funcionPrueba, $codeBlock= "fragmento de código") {
    $resultado = $funcionPrueba();
    switch (gettype($resultado)) {
        case "array":
            echo"[\n";
            foreach($resultado as $clave => $valor) {
                if ($valor) {
                echo "    '$clave' : '$valor'\n";
            };
            echo "\n]";
            break;

        case "object":
            echo"{\n";
            foreach($resultado as $clave => $valor) {
                echo "    '$clave' : '$valor'\n";
            };
            echo "\n}";
            break;

        default:
            echo $codeBlock .": <br>";
            var_dump($resultado);
            echo "<br><br>";
            break;
    }
}

?>