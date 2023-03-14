<?php 
require_once("config/clientes.php");
if(isset($_POST['form-cliente']) && $_POST['form-cliente'] === 'guardar-cliente'){
$cl = new Cliente();

$resp = $cl->crearCliente();
    if($resp){
        echo "        
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Cliente</strong> Successfully Added!.
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
            <h3>Crear Cliente</h3>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <input type="hidden" name="form-cliente" value="guardar-cliente">
        <table class="table table-bordered">
            <tr>
                <th><label for="id"># Identificación</label></th>
                <td><input type="number" name="id" id="id" placeholder="Código Cliente" required class="form-control"></td>
            </tr>
            <tr>
                <th><label for="tipoDoc">Tipo Documento</label></th>
                <td>
                    <select name="tipoDoc" id="tipoDoc" class="form-control">
                        <option value="RC">RC</option>
                        <option value="TI">TI</option>
                        <option value="CC">CC</option>
                        <option value="CE">CE</option>
                        <option value="PE">PE</option>
                        <option value="PS">PS</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="nombres">Nombres y Apellidos</label></th>
                <td>
                    <input type="text" name="nombres" id="nombre1" placeholder="Nombres del Cliente" required class="form-control">                    
                    <input type="text" name="apellidos" id="apellido1" placeholder="Apellidos del Cliente" required class="form-control">                    
                </td>
            </tr>  
            <tr>
                <th><label for="email">Correo Electrónico</label></th>
                <td><input type="email" name="email" id="email" placeholder="Correo Cliente" required class="form-control"></td>
            </tr>     
            <tr>
                <th><label for="cel">Celular</label></th>
                <td><input type="number" name="cell" id="cell" placeholder="Celular Cliente" required class="form-control"></td>
            </tr>
            <tr>
                <th><label for="genero">Genero</label></th>
                <td>
                <h3>F<input class="form-check-input mt-0" type="radio" name="genero" id="genero" value="F" aria-label="Radio button for following text input">
                M<input class="form-check-input mt-0" type="radio" name="genero" id="genero" value="M" aria-label="Radio button for following text input"></h3>
                </td>
            </tr> 
            <tr>
                <th><label for="fnac">Fecha de Nacimiento</label></th>
                <td><input type="date" name="fnac" id="fnac" class="form-control"></td>
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