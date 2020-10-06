<?php include "connection/connection.php"; 
      include "functions/functions.php"; ?>
      
<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="icons/actions/view-pim-tasks.png" />
  <meta name="description" content="">
  <meta name="author" content="">
  

  <title>SisEval - Sistema de Evalución de Desempeño</title>

  <!-- Bootstrap core CSS -->
  <link href="/siseval/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="/siseval/css/scrolling-nav.css" rel="stylesheet">
    <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="registro/password.php" data-toggle="tooltip" data-placement="botton" title="Ingrese aquí para blanquear su Password"><img class="img-reponsive img-rounded" src="icons/status/task-attempt.png" /> Olvidé mi Password</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
    </div>
  </nav>

  <header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Bienvenido al Sistema de Evaluación de Desempeño</h1>
      <h3>SisEval</h3>
      <p class="lead">Sistema de Seguimiento de las las Evaluaciones de Desempeño</p>
    </div>
  </header>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
        
         <?php
         
         if($conn){
         
	  if(isset($_POST['A'])){
         
	$user = mysqli_real_escape_string($conn,$_POST["user"]);
	$pass1 = mysqli_real_escape_string($conn,$_POST["pass"]);
	session_start();
	$_SESSION['user'] = $user;
	$_SESSION['pass'] = $pass1;
	        
	mysqli_select_db('siseval');
	
	$sql = "SELECT * FROM usuarios where user='$user' and password='$pass1' and role = 1";
	$q = mysqli_query($conn,$sql);
	
	$query = "SELECT * FROM usuarios where user='$user' and password='$pass1' and role = 0";
	$retval = mysqli_query($conn,$query);
	
	
	
	if(!$q && !$retval){	
			echo '<div class="alert alert-danger" role="alert">';
			echo "Error de Conexion..." .mysqli_error($conn);
			echo "</div>";
			echo '<a href="index.php"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a>';	
			exit;			
			
			}
		
			if($user = mysqli_fetch_assoc($retval)){
				

				echo '<div class="alert alert-danger" role="alert">';
				echo "<strong>Atención!  </strong>" .$_SESSION["user"];
				echo "<br>";
				echo '<span class="pull-center "><img src="icons/status/security-low.png"  class="img-reponsive img-rounded"><strong> Usuario Bloqueado. Contacte al Administrador.</strong>';
				echo "</div>";
				exit;
			}

			else if($user = mysqli_fetch_assoc($q)){

				if(strcmp($_SESSION["user"], 'root') == 0){

				echo "<br>";
				echo '<div class="alert alert-success" role="alert">';
				echo '<button class="btn btn-success">
				      <span class="spinner-border spinner-border-sm"></span>
				      </button>';
				echo "<strong> Bienvenido!  </strong>" .$_SESSION["user"];
				echo "<strong> Aguarde un Instante...</strong>";
				echo "<br>";
				echo "</div>";
  				echo '<meta http-equiv="refresh" content="5;URL=1/main/main.php "/>';
				
			}else{
				echo '<div class="alert alert-success" role="alert">';
				echo '<button class="btn btn-success">
				      <span class="spinner-border spinner-border-sm"></span>
				      </button>';
				echo "<strong> Bienvenido!  </strong>" .$_SESSION["user"];
				echo "<strong> Aguarde un Instante...</strong>";
				echo "<br>";
				echo "</div>";
  				echo '<meta http-equiv="refresh" content="5;URL=1/main/main.php "/>';
				
			}
			}else{
				echo '<div class="alert alert-danger" role="alert">';
				echo '<span class="pull-center "><img src="icons/status/dialog-warning.png"  class="img-reponsive img-rounded"> Usuario o Contraseña Incorrecta. Reintente Por Favor....';
				echo "</div>";
				}
				}
				}else{
				  mysqli_error($conn);
				}
	
			
	
	//cerramos la conexion
	
	mysqli_close($conn);
           
      ?>
        
        <h1>Ingresar</h1><hr>
          <form action="index.php" method="POST">
	    <div class="form-group">
	      <label for="usuario">Usuario:</label>
	      <input style="text-align: center" type="text" class="form-control" id="usuario" name="user" required>
	    </div>
	    <div class="form-group">
	      <label for="pwd">Password:</label>
	      <input style="text-align: center" type="password" class="form-control" id="pwd" name="pass" required>
	    </div>
	    <button type="submit" name="A" class="btn btn-primary btn-block">Ingresar</button><br>
	    <button type="reset" class="btn btn-danger btn-block">Borrar</button>
	  </form> 
        </div>
      </div>
    </div>
  </section>

 

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white"><img class="img-reponsive img-rounded" src="img/escudo32x32.png" /> Ministerio de Economía de la Nación - Dirección de Presupuesto y Evaluación de Gastos en Personal</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="/siseval/vendor/jquery/jquery.min.js"></script>
  <script src="/siseval/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="/siseval/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="/siseval/js/scrolling-nav.js"></script>

</body>

</html>
