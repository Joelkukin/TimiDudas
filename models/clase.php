<?php
    require_once("DataBase.php");
    class clase extends DataBase{
   
        public $id_clase;
        public $nombre_clase;
        public $fecha_clase;
        public $materia;
        public $profesor;
        public $posts;

        function __construct(){
            $posts=array();

            $this->posts[]=$this->consultaPrep("SELECT * FROM posts WHERE clase = ?","i",[1]);
        }

        function setPost($contenido){
            $i = count($this->posts);
            $this->posts[$i]= new Post($contenido, $this->id_clase);
            $this->posts[$i]->id= $i;
        }
        function getPost($id){
            var_dump($this->posts[$id]);
            return $this->posts[$id];
        }

        function _editName(){

            return 0;
        }
        function _editDate(){

            return 0;
        }
        function _editMateria(){

            return 0;
        }
        function _editProfesor(){

            return 0;
        }


    }

    /* TEST */

    /* OBJETIVO: */
    /* clase-23-ago->post-abc // 
       retorna {
        contenido:"contenido",
        autor: "nombre",
    } 
    */
    $clase=new clase();
    echo "";
    $clase->getPost(15);
    echo "";
    echo "";
    echo "";
?>