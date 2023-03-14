<?php 
require_once("config/vuelo.php");
if(isset($_POST['form-vuelo']) && $_POST['form-vuelo'] === 'guardar-vuelo'){
$cl = new Vuelo();

$resp = $cl->crearVuelo();
    if($resp){
        echo "        
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Vuelo</strong> Successfully Added!.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
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
</head>
<body>
    <div class="container">
        <div class="header bg-info">
            <h1>Aerolinea Stack Overflow</h1>
            <h3>Crear Vuelo</h3>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <input type="hidden" name="form-vuelo" value="guardar-vuelo">
        <table class="table table-bordered">
            <tr>
                <th><label for="id">Código de Vuelo</label></th>
                <td><input type="number" name="id" id="id" placeholder="Código de vuelo" required class="form-control"></td>
            </tr>
            <tr>
                <th><label for="nombre_vuelo">Nombre del Vuelo</label></th>
                <td>
                    <input type="text" name="nombre_vuelo" id="nombre_vuelo" required class="form-control" placeholder="Nombre del Vuelo">                    
                </td>
            </tr>  
            <tr>
                <th><label for="cant">Cantidad de Asientos</label></th>
                <td><input type="number" name="cant" id="cant" placeholder="Cant. Asientos" required class="form-control"></td>
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