<?php 
require_once("config/checkIn.php");
if(isset($_POST['form-check']) && $_POST['form-check'] === 'guardar-check'){
$ch = new CheckIn();
$cantCliente = count($_POST["id_cliente"]);
$resp = $ch->crearCheckIn($cantCliente);
    if($resp){
        echo "        
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Check-In</strong> Successfully Added!.
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
<html lang="en">
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
        #codigo{
            padding: 10px;
            font-size: 20px;
            font-weight: bold;
        }
    </style>

<script>
    function buscarReserva(){
        let idReserv = $("#codigo").val().trim(); 
        if(idReserv.length <= 0 || idReserv == "" || idReserv == 0){
            console.log("Error, campo Input Vacio");
            $("#codigo").addClass("bg-warning");
        }else{
            $("#codigo").removeClass("bg-warning");
            var parametros = {"idReserv" : idReserv};        
            $.ajax({
                    data:  parametros,
                    url:   'ajaxReserva.php',
                    type:  'POST',

                    beforeSend: function () {
                        $("#query").html("<div class='spinner-border text-success' align='center'></div>");
                    },

                    success:  function (response) {
                        $("#query").html(response);                
                    }
            }); 
        }              
    }

    function buscarUsuario(){
        let idUsuario = $("#idUsuario").val().trim(); 
        if(idUsuario.length <= 0 || idUsuario == "" || idUsuario == 0){
            console.log("Error, campo Input Vacio");
            $("#idUsuario").addClass("bg-warning");
        }else{
            $("#idUsuario").removeClass("bg-warning");
            var parametros = {idUsuario};                

            $.ajax({
                    data:  parametros,
                    url:   'ajaxCliente.php',
                    type:  'POST',

                    beforeSend: function () {
                        $("#query").html("<div class='spinner-border text-success' align='center'></div>");
                    },

                    success:  function (response) {
                        $("#query").html(response);                
                    }
            }); 
        }         
    }

    function ActivarCasilla(casilla){
        miscasillas=document.getElementsByTagName('input'); //Rescatamos controles tipo Input
        for(i=0;i<miscasillas.length;i++) //Ejecutamos y recorremos los controles
        {
            if(miscasillas[i].type == "checkbox") // Ejecutamos si es una casilla de verificacion
            {
                miscasillas[i].checked=casilla.checked; // Si el input es CheckBox se aplica la funcion ActivarCasilla
            }
        }
    }    


    $(document).ready(function(){
        $('.tr-cliente').hide(); 
        $('.tr-reserva').hide(); 
        let r = 'activo';
        $('#btnReserva').click(function(){
            $('.tr-reserva').show();
            $('.tr-cliente').hide();       
        });  
        $('#btnCliente').click(function(){                        
            $('.tr-cliente').show();  
            $('.tr-reserva').hide();            
        });          
    });

    </script>
</head>
<body>
    <div class="container">
        <div class="header bg-info">
            <h1>Aerolinea Stack Overflow</h1>
            <h3>Check-In</h3>
        </div>

        <table class="table table-bordered">
            <tr>
                <th colspan="2" style="text-align: right">
                    <a href="viewClientes.php" class="btn btn-primary btn-sm">Ver Cliente</a>
                    <a href="viewVuelos.php" class="btn btn-primary btn-sm">Ver Vuelos</a>
                    <a href="viewReservas.php" class="btn btn-primary btn-sm">Ver Reserva</a>
                </th>
            </tr>
            <tr>
                <th><a href="#" id="btnReserva">Buscar Reserva</a></th>
            </tr>
            <div>
            <tr class="tr-reserva">
                <th>
                    <input type="text" name="codigo" id="codigo" placeholder="Código de Reserva" required class="form-control">
                </th>
            </tr>
            <tr class="tr-reserva">
                <td>
                    <input type="button" value="Buscar" id="btn-buscar" class="btn btn-success btn-lg" onclick="buscarReserva();">
                </td>
            </tr>
            </div>
            <tr>
                <th><a href="#" id="btnCliente">Buscar Check Cliente</a></th>
            </tr>
            <div>
            <tr class="tr-cliente">
                <th>
                    <input type="text" name="idUsuario" id="idUsuario" placeholder="Identificación de Usuario" required class="form-control">
                </th>
            </tr>
            <tr class="tr-cliente">
                <td>
                    <input type="button" value="Buscar" id="btn-buscar-usuario" class="btn btn-success btn-lg" onclick="buscarUsuario();">
                </td>
            </tr>  
            </div>          
        </table>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <input type="hidden" name="form-check" value="guardar-check">         
            <div id="query"></div>            
        </form>
    </div>
</body>
</html>