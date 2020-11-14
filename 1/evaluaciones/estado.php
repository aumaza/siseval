<?php include "../../connection/connection.php"; 
      include "../../functions/functions.php";
      

        session_start();
	$varsession = $_SESSION['user'];
	
	$sql = "select nombre from usuarios where user = '$varsession'";
	mysqli_select_db('siseval');
	$query = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($query)){
	      $nombre = $row['nombre'];
	}
	
	if($varsession == null || $varsession = ''){
	echo '<div class="alert alert-danger" role="alert">';
	echo "Usuario o Contraseña Incorrecta. Reintente Por Favor...";
	echo '<br>';
	echo "O no tiene permisos o no ha iniciado sesion...";
	echo "</div>";
	echo '<a href="../../logout.php"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a>';	
	die();
	}
	
	
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <title>Formulario de Evaluación</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="../../icons/actions/story-editor.png" />
  <?php skeleton(); ?>
  
  <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
  
  <style>
  
    body{
    background: #BE93C5;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #7BC6CC, #BE93C5);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #7BC6CC, #BE93C5); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
      }
      .affix {
    top: 0;
    width: 100%;
    z-index: 9999 !important;
  }

  .affix + .container-fluid {
    padding-top: 70px;
  }
  </style>
</head>
<body>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Sistema de Administración de Evaluaciones de Desempeño</h1>      
  </div>
</div>

<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="197">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      <a href="../main/main.php" data-toggle="tooltip" title="Volver al Menú Principal"><button class="btn btn-default navbar-btn"><img class="img-reponsive img-rounded" src="../../icons/actions/go-home.png" /> Home</button></a>
        </ul>
      <ul class="nav navbar-nav navbar-right">
        <a href="#" data-toggle="tooltip" title="<?php echo 'Nombre: ' .$nombre. '   '. 'Usuario: ' .$_SESSION['user']; ?>"><button class="btn btn-default navbar-btn"><img class="img-reponsive img-rounded" src="../../icons/actions/meeting-attending.png" /> <?php echo "<strong>Usuario:</strong> " . $nombre; ?></button></a>
       </ul>
    </div>
  </div>
</nav>


<?php

if($conn){

    $nivel = $_GET['nivel'];
    
  if($nivel == 1){

      $id = $_GET['id'];
	// obtenemos nombre del agente
	$sql = "select * from evaluaciones1 where id = '$id'";
	mysqli_select_db('siseval');
	$query = mysqli_query($conn,$sql);
	while($fila = mysqli_fetch_array($query)){
	      $nivel = $fila['nivel'];
	      $nombre = $fila['agente'];
	      $f_desde = $fila['f_desde'];
	      $f_hasta = $fila['f_hasta'];
        }
      editForm1($id,$nombre,$f_desde,$f_hasta,$conn);
      
      }
      if($nivel == 2 && $niv_func_ejec == 5){
      
      //formulario2($agente,$cuil,$nivel_grado,$estudios,$nivel,$revista);
      
      }
      if($nivel == 3 && $niv_func_ejec == 5){
      
      //formulario3($agente,$cuil,$nivel_grado,$estudios,$nivel,$revista);
      
      }
      if($nivel == 4 && $niv_func_ejec == 0){
      
      //formulario4($agente,$cuil,$nivel_grado,$estudios,$nivel,$revista);
      
      }
      if($nivel == 5 && $niv_func_ejec == 0){
      
      //formulario5($agente,$cuil,$nivel_grado,$estudios,$nivel,$revista);
      
      }
      if($nivel == 6){
      
      $id = $_GET['id'];
	// obtenemos nombre del agente
	$sql = "select * from evaluaciones6 where id = '$id'";
	mysqli_select_db('siseval');
	$query = mysqli_query($conn,$sql);
	while($fila = mysqli_fetch_array($query)){
	      $nivel = $fila['nivel'];
	      $nombre = $fila['agente'];
	      $f_desde = $fila['f_desde'];
	      $f_hasta = $fila['f_hasta'];
        }
      
      editForm6($id,$nombre,$f_desde,$f_hasta,$conn);
      
      }


}else{
  echo "Database Error Connection!!" .mysqli_error($conn);
}
?>


<div class="container-fluid">
<div class="row">
<footer class="container-fluid text-center">
  <p><img class="img-reponsive img-rounded" src="../../img/escudo32x32.png" /> Ministerio de Economia de la Nación - Dirección de Presupuesto y Evaluación de Gastos en Personal</p>  
</footer>
</div>
</div>


</body>
</html>
