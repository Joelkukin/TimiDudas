<?php
# 
#creo la interfaz de base de datos
class DataBase{
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

    function consultaPrep($consulta, $types, $params = array()){ # LISTA
        //objeto Consulta = stmt
        $stmt = $this->conexion->prepare($consulta); // ejecutar consulta sql y guardar en $resp
        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
        }
    
        // Transforma los elementos de params en referencias
        $params_ref = array();
        foreach($params as $key => $value) {
            $params_ref[$key] = &$params[$key];
        }
    
        // Llama a bind_param con los parámetros en un array
        call_user_func_array(array($stmt, 'bind_param'), array_merge(array($types), $params_ref));
    
        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }
    
        $result = $stmt->get_result();
        
        // Fetch all data
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        return json_encode($data);
    }
}
$baseDatos= new DataBase("clases");
$baseDatos->consultaPrep("SELECT titulo FROM clases WHERE id_clase in (?,?)","ii",[1,10]);
var_dump($baseDatos);
?>