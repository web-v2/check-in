<?php 
require_once("config/reserva.php");
require_once("config/vuelo.php");
require_once("config/clientes.php");
if(isset($_POST['form-detalle']) && $_POST['form-detalle'] === 'guardar-detalle-reserva'){
$obj = new Reserva();
$cantCliente = count($_POST["cliente"]);
$resp = $obj->crearDetalleReserva($cantCliente);
    if($resp){
        echo "        
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Reservas</strong> Successfully Added!.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
        header('Location: index.php');
    }else{
        echo "        
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>             
            <strong>Error, verifique las instrucciones!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";   
    }
}
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
    $(function(){
    // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
    $("#agregar_fila").on('click', function(){
        $("#tabla_js tbody tr:eq(0)").clone().appendTo("#tabla_js tbody");
        //$("#tabla_js tbody tr:eq(0)").clone().removeClass('fila-base').appendTo("#tabla_js tbody");
    });
    // Evento que selecciona la fila y la elimina 
        $(document).on("click",".eliminar",function(){
            var parent = $(this).parents().get(0);
            $(parent).remove();
        });
    });        
    </script>
</head>
<body>
    <div class="container">
        <div class="header bg-info">
            <h1>Aerolinea Stack Overflow</h1>
            <h3>Detalle Reserva</h3>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <input type="hidden" name="form-detalle" value="guardar-detalle-reserva">
        <table class="table table-bordered">
            <tr>
                <th><label for="id">Código de Reserva</label></th>
                <td>
                    <input type="number" name="id1" id="id1" placeholder="Código de Reserva" readonly="readonly" class="form-control" value="<?php echo $_GET['token'];?>">
                    <input type="hidden" name="id" value="<?php echo $_GET['token'];?>">
                </td>
            </tr>
            <tr>
                <th><label for="vuelo">Vuelo</label></th>
                <td>
                   <select name="vuelo" id="vuelo" class="form-control">
                       <option value="">Seleccione Vuelo</option>
                       <?php 
                       $v = new Vuelo();
                       $resp = $v->getVuelos();
                       for ($i=0; $i < count($resp); $i++) { 
                       ?>
                            <option value="<?php echo $resp[$i]['Cod_vuelo'];?>"><?php echo $resp[$i]['Cod_vuelo'] ?>-<?php echo $resp[$i]['Nombre_avion_vuelo'] ?></option>
                       <?php 
                        }
                       ?>
                   </select> 
                </td>
            </tr>

            <tr>
                <th><label for="cliente">Cliente</label></th>
                <td>
                <?php 
                    $v = new Cliente();
                    $resp = $v->getClientes();
                    //for ($i=0; $i < count($resp); $i++) { 
                                          
                    /*$id = $resp[$i]['Id_cliente'];
                    $n = $resp[$i]['Nombre_cliente'];
                    $a = $resp[$i]['Apellido_cliente'];   
                    */                 
                                       
                    $c =$_GET["cant"];

                    for ($i=0; $i < $c; $i++) {                         
                        ?>
                        <select name="cliente[]" id="cliente" class="form-control">
                            <option value="">Seleccione Cliente</option>
                            <?php foreach ($resp as $clave => $valor) { ?> 
                            <option value="<?php echo $valor['Id_cliente'];?>"><?php echo $valor['Id_cliente'].' '.$valor['Nombre_cliente'].' '.$valor['Apellido_cliente'];?></option>                                                   
                            <?php                                                    
                            }
                            ?> 
                        </select>
                    <?php                         
                     }
                    ?>                                      
                </td>
            </tr>                                                                      
                               
            <tr>
                <td colspan="2">
                    <center>
                        <input type="submit" value="Guardar" class="btn btn-success btn-lg">
                        <a href="index.php" class="btn btn-lg btn-danger">Cancelar</a>
                    </center>
                </td>
            </tr>
        </table>
        </form>
    </div>
</body>
</html>