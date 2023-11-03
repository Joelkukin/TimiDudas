<?php
class Post{
    public $id_clase;
    public $likes;
    public $contenido;
    public $dia;
    public $hora;
    public function __construct($contenido, $idClase){

        $this->likes=0;
        $this->contenido=$contenido;
        $mes= explode(" ","ene feb mar abr may jun jul ago sep oct nov dic");
        $this->dia=date("d")." ".date("m");
        $this->hora=date("H").":".date("i");
        $this->id_clase=$idClase;
    }

    public function newlike(){
        $this->likes++;
    }
}
    
?>