<?php include "../../connection/connection.php";
      include "../../functions/functions.php";
      

        session_start();
	$varsession = $_SESSION['user'];
	
	if($varsession == null || $varsession = ''){
	echo '<div class="alert alert-danger" role="alert">';
	echo "Usuario o Contraseña Incorrecta. Reintente Por Favor...";
	echo '<br>';
	echo "O no tiene permisos o no ha iniciado sesion...";
	echo "</div>";
	echo '<a href="../../index.php"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a>';	
	die();
	}
	
?>

<html><head>
	<meta charset="utf-8">
	<title>Usuarios - Nuevo Registro</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../../icons/actions/bookmarks-organize.png" />
	<?php skeleton();?>

	
  
  <script >
    function limitText(limitField, limitNum) {
       if (limitField.value.length > limitNum) {
          
           alert("Ha ingresado más caracteres de los requeridos, deben ser: \n" + limitNum);
            limitField.value = limitField.value.substring(0, limitNum);
       }
       
       if(limitField.value.lenght < limitNum){
	  alert("Ha ingresado menos caracteres de los requeridos, deben ser:  \n"  + limitNum);
            limitField.value = limitField.value.substring(0, limitNum);
       }
}
</script>

<script>
function Numeros(string){
//Solo numeros
    var out = '';
    var filtro = '1234567890';//Caracteres validos
	
    //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
    for (var i=0; i<string.length; i++){
       if (filtro.indexOf(string.charAt(i)) != -1){ 
             //Se añaden a la salida los caracteres validos
              out += string.charAt(i);
	     }else{
		alert("ATENCION - Sólo se permiten Números");
	     }
	     }
	
    //Retornar valor filtrado
    return out;
} 
</script>

<script> 
function Text(string){//validacion solo letras
    var out = '';
    //Se añaden las letras validas
    var filtro ="^[abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ ]+$"; // Caracteres Válidos
  
    for (var i=0; i<string.length; i++){
       if (filtro.indexOf(string.charAt(i)) != -1){ 
	     out += string.charAt(i);
	     }else{
		alert("ATENCION - Sólo se permite Texto");
	     }
	     }
    return out;
}
</script>
	
</head>
<body background="../../img/background.png" class="img-fluid" alt="Responsive image" style="background-repeat: no-repeat; background-position: center center; background-size: cover; height: 100%">

<!-- User and system info -->
<div class="container-fluid">
      <div class="row">
      <div class="col-md-12 text-center"><br>
	<button><span class="glyphicon glyphicon-user"></span> Usuario: <?php echo $_SESSION['user'] ?></button>
	<?php setlocale(LC_ALL,"es_ES"); ?>
	<button><span class="glyphicon glyphicon-time"></span> <?php echo "Hora Actual: " . date("H:i"); ?></button>
	 <?php setlocale(LC_ALL,"es_ES"); ?>
	<button><span class="glyphicon glyphicon-calendar"></span> <?php echo "Fecha Actual: ". strftime("%d de %B del %Y"); ?> </button>
	</div>
	</div>
	</div>
<!-- end user and system info -->
	<hr>
	
<!-- main body -->
<div class="container"><br>
<div class="row">
<div class="col-sm-10">

<div class="panel panel-info" >
  <div class="panel-heading">
    <h2 class="panel-title text-center text-default "><span class="pull-center "><img src="../../icons/actions/user-group-new.png"  class="img-reponsive img-rounded"> Nuevo Usuario</h2>
  </div>
    <div class="panel-body">
    
    
     <form action="formNuevoRegistro.php" method="post">
     
    
         
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input id="text" type="text" class="form-control" name="nombre" value="" onkeyup="this.value=Text(this.value);" placeholder="Nombre y Apellido" required>
  </div>
 
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input id="text" type="text" class="form-control" name="user" onKeyDown="limitText(this,20);" onKeyUp="limitText(this,20);" placeholder="User Name" required>
  </div>
   <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input id="email" type="email" class="form-control" name="email" onKeyUp="limitText(this,90);" placeholder="Email" required>
  </div>
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input id="password" type="password" class="form-control" name="pass1" onKeyDown="limitText(this,15);" onKeyUp="limitText(this,15);" placeholder="Password" required>
  </div>
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input  type="password" class="form-control" name="pass2" onKeyDown="limitText(this,15);" onKeyUp="limitText(this,15);" placeholder="Repita Password" required>
  </div>
  
   <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-question-sign"></i></span>
  <select class="browser-default custom-select" name="permisos" required>
  <option value="" disabled selected>Permisos</option>
  <option value="1" >Usuario</option>
  <option value="0" >Usuario Bloqueado</option>
  </select>
</div>
 
 
  <br>
 
 <div class="form-group">
   <div class="col-sm-offset-2 col-sm-12" align="left">
   <button type="submit" class="btn btn-success" name="A"><span class="glyphicon glyphicon-ok"></span>  Agregar</button>
   <a href="../main/main.php"><input type="button" value="Volver al Menú Principal" class="btn btn-primary"></a>
  </div>
  </div>
</form> 
    </div>
    <br>
    
    
    
    
    

</div>
</div>
</div>
</div>


</body>
</html>