<?php
include_once 'db.php';
include_once 'Tools.php';
date_default_timezone_set('America/Bogota');
class Vuelo extends DB{
    private $vuelo;

    public function crearVuelo(){
        $hr = new Tools();
    	$id = $hr->limpiarCadena($_POST["id"]);     	
     	$nombre = $hr->limpiarCadena(strtoupper($_POST["nombre_vuelo"]));    
     	$cant = $hr->limpiarCadena($_POST["cant"]);  

        $vuelo = $this->connect()->prepare('INSERT INTO vuelo (`Cod_vuelo`, `Nombre_avion_vuelo`, `No_asientos_vuelo`) VALUES(:id,:nomb,:cant)');
        $vuelo->execute(['id'=>$id,'nomb'=>$nombre,'cant'=>$cant]);
        //close ($add_cliente);
        /**/if($vuelo->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function getVuelos(){
        $query = $this->connect()->prepare('SELECT * FROM vuelo');
        $query->execute();
    	while($filas = $query->FETCHALL(PDO::FETCH_ASSOC)){
         	return $this->vuelo[]=$filas;
        }	
        return false;        
    }
}
?>