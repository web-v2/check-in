<?php
include_once 'db.php';
include_once 'Tools.php';
include_once 'reserva.php';
date_default_timezone_set('America/Bogota');
class CheckIn extends DB{
    private $CheckIn;

    public function crearCheckIn($cant){
        $hr = new Tools();
    	$idVuelo = $hr->limpiarCadena($_POST["cod_vuelo"]);     	
     	$idReserva = $hr->limpiarCadena($_POST["cod_reserva"]); 
        for ($x=0; $x < $cant; $x++) { 
            $cliente = $hr->limpiarCadena($_POST["id_cliente"][$x]);
            $check = $this->connect()->prepare('INSERT INTO checkin (`Cod_checkIn`, `Cod_vuelo`, `Id_cliente`, `Cod_reserva`) VALUES(null,:idV,:idC,:idR)');
            $check->execute(['idV'=>$idVuelo,'idC'=>$cliente,'idR'=>$idReserva]);
        }
        if($check->rowCount()){
            $estado = 'Confirmado';
            for ($y=0; $y < $cant; $y++) { 
                $cliente = $hr->limpiarCadena($_POST["id_cliente"][$y]);
                $res = $this->connect()->prepare('UPDATE `detallereserva` SET `estado_reserva` = :estado WHERE `detallereserva`.`idCliente` = :id;');
                $res->execute(['id'=>$cliente,'estado'=>$estado]);
            }
            return true;
        }else{
            return false;
        }
        
    }
    public function getCheck(){
        $query = $this->connect()->prepare('SELECT * FROM checkin');
        $query->execute();
    	while($filas = $query->FETCHALL(PDO::FETCH_ASSOC)){
         	return $this->CheckIn[]=$filas;
        }	
        return false;        
    }    
}
?>