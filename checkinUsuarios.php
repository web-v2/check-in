<?php 
require_once("config/reserva.php");
    require_once("config/Tools.php");
    $r = new Reserva();
    $hr = new Tools();
    $resp = $r->getCheckin($_GET['Token']);  
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-in</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js" ></script>    
    <script src="js/jquery.js"></script>
    <style>
        .container{
            width: 80%;
            height: 80%;
            padding: 20px;
        }
        .header{
            height: 150px;
            padding: 20px;
            text-align: center;                            
        }
        #genero{
            padding: 15px;                   
        }
    </style>
    <script>
        let valorAdultos = 450000;
        let valorNinos   = 350000;
        function calcularReserva(){
            const nAd = document.getElementById('nAdultos').value;
            const nNi = document.getElementById('nNinos').value;
            
            let val_A = valorAdultos*nAd;
            let val_N = valorNinos*nNi;
            let valorFinal = val_A+val_N;
            
            console.log(valorFinal);
            document.getElementById('valor').value = valorFinal;
        }
        function calcularFecha(){
            const fecha = document.getElementById('fecha_vuelo').value;
            const hoy = new Date();
            console.log(fecha);
            if(hoy <= fecha){
                console.log('fecha no valida')
            }else{
                console.log('Ok')
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="header bg-info">
            <h1>Aerolinea Stack Overflow</h1>
            <h3>Reporte Check In</h3>
        </div>
    <?php
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
    </div>
</body>
</html>