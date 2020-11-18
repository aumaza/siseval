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
  
  $nivel = mysqli_real_escape_string($conn,$_POST["nivel"]);
  $revista = mysqli_real_escape_string($conn,$_POST["revista"]);
  
  $jurisdiccion = mysqli_real_escape_string($conn,$_POST["juris"]);
  $secretaria = mysqli_real_escape_string($conn,$_POST["secretaria"]);
  $subsecretaria = mysqli_real_escape_string($conn,$_POST["subsecretaria"]);
  $direccion = mysqli_real_escape_string($conn,$_POST["direccion"]);
  $unidad = mysqli_real_escape_string($conn,$_POST["unidad"]);
  $unidad2 = mysqli_real_escape_string($conn,$_POST["unidad2"]);
  $cod_uni = mysqli_real_escape_string($conn,$_POST["cod_uni"]);
  $nom_eval = mysqli_real_escape_string($conn,$_POST["nombre_evaluador"]);
  $dni_eval = mysqli_real_escape_string($conn,$_POST["dni_evaluador"]);
  $sit_esc_eval = mysqli_real_escape_string($conn,$_POST["sit_esc_eval"]);
  $niv_gr_eval = mysqli_real_escape_string($conn,$_POST["nivel_grado_eval"]);
  $agrup_eval = mysqli_real_escape_string($conn,$_POST["agrupamiento_eval"]);
  $cargo_eval = mysqli_real_escape_string($conn,$_POST["cargo_eval"]);
  $nombre_agente = mysqli_real_escape_string($conn,$_POST["nombre_agente"]);
  $dni_agente = mysqli_real_escape_string($conn,$_POST["dni_agente"]);
  $leg_agente = mysqli_real_escape_string($conn,$_POST["legajo_agente"]);
  $ng_agente = mysqli_real_escape_string($conn,$_POST["ng_agente"]);
  $agrupamiento2 = mysqli_real_escape_string($conn,$_POST["agrupamiento2"]);
  $educacion = mysqli_real_escape_string($conn,$_POST["educacion"]);
  $f_desde = mysqli_real_escape_string($conn,$_POST["f_desde"]);
  $f_hasta = mysqli_real_escape_string($conn,$_POST["f_hasta"]);
  
  addEvalDatos($jurisdiccion,$secretaria,$subsecretaria,$direccion,$unidad,$unidad2,$cod_uni,$nom_eval,$dni_eval,$sit_esc_eval,$niv_gr_eval,$agrup_eval,$cargo_eval,$nombre_agente,$dni_agente,$leg_agente,$ng_agente,$agrupamiento2,$educacion,$f_desde,$f_hasta,$conn);

  $item1 = mysqli_real_escape_string($conn,$_POST["item1"]);
  $item2 = mysqli_real_escape_string($conn,$_POST["item2"]);
  $item3 = mysqli_real_escape_string($conn,$_POST["item3"]);
  $item4 = mysqli_real_escape_string($conn,$_POST["item4"]);
  $item5 = mysqli_real_escape_string($conn,$_POST["item5"]);
  $item6 = mysqli_real_escape_string($conn,$_POST["item6"]);
  $item7 = mysqli_real_escape_string($conn,$_POST["item7"]);
  $item8 = mysqli_real_escape_string($conn,$_POST["item8"]);
  $item9 = mysqli_real_escape_string($conn,$_POST["item9"]);
  $item10 = mysqli_real_escape_string($conn,$_POST["item10"]);
  $item11 = mysqli_real_escape_string($conn,$_POST["item11"]);
  $item12 = mysqli_real_escape_string($conn,$_POST["item12"]);
  
  $sum = $item1+$item2+$item3+$item4+$item5+$item6+$item7+$item8+$item9+$item10+$item11+$item12;
  
  if($sum >= 0 && $sum <= 7){
      $result = "Deficiente";
  }
  if($sum >= 8 && $sum <= 19){
      $result = "Regular";
  }
  if($sum >= 20 && $sum <= 31){
      $result = "Bueno";
  }
  if($sum >= 32 && $sum <= 43){
      $result = "Muy Bueno";
  }
  if($sum >= 44 && $sum <= 48){
      $result = "Destacado";
  }
  
  $estado = "abierta";
  addEvaluacion3($item1,$item2,$item3,$item4,$item5,$item6,$item7,$item8,$item9,$item10,$item11,$item12,$nombre_agente,$dni_agente,$ng_agente,$revista,$nivel,$sum,$result,$f_desde,$f_hasta,$estado,$conn);

if($conn){

    if(isset($_POST['A'])){
        resultadoForm3($nombre_agente,$item1,$item2,$item3,$item4,$item5,$item6,$item7,$item8,$item9,$item10,$item11,$item12,$sum,$result,$f_desde,$f_hasta);
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
