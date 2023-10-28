<?php
class test{
    private $tabla;
    private $conexion;

    public $consulta;

    public $resultado;
    public function __construct(...$id){
        $this->tabla = "items";
        $this->conexion = new mysqli("localhost","root","","simple_php_api") ;
        if (count($id) == 1){// si el array tiene más de un nro
            $this->consulta = "SELECT nombre, codigo FROM ".$this->tabla." WHERE id = ".$id[0]; // hacé esta consulta
        } else{ # si $id son varios elementos entonces...
            foreach ($id as $value) { //  ... si de todos los valores del id ...
                if (!is_int($value)) { // ... hay alguno que no es un nro ...
                    die("todos los valores deben ser numeros enteros"); // ... tirá este error.
                } // sino seguí con lo demas
            }
            // si no tira error significa que se puede ejecutar la consulta
            $this->consulta = "SELECT id, nombre, codigo FROM ".$this->tabla." WHERE id IN(".implode(",",$id).")"; // armo la consulta
        } 
        $resp = $this->conexion->query($this->consulta); // ejecutar consulta sql y guardar en $resp

        while($row = $resp->fetch_assoc()){ // por cada fila que haya, se guarda en el array $row
            $this->resultado[] = $row;
        }
        # pedir todos los datos de la tabla      
    }
}

$test = new test(1,2,3,6);
echo "Consulta: ";
var_dump( $test->consulta );
echo "<br><br> Resultado: ";
var_dump( $test->resultado );
?>