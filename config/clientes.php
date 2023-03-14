<?php
include_once 'db.php';
include_once 'Tools.php';
date_default_timezone_set('America/Bogota');
class Cliente extends DB{
    private $cliente;

    public function crearCliente(){
        $hr = new Tools();
    	$id = $hr->limpiarCadena($_POST["id"]);
     	$tdoc = $hr->limpiarCadena($_POST["tipoDoc"]);
     	$nombres = $hr->limpiarCadena(strtoupper($_POST["nombres"]));
     	$apellidos = $hr->limpiarCadena(strtoupper($_POST["apellidos"]));
     	$email = $hr->limpiarCadena($_POST["email"]);
     	$cell = $hr->limpiarCadena($_POST["cell"]);
     	$genero = $hr->limpiarCadena($_POST["genero"]);
     	$fnac = $hr->limpiarCadena($_POST["fnac"]);
        $edad = $hr->obtener_edad_segun_fecha($fnac);   

        $cliente = $this->connect()->prepare('INSERT INTO cliente (`Id_cliente`, `Tipo_doc_cliente`, `Nombre_cliente`, `Apellido_cliente`, `Email_cliente`, `Telefono_cliente`, `Genero_cliente`, `Fecha_Nac_cliente`, `Edad_cliente`) VALUES(:id,:tp,:nomb,:apell,:email,:tel,:gen,:f_fac,:edd)');
        $cliente->execute(['id'=>$id,'tp'=>$tdoc,'nomb'=>$nombres,'apell'=>$apellidos,'email'=>$email,'tel'=>$cell,'gen'=>$genero,'f_fac'=>$fnac,'edd'=>$edad]);
        //close ($add_cliente);
        if($cliente->rowCount()){
            return true;
        }else{
            return false;
        }
    }
    public function getClientes(){
        $query = $this->connect()->prepare('SELECT * FROM cliente');
        $query->execute();
    	while($filas = $query->FETCHALL(PDO::FETCH_ASSOC)){
         	return $this->cliente[]=$filas;
        }	
        return false;        
    }    
}
?>