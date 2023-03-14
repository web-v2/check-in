<?php
include_once 'db.php';
include_once 'Tools.php';
require_once 'clientes.php';
require_once 'reserva.php';
require_once 'vuelo.php';
date_default_timezone_set('America/Bogota');
class Reserva extends DB{
    private $id_reserva;
    private $cant;

    public function crearReserva(){        
        $hr = new Tools();
    	$id = $hr->limpiarCadena($_POST["id"]);     
        $fecha = $hr->limpiarCadena($_POST["fecha"]);     
        $origen = $hr->limpiarCadena($_POST["Origen"]);     	
     	$destino = $hr->limpiarCadena($_POST["Destino"]);    
     	$adult = $hr->limpiarCadena($_POST["nAdultos"]);  
        $ninos = $hr->limpiarCadena($_POST["nNinos"]);  
        $valor = $hr->limpiarCadena($_POST["valor"]);
        $f_actual = date("Y-m-d");
        if($fecha <= $f_actual){
            return false;
        }
        $reserva = $this->connect()->prepare('INSERT INTO reserva (`Cod_reserva`, `Fecha_reserva`, `CiudadSalida_reserva`, `CiudadLLegada_reserva`, `NoAdultos_reserva`, `NoNinos_reserva`, `Valor_vuelo`) VALUES(:id,:fech,:ori,:dest,:adul,:nin,:val)');
        $reserva->execute(['id'=>$id,'fech'=>$fecha,'ori'=>$origen,'dest'=>$destino,'adul'=>$adult,'nin'=>$ninos,'val'=>$valor]);
        //close ($add_cliente);

        if($reserva->rowCount()){
            $this->id_reserva = $id;
            $this->cant = $adult + $ninos;
            return true;
        }else{
            return false;
        }
    }
    public function crearDetalleReserva($cant){  
        //print_r($_POST);
        $hr = new Tools();
    	$idReserv = $hr->limpiarCadena($_POST["id"]);                 
        $idVuelo = $hr->limpiarCadena($_POST["vuelo"]);     	

		for ($x=0; $x < $cant; $x++) { 
            $cliente = $hr->limpiarCadena($_POST["cliente"][$x]);
            $reserva = $this->connect()->prepare('INSERT INTO detallereserva (`idDet`, `idReserv`, `idCliente`, `idVuelo`, `estado_reserva`) VALUES(null,:reserva,:cliente,:vuelo,:st)');
            $reserva->execute(['reserva'=>$idReserv,'cliente'=>$cliente,'vuelo'=>$idVuelo,'st'=>'Reservado']);
        }
       
        if($reserva->rowCount()){
            return true;
        }else{
            return false;
        }
    } 
    
    public function getReserva($id){

        $reserva = $this->connect()->prepare('SELECT * FROM `detallereserva` WHERE `idReserv` = :id');
        $reserva->execute(['id'=>$id]);
        $check = $this->connect()->prepare('SELECT * FROM `checkin` WHERE `Cod_reserva` = :id');
        $check->execute(['id'=>$id]);
        $r =$reserva->rowCount();
        $c =$check->rowCount();
        if( $r== $c && $r>0){
            echo "
            <div class='alert alert-warning' role='alert'>
                Error, Código de reserva No ".$id.", ya se encuentra confirmado!
            </div>
            ";
            return $data = 'YaConfirmado';
        }else{
            $query = $this->connect()->prepare('SELECT * FROM `detallereserva`,`vuelo`,`reserva`,`cliente` 
            WHERE `reserva`.`Cod_reserva` = :id
            AND `detallereserva`.`estado_reserva` != "Confirmado"
            AND `detallereserva`.`idReserv` = `reserva`.`Cod_reserva`
            AND `vuelo`.`Cod_vuelo` = `detallereserva`.`idVuelo`
            AND `cliente`.`Id_cliente` = `detallereserva`.`idCliente`;');
            $query->execute(['id'=>$id]);
            while($filas = $query->FETCHALL(PDO::FETCH_ASSOC)){
                return $this->vuelo[]=$filas;
            }
          return false;
        }                
    }

    public function getCheckin($id){
        $query = $this->connect()->prepare('SELECT * FROM `detallereserva`,`vuelo`,`reserva`,`cliente` 
        WHERE `reserva`.`Cod_reserva` = :id
        AND `detallereserva`.`estado_reserva` = "Confirmado"
        AND `detallereserva`.`idReserv` = `reserva`.`Cod_reserva`
        AND `vuelo`.`Cod_vuelo` = `detallereserva`.`idVuelo`
        AND `cliente`.`Id_cliente` = `detallereserva`.`idCliente`;');
        $query->execute(['id'=>$id]);
        while($filas = $query->FETCHALL(PDO::FETCH_ASSOC)){
            return $this->vuelo[]=$filas;
        }
          return false;                
    }

    public function getUsuario($id){
        $query = $this->connect()->prepare('SELECT * FROM `detallereserva`,`vuelo`,`reserva`,`cliente` 
        WHERE `cliente`.`Id_cliente` = :id
        AND `detallereserva`.`estado_reserva` = "Confirmado"
        AND `detallereserva`.`idReserv` = `reserva`.`Cod_reserva`
        AND `vuelo`.`Cod_vuelo` = `detallereserva`.`idVuelo`
        AND `cliente`.`Id_cliente` = `detallereserva`.`idCliente`;');
        $query->execute(['id'=>$id]);
        while($filas = $query->FETCHALL(PDO::FETCH_ASSOC)){
            return $this->vuelo[]=$filas;
        }
          return false;                
    }


    public function getReservaGeneral(){
        $query = $this->connect()->prepare('SELECT * FROM `detallereserva`,`vuelo`,`reserva`,`cliente` 
        WHERE `reserva`.`Cod_reserva` = `detallereserva`.`idReserv`
        AND `detallereserva`.`idReserv` = `reserva`.`Cod_reserva`
        AND `vuelo`.`Cod_vuelo` = `detallereserva`.`idVuelo`
        AND `cliente`.`Id_cliente` = `detallereserva`.`idCliente`
        ORDER BY `reserva`.`Fecha_reserva` ASC;');
        $query->execute();
        while($filas = $query->FETCHALL(PDO::FETCH_ASSOC)){
            return $this->vuelo[]=$filas;
        }
        return false;
    }                  

    public function id_reserva(){
        return $this->id_reserva;
    }
    public function cant_reserva(){
        return $this->cant;
    }    
}
?>