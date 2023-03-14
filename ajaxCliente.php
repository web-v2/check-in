<?php
sleep(1);
//error_reporting(0);

if (isset($_POST) && $_POST['idUsuario']!=0) {
    require_once("config/reserva.php");
    require_once("config/Tools.php");
    $r = new Reserva();
    $hr = new Tools();
    $resp = $r->getUsuario($_POST['idUsuario']);  
    
    if($resp){ 
        if($resp !== 'YaConfirmado'){
            for ($j=0; $j < count($resp); $j++) {
                $edad=$hr->obtener_edad_segun_fecha($resp[$j]['Fecha_Nac_cliente']);
    ?>        
        <table class="table table-bordered">
        <tr class="bg-warning">
            <th colspan="7">
                <h2>Datos de Reserva: <?php echo $resp[$j]['Nombre_cliente']." ".$resp[$j]['Apellido_cliente']?></h2>
            </th>
        </tr>
        <tr>
            <th>Código de Reserva:</th>
            <td><?php echo $resp[$j]['idReserv']?></td>
            <th>Fecha:</th>
            <td><?php echo $resp[$j]['Fecha_reserva']?></td>
            <th>Valor:</th>
            <td><?php echo $resp[$j]['Valor_vuelo']?></td>
        </tr>

        <tr>
            <th>Código del Vuelo:</th>
            <td><?php echo $resp[$j]['Cod_vuelo']?></td>
            <th>Nombre del Vuelo:</th>
            <td><?php echo $resp[$j]['Nombre_avion_vuelo']?></td>
            <th>Asientos:</th>
            <td><?php echo $resp[$j]['No_asientos_vuelo']?></td>
        </tr>
        <tr>
            <th>Ciudad Origen:</th>
            <td><?php echo $resp[$j]['CiudadSalida_reserva']?></td>
            <th>Ciudad Destino:</th>
            <td><?php echo $resp[$j]['CiudadLlegada_reserva']?></td>
            <th>Cantidad Reserva:</th>
            <td><?php echo $resp[$j]['NoAdultos_reserva']+$resp[$j]['NoNinos_reserva']?></td>
        </tr>
        <tr>
            <th>Tipo y Numero Id:</th>
            <td><?php echo $resp[$j]['Tipo_doc_cliente']." ".$resp[$j]['Id_cliente']?></td>
            <th>Nombres y Apellidos:</th>
            <td><?php echo $resp[$j]['Nombre_cliente']." ".$resp[$j]['Apellido_cliente']?></td>
            <th>Correo Electrónico:</th>
            <td><?php echo $resp[$j]['Email_cliente']?></td>
        </tr>                
        <tr>
            <th>Telefonos:</th>
            <td><?php echo $resp[$j]['Telefono_cliente']?></td>
            <th>Genero:</th>
            <td><?php echo $resp[$j]['Genero_cliente']?></td>
            <th>Edad:</th>
            <td><?php echo $edad; ?></td>
        </tr>                
    </table>
    <?php
            }
          }
        }
    ?>
    <table class="table table-bordered">
        <tr>
        <td colspan="6">
        <center>                        
            <a href="index.php" class="btn btn-lg btn-danger">Atras</a>
        </center>
        </td>
        </tr>                   
    </table>
<?php
}
?>    