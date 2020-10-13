<?php  include "../../functions/functions.php"; ?>
<?php  include "../../connection/connection.php"; 

	session_start();
	$varsession = $_SESSION['user'];
	
	if($varsession == null || $varsession = ''){
	echo '<div class="alert alert-danger" role="alert">';
	echo "Usuario o Contraseña Incorrecta. Reintente Por Favor...";
	echo '<br>';
	echo "O no tiene permisos o no ha iniciado sesion...";
	echo "</div>";
	echo '<a href="../logout.php"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a>';	
	die();
	}

	$id = $_GET['id'];
	

?>


<html><head>
	<meta charset="utf-8">
	<title>SisEval - Actualizar Agente</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../../icons/actions/bookmarks-organize.png" />
	<?php skeleton();?>
	
</head>
<body background="../../img/background.png" class="img-fluid" alt="Responsive image" style="background-repeat: no-repeat; background-position: center center; background-size: cover; height: 100%">

<div class="container-fluid">
      <div class="row">
      <div class="col-md-12 text-center">
	<button><span class="glyphicon glyphicon-user"></span> Usuario: <?php echo $_SESSION['user'] ?></button>
	<?php setlocale(LC_ALL,"es_ES"); ?>
	<button><span class="glyphicon glyphicon-time"></span> <?php echo "Hora Actual: " . date("H:i"); ?></button>
	 <?php setlocale(LC_ALL,"es_ES"); ?>
	<button><span class="glyphicon glyphicon-calendar"></span> <?php echo "Fecha Actual: ". strftime("%d de %B del %Y"); ?> </button>
	</div>
	</div>
	</div>
	<br>

  <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        
                    </div>
                </div>
            </div>
        </div>
        
       <?php
        
       if($conn){
       
	mysqli_select_db('siseval');
	  	
	     if (isset($_POST['A'])){
			    
			    $id = mysqli_real_escape_string($conn,$_POST["id"]);
			    $nombre = mysqli_real_escape_string($conn,$_POST["nombre"]);
                            $cuil = mysqli_real_escape_string($conn,$_POST["cuil"]);
                            $f_nac = mysqli_real_escape_string($conn,$_POST["f_nac"]);
                            $nivel_grado = mysqli_real_escape_string($conn,$_POST["nivel_grado"]);
                            $revista = mysqli_real_escape_string($conn,$_POST["revista"]);
                            $sexo = mysqli_real_escape_string($conn,$_POST["sexo"]);
                            $nivel = mysqli_real_escape_string($conn,$_POST["nivel"]);
                            $estudios = mysqli_real_escape_string($conn,$_POST["estudios"]);
                            $func_ejec = mysqli_real_escape_string($conn,$_POST["func_ejec"]);
                            $niv_func_ejec = mysqli_real_escape_string($conn,$_POST["niv_func_ejec"]);
                            $sanciones = mysqli_real_escape_string($conn,$_POST["sanciones"]);
                                                        
                             updateAgente($id,$nombre,$cuil,$f_nac,$nivel_grado,$revista,$sexo,$nivel,$estudios,$func_ejec,$niv_func_ejec,$sanciones,$conn);
                        

                             }
                             }else {
                                    mysqli_error($conn);
                                   }

  //cerramos la conexion
  
  mysqli_close($conn);


?>
<div class="container">
<div class="row">
<div class="col-md-12">
<meta http-equiv="refresh" content="3;URL=../main/main.php "/>
</div>
</div>
</div>
</div>


</body>
</html>
