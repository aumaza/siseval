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
  <title>Siseval - Panel Principal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="../../icons/actions/view-pim-tasks.png" />
  <?php skeleton(); ?>
  
  <!-- Data Table Script -->
<script>
 $(document).ready(function(){
      $('#myTable').DataTable({
      "order": [[1, "asc"]],
      "responsive": true,
      "scrollY":        "300px",
        "scrollX":        true,
        "scrollCollapse": true,
        "paging":         true,
        "fixedColumns": true,
      "language":{
        "lengthMenu": "Mostrar _MENU_ registros por pagina",
        "info": "Mostrando pagina _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtrada de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search": "Buscar:",
        "zeroRecords":    "No se encontraron registros coincidentes",
        "paginate": {
          "next":       "Siguiente",
          "previous":   "Anterior"
        },
      }
    });

  });
  </script>
  <!-- END Data Table Script -->
  
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
    var filtro = '1234567890.';//Caracteres validos
	
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
    var filtro ="^[abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ-' ]+$"; // Caracteres Válidos
  
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

  <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>

  <style>
  
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 150%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
     .avatar {
  vertical-align: middle;
  horizontal-align: right;
  width: 60px;
  height: 60px;
  border-radius: 60%;
}
.affix {
    top: 0;
    width: 100%;
    z-index: 9999 !important;
  }

  .affix ~ .container-fluid {
    position: relative;
    padding-top: 70px;
  }
  </style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">

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
      <button class="btn btn-default navbar-btn"><img class="img-reponsive img-rounded" src="../../icons/apps/clock.png" /> <?php echo "<strong>Hora Actual:</strong> " . date("H:i"); ?></button>
      <?php setlocale(LC_ALL,"es_ES"); ?>
      <button class="btn btn-default navbar-btn"><img class="img-reponsive img-rounded" src="../../icons/actions/view-calendar-day.png" /> <?php echo "<strong>Fecha Actual:</strong> ". strftime("%d de %b de %Y"); ?></button>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <a href="../../logout.php" data-toggle="tooltip" data-placement="left" title="Cerrar Sesión"> <button class="btn btn-danger navbar-btn"><img class="img-reponsive img-rounded" src="../../icons/actions/go-previous-view.png" /> Salir</button></a>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <form action="main.php" method="POST">
	<?php
	if($_SESSION['user'] == 'root'){
	echo '
	 <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
        Administrar Agentes</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse">
      <div class="panel-body">
      <a href="#" data-toggle="tooltip" data-placement="right" title="Cargar Agente"><button type="submit" class="btn btn-default btn-sm" name="A"><img class="img-reponsive img-rounded" src="../../icons/actions/user-group-new.png" /> Agente</button></a><hr>
	<a href="#" data-toggle="tooltip" data-placement="right" title="Listar Agentes"><button type="submit" class="btn btn-default btn-sm" name="B"><img class="img-reponsive img-rounded" src="../../icons/apps/preferences-contact-list.png" /> Agentes</button></a>
      
      </div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        Administrar Usuarios</a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">
      
      <a href="#" data-toggle="tooltip" data-placement="right" title="Administración de Usuarios"><button type="submit" class="btn btn-default btn-sm" name="C"><img class="img-reponsive img-rounded" src="../../icons/actions/meeting-attending.png" /> Usuarios</button></a>
      
      </div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
        Administrar Evaluaciones</a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">
      <a href="#" data-toggle="tooltip" data-placement="right" title="Evaluaciones Nivel Gerencial"><button type="submit" class="btn btn-default btn-sm" name="G"><img class="img-reponsive img-rounded" src="../../icons/actions/view-list-text.png" /> Evaluaciones Nivel 1</button></a><hr>
      
      <a href="#" data-toggle="tooltip" data-placement="right" title="Evaluaciones Nivel Medio Profesional"><button type="submit" class="btn btn-default btn-sm" name="H"><img class="img-reponsive img-rounded" src="../../icons/actions/view-list-text.png" /> Evaluaciones Nivel 2</button></a><hr>
      
      <a href="#" data-toggle="tooltip" data-placement="right" title="Evaluaciones Nivel Medio con Personal a Cargo"><button type="submit" class="btn btn-default btn-sm" name="I"><img class="img-reponsive img-rounded" src="../../icons/actions/view-list-text.png" /> Evaluaciones Nivel 3</button></a><hr>
      
      <a href="#" data-toggle="tooltip" data-placement="right" title="Evaluaciones Nivel Medio sin Personal a Cargo"><button type="submit" class="btn btn-default btn-sm" name="J"><img class="img-reponsive img-rounded" src="../../icons/actions/view-list-text.png" /> Evaluaciones Nivel 4</button></a><hr>
      
      <a href="#" data-toggle="tooltip" data-placement="right" title="Evaluaciones Nivel Operativo con Personal a Cargo"><button type="submit" class="btn btn-default btn-sm" name="K"><img class="img-reponsive img-rounded" src="../../icons/actions/view-list-text.png" /> Evaluaciones Nivel 5</button></a><hr>
      
      <a href="#" data-toggle="tooltip" data-placement="right" title="Operativo sin personal a cargo"><button type="submit" class="btn btn-default btn-sm" name="F"><img class="img-reponsive img-rounded" src="../../icons/actions/view-list-text.png" /> Evaluaciones Nivel 6</button></a>
      
      </div>
    </div>
  </div>
</div>'; 
	
	}else{
	
	echo '
    <div class="panel-group" id="accordion">
    <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
        Datos Personales</a>
      </h4>
    </div>
    <div id="collapse4" class="panel-collapse collapse">
      <div class="panel-body">
      <a href="#" data-toggle="tooltip" data-placement="right" title="Editar datos Personales"><button type="submit" class="btn btn-default btn-sm" name="D"><img class="img-reponsive img-rounded" src="../../icons/actions/user-group-properties.png" /> Mis Datos</button></a>
      </div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
        Evaluaciones</a>
      </h4>
    </div>
    <div id="collapse5" class="panel-collapse collapse">
      <div class="panel-body">
      <a href="#" data-toggle="tooltip" data-placement="right" title="Historial de Evaluaciones"><button type="submit" class="btn btn-default btn-sm" name="E"><img class="img-reponsive img-rounded" src="../../icons/actions/view-pim-tasks.png" /> Evaluaciones</button></a>     
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
        Collapsible Group 3</a>
      </h4>
    </div>
    <div id="collapse6" class="panel-collapse collapse">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
</div>'; 
	      
	}
	?>
	</form>
	
      </div>
    <div class="col-sm-10 text-left"> 
      <h1>Bienvenido/a <?php echo $nombre ?></h1>
      <a href="main.php" data-toggle="tooltip" data-placement="right" title="Sistema de Evaluación de Desempeño"><button type="button" class="btn btn-default"><img class="img-reponsive img-rounded" src="../../icons/actions/go-home.png" /> Home</button></a><hr>
      <p>En SisEval se podrá consultar las Evaluaciones de Desempeño históricas que ha obtenido a lo largo de su carrera Administrativa.-</p>
      <hr>
      
      <?php
   
      if(isset($_POST['A'])){
	      newAgente();
      }
      if(isset($_POST['B'])){
	      empleados($conn);
      }
      if(isset($_POST['C'])){
	      usuarios($conn);
      }
      if(isset($_POST['D'])){
	      loadUser($conn,$nombre);
      }
      if(isset($_POST['E'])){
	      get_file();
	          
      }
      if(isset($_POST['F'])){
	      eval6($conn);
	          
      }
      if(isset($_POST['G'])){
	      eval1($conn);
	          
      }  
      if(isset($_POST['H'])){
	      eval2($conn);
	          
      }
      if(isset($_POST['I'])){
	      eval3($conn);
	          
      }
      if(isset($_POST['J'])){
	      eval4($conn);
	          
      }
      if(isset($_POST['K'])){
	      eval5($conn);
	          
      }
   ?>
      
    </div>
 
  </div>
</div>

<footer class="container-fluid text-center">
  <p><img class="img-reponsive img-rounded" src="../../img/escudo32x32.png" /> Ministerio de Economía de la Nación - Dirección de Presupuesto y Evaluación de Gastos en Personal</p>
</footer>

<!-- Modal -->
		<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
					</div>

					<div class="modal-body">
						¿Desea eliminar este registro?
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</button>
						<a class="btn btn-danger btn-ok"><span class="glyphicon glyphicon-trash"></span> Borrar</a>
					</div>
				</div>
			</div>
		</div>

		<script>
			$('#confirm-delete').on('show.bs.modal', function(e) {
				$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

				$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
			});
		</script>
		
		<!-- END Modal -->

</body>
</html>
