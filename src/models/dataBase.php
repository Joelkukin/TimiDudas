<?php
# 

#creo la interfaz de base de datos
class DB{
    private $url; // url de base de datos
    private $username; // usuario de base de datos
    private $password; // contraseña de base de datos
    private $database; // nombre de base de datos

    private $tabla; // nombre de tabla

    private $conexion; // objeto interfaz sql

    public $items; // array asociativo

    # al crear un objeto, éste guardará sus items en la propiedad Items
    function __construct($tabla){
        $this->tabla=$tabla;
        $configUrl="config.json"; //leer config.json

        
        if ( is_readable($configUrl)) {//correccion error de distinta ubicacion de config segun ejecución
            $CONFIG =json_decode(file_get_contents($configUrl));
        }else{$CONFIG =json_decode(file_get_contents("../".$configUrl));}

        //extraer datos para el login de config.json
        $dataLogin = $CONFIG->config->SQLDataLogin ;
        
        # guardar datos en las propiedades del objeto
        $this->url = $dataLogin->url;
        $this->username = $dataLogin->username;
        $this->password = $dataLogin->password;
        $this->database = $dataLogin->database;
        
        # crear interfaz SQL
        $this->conexion = new mysqli($this->url, $this->username, $this->password, $this->database);
        if($this->conexion->connect_errno){
            die("Error de conexión ".$this->conexion->connect_errno);
        }
        
        # pedir tabla a base de datos y guardar tabla en propiedad $items 
        $this->conexion;
    }

    # ver los items (...)
    function getItems(...$id){    
    # traeme todos los items que tengan estas id's

        # si $id tiene más de un numero pedir solo un item, sino pedir varios
        if (count($id) == 1){// si el array tiene más de un nro
            $consulta = "SELECT nombre, codigo FROM ".$this->tabla." WHERE id = ".$id[0]; // hacé esta consulta
        } else{ # si $id son varios elementos entonces...
            foreach ($id as $value) { //  ... si de todos los valores del id ...
                if (!is_int($value)) { // ... hay alguno que no es un nro ...
                    die("todos los valores deben ser numeros enteros"); // ... tirá este error.
                } // sino seguí con lo demas
            }
            // si no tira error significa que se puede ejecutar la consulta
            $consulta = "SELECT id, nombre, codigo FROM ".$this->tabla." WHERE id IN(".implode(",",$id).")"; // armo la consulta
            $result = $this->conexion->query($consulta); // ejecutar consulta sql y guardar en $resp
            # si la consulta devolvió al menos una fila, ejecutá el siguiente codigo...
            if ($result->num_rows > 0) {
                # guardar en row un array asociativo con el contenido de las celdas de la siguiente fila, repite ésto hasta que no queden más filas con datos por guardar
                while($row = $result->fetch_assoc()){ // por cada fila que haya, se agrega al array $row
                    $this->items[] = $row;
                } 
            }
        }
       
        return $this->items;
            /* El bucle while se utiliza en lugar de foreach en este caso debido a cómo funciona el método fetch_assoc().
    
            El método fetch_assoc() de un objeto de resultado de base de datos devuelve la siguiente fila de resultados 
            como un array asociativo cada vez que se llama. Si no hay más filas, devuelve null. 
            */
            /* Por lo tanto, puedes usarlo en una declaración while para seguir obteniendo y procesando filas hasta que no haya más. Esto es útil cuando trabajas con grandes conjuntos de resultados, ya que solo necesitas tener una fila en memoria a la vez.
        
            Por otro lado, foreach se utiliza para recorrer elementos de un array que ya está completamente definido y disponible en memoria. No funcionaría con el método fetch_assoc() porque este método no devuelve un array completo de resultados, sino una sola fila de resultados a la vez. */
            
            /* imprimir cada item uno debado del otro */
    }

    function search($condicion,$traer){
        /* buscar todos los items que cumplan con la condición */
        /* $traer tiene que ser un campo de */

    }
}

    $tablaItems = new DB("items");
    $result= $tablaItems->getItems(1,2,3,5,6);
    echo "\$DataBase return: ";
    var_dump($result);// devuelve un array
?>