<?php


/*
** Funcion que carga el skeleto del sistema
*/

function skeleton(){

  echo '<link rel="stylesheet" href="/siseval/skeleton/css/bootstrap.min.css" >
	<link rel="stylesheet" href="/siseval/skeleton/css/bootstrap-theme.css" >
	<link rel="stylesheet" href="/siseval/skeleton/css/bootstrap-theme.min.css" >
	<link rel="stylesheet" href="/siseval/skeleton/css/scrolling-nav.css" >
	<link rel="stylesheet" href="/siseval/skeleton/css/fontawesome.css">
	<link rel="stylesheet" href="/siseval/skeleton/css/fontawesome.min.css" >
	<link rel="stylesheet" href="/siseval/skeleton/css/jquery.dataTables.min.css" >
	<link rel="stylesheet" href="/siseval/skeleton/Chart.js/Chart.min.css" >
	<link rel="stylesheet" href="/siseval/skeleton/Chart.js/Chart.css" >
	
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="/siseval/skeleton/js/jquery-3.4.1.min.js"></script>
	<script src="/siseval/skeleton/js/bootstrap.min.js"></script>
	
	<script src="/siseval/skeleton/js/jquery.dataTables.min.js"></script>
	<script src="/siseval/skeleton/js/dataTables.editor.min.js"></script>
	<script src="/siseval/skeleton/js/dataTables.select.min.js"></script>
	<script src="/siseval/skeleton/js/dataTables.buttons.min.js"></script>
	
	<script src="/siseval/js/scrolling-nav.js"></script>
	<script src="/siseval/skeleton/Chart.js/Chart.min.js"></script>
	<script src="/siseval/skeleton/Chart.js/Chart.bundle.min.js"></script>
	<script src="/siseval/skeleton/Chart.js/Chart.bundle.js"></script>
	<script src="/siseval/skeleton/Chart.js/Chart.js"></script>';
}


/*
* Funcion para cambiar los permisos de los usuarios al sistema
*/

function cambiarPermisos($id,$role,$conn){

  $sql = "UPDATE usuarios set role = '$role' where id = '$id'";
  mysqli_select_db('siseval');
  $retval = mysqli_query($conn,$sql);
  if($retval){
    
			echo "<br>";
			echo '<div class="section"><br>
			      <div class="container">
			      <div class="row">
			      <div class="col-md-12">';
			echo '<div class="alert alert-success" role="alert">';
			echo 'Rol Actualizado Satisfactoriamente';
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo '<meta http-equiv="refresh" content="4;URL=../main/main.php "/>';
  
	  }else{
			echo "<br>";
			echo '<div class="section"><br>
			      <div class="container">
			      <div class="row">
			      <div class="col-md-12">';
			echo '<div class="alert alert-warning" role="alert">';
			echo "El usuario no existe. Intente Nuevamente!";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo '<meta http-equiv="refresh" content="4;URL=../main/main.php "/>';
		}
 
}


/*
* Funcion para agregar usuarios al sistema
*/

function agregarUser($nombre,$user,$email,$pass1,$pass2,$role,$conn){

	mysqli_select_db('siseval');	

	$sqlInsert = "INSERT INTO usuarios ".
		"(nombre,user,email,password,role)".
		"VALUES ".
      "('$nombre','$user','$email','$pass1','$role')";
		
	
	
	    if(strlen($pass1) <= 15){

	      if(strcmp($pass2, $pass1) == 0){
		    mysqli_query($conn,$sqlInsert);	
		    echo "<br>";
		    echo '<div class="container">';
		    echo '<div class="alert alert-success" role="alert">';
		    echo 'Usuario Creado Satisfactoriamente. Aguarde un Instante que será Redireccionado';
		    echo "</div>";
		    echo "</div>";	
		    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo "Las Contraseñas no Coinciden. Intente Nuevamente!. Aguarde un Instante que será Redireccionado";
			    echo "</div>";
			    echo "</div>";
		    }
		    }else{
			    echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo "La supera los 15 caracteres!. Aguarde un Instante que será Redireccionado";
			    echo "</div>";
			    echo "</div>";
		    }
		    
		    
}

/*
** Funcion que elimina un registro
*/

function delUser($id,$conn){

		
	mysqli_select_db('siseval');
	$sql = "delete from usuarios where id = '$id'";
           
	$res = mysqli_query($conn,$sql);


	if($res){
		//mysqli_query($conn,$sqlInsert);
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-success" role="alert">';
		echo 'Registro Eliminado Exitosamente. Aguarde un Instante que será Redireccionado';
		echo "</div>";
		echo "</div>";	
	}else{
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo "Hubo un error al Eliminar el Registro!. Aguarde un Instante que será Redireccionado" .mysqli_error($conn);
		echo "</div>";
		echo "</div>";
	}
}



function usuarios($conn){

if($conn)
{
	$sql = "SELECT * FROM usuarios";
    	mysqli_select_db('siseval');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/user-group-properties.png"  class="img-reponsive img-rounded"> Usuarios';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Nombre</th>
                    <th class='text-nowrap text-center'>Usuario</th>
                    <th class='text-nowrap text-center'>Role</th>
                    <th>&nbsp;</th>
                    </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['nombre']."</td>";
			 echo "<td align=center>".$fila['user']."</td>";
			 echo "<td align=center>".$fila['role']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<a href="../usuarios/edit.php?id='.$fila['id'].'" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span> Editar</a>';
			 echo '<a href="#" data-href="../usuarios/eliminar.php?id='.$fila['id'].'" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Borrar</a>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<a href="../usuarios/nuevoRegistro.php"><button type="button" class="btn btn-default"><span class="pull-center "><img src="../../icons/actions/list-add.png"  class="img-reponsive img-rounded"> Agregar Usuario</button></a><br><hr>';
		echo '<button type="button" class="btn btn-primary">Cantidad de Registros:  ' .$count; echo '</button>';
		echo '</div>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}



function loadUser($conn,$nombre){

if($conn){
	
	$sql = "SELECT * FROM usuarios where nombre = '$nombre'";
    	mysqli_select_db('siseval');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="alert alert-success">
	      <img src="../../icons/actions/user-group-properties.png"  class="img-reponsive img-rounded"> Mis Datos
	      </div><br>';
	
            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Nombre</th>
                    <th class='text-nowrap text-center'>Usuario</th>
                    <th>&nbsp;</th>
                    </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['nombre']."</td>";
			 echo "<td align=center>".$fila['user']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<a href="../usuarios/editar.php?id='.$fila['id'].'" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span> Cambiar Password</a>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}


/*
** Funcion alta de norma
*/
function newAgente(){

      echo '<div class="container">
	    <div class="row">
	    <div class="col-sm-8">
	      <h2><img src="../../icons/actions/user-group-new.png"  class="img-reponsive img-rounded"> Cargar Agente</h2><hr>
	        <form action="../agentes/formNuevoRegistro.php" method="POST">
	        
	        <div class="form-group">
		  <label for="nombre">Nombre y Apellido</label>
		  <input type="text" class="form-control" id="nombre" name="nombre" onKeyDown="limitText(this,60);" placeholder="Ingrese Nombre y Apellido sin separar por comas" required>
		</div>
		
		<div class="form-group">
		  <label for="cuil">CUIL</label>
		  <input type="text" class="form-control" id="cuil" name="cuil" onKeyDown="limitText(this,11);" placeholder="Ingrese CUIL sin separar por puntos ni guiones" required>
		</div>
		
		<div class="form-group">
		  <label for="f_nac">Fecha de Nacimiento</label>
		  <input type="date" class="form-control" id="f_nac" name="f_nac" required>
		</div>
		
		<div class="form-group">
		  <label for="nivel_grado">Nivel y Grado</label>
		  <input type="text" class="form-control" id="nivel_grado" name="nivel_grado" onKeyDown="limitText(this,3);" placeholder="Ingrese Nivel y Grado ejemplo: A-10" required>
		</div>
		
		<div class="form-group">
		  <label for="sel1">Situación de Revista</label>
		  <select class="form-control" name="revista" required>
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="Planta Permanente">Planta Permanente</option>
		    <option value="Ley Marco">Ley Marco</option>
		    <option value="Contrato">Contrato</option>
		  </select>
		</div> 
		
		<div class="form-group">
		  <label for="sel1">Sexo:</label>
		  <select class="form-control" name="sexo" required>
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="Masculino">Masculino</option>
		    <option value="Femenino">Femenino</option>
		  </select>
		  </div>
		
		<div class="form-group">
		  <label for="sel1">Nivel:</label>
		  <select class="form-control" name="nivel" required>
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="1">1 - Gerencial</option>
		    <option value="2">2 - Medio Profesional/Técnico con personal a cargo</option>
		    <option value="3">3 - Medio con personal a cargo</option>
		    <option value="4">4 - Medio sin personal a cargo</option>
		    <option value="5">5 - Operativo con personal a cargo</option>
		    <option value="6">6 - Operativo sin personal a cargo</option>
		  </select>
		  </div>
		  
		  <div class="form-group">
		  <label for="sel1">Estudios:</label>
		  <select class="form-control" name="estudios" required>
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="Sin Estudios">Sin Estudios</option>
		    <option value="Primario">Primario</option>
		    <option value="Secundario">Secundario</option>
		    <option value="Terciario">Terciario</option>
		    <option value="Universitario">Universitario</option>
		    <option value="Postgrado">Postgrado</option>
		  </select>
		  </div>
		  
		<div class="form-group">
		  <label for="sel1">Funciones Ejecutivas:</label>
		  <select class="form-control" name="func_ejec" required>
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="Si">Si</option>
		    <option value="No">No</option>
		  </select>
		  </div>
		  
		<div class="form-group">
		  <label for="sel1">Nivel Función Ejecutiva:</label>
		  <select class="form-control" name="niv_func_ejec" required>
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="0">0</option>
		    <option value="1">1</option>
		    <option value="2">2</option>
		    <option value="3">3</option>
		    <option value="4">4</option>
		    <option value="5">5</option>
		  </select>
		</div>
		
		<div class="form-group">
		  <label for="sel1">Sanciones:</label>
		  <select class="form-control" name="sanciones" required>
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="Si">Si</option>
		    <option value="No">No</option>
		  </select>
		  </div>
		
		<button type="submit" class="btn btn-success btn-block" name="A"><img src="../../icons/devices/media-floppy.png"  class="img-reponsive img-rounded"> Guardar</button>
	      </form> <br>
	      
	    </div>
	    </div>
	</div>';

}



/*
** Funcion alta de norma
*/
function editAgente($id,$conn){

      $sql = "select * from empleados where id = '$id'";
      mysqli_select_db('siseval');
      $res = mysqli_query($conn,$sql);
      $fila = mysqli_fetch_assoc($res);

      echo '<div class="container">
	    <div class="row">
	    <div class="col-sm-8">
	      <h2>Editar Agente</h2><hr>
	        <form action="../agentes/formUpdate.php" method="POST">
	        <input type="hidden" id="id" name="id" value="'.$fila['id'].'" />
	        
	        <div class="form-group">
		  <label for="nombre">Nombre y Apellido</label>
		  <input type="text" class="form-control" id="nombre" name="nombre" onKeyDown="limitText(this,60);" value="'.$fila['nombre'].'" required>
		</div>
		
		<div class="form-group">
		  <label for="cuil">CUIL</label>
		  <input type="text" class="form-control" id="cuil" name="cuil" onKeyDown="limitText(this,11);" value="'.$fila['cuil'].'" required>
		</div>
		
		<div class="form-group">
		  <label for="f_nac">Fecha de Nacimiento</label>
		  <input type="date" class="form-control" id="f_nac" name="f_nac" value="'.$fila['f_nac'].'" required>
		</div>
		
		<div class="form-group">
		  <label for="nivel_grado">Nivel y Grado</label>
		  <input type="text" class="form-control" id="nivel_grado" name="nivel_grado" onKeyDown="limitText(this,3);" value="'.$fila['nivel_grado'].'" required>
		</div>
		
		<div class="form-group">
		  <label for="sel1">Situación de Revista</label>
		  <select class="form-control" name="revista">
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="Planta Permanente" '.($fila['revista'] == "Planta Permanente" ? "selected" : ""). '>Planta Permanente</option>
		    <option value="Ley Marco" '.($fila['revista'] == "Ley Marco" ? "selected" : ""). '>Ley Marco</option>
		    <option value="Contrato" '.($fila['revista'] == "Contrato" ? "selected" : ""). '>Contrato</option>
		  </select>
		</div> 
		
		<div class="form-group">
		  <label for="sel1">Sexo:</label>
		  <select class="form-control" name="sexo">
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="Masculino" '.($fila['sexo'] == "Masculino" ? "selected" : ""). '>Masculino</option>
		    <option value="Femenino" '.($fila['sexo'] == "Femenino" ? "selected" : ""). '>Femenino</option>
		  </select>
		  </div>
		
		<div class="form-group">
		  <label for="sel1">Nivel:</label>
		  <select class="form-control" name="nivel">
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="1" '.($fila['nivel'] == "1" ? "selected" : ""). '>1 - Gerencial</option>
		    <option value="2" '.($fila['nivel'] == "2" ? "selected" : ""). '>2 - Medio Profesional/Técnico con personal a cargo</option>
		    <option value="3" '.($fila['nivel'] == "3" ? "selected" : ""). '>3 - Medio con personal a cargo</option>
		    <option value="4" '.($fila['nivel'] == "4" ? "selected" : ""). '>4 - Medio sin personal a cargo</option>
		    <option value="5" '.($fila['nivel'] == "5" ? "selected" : ""). '>5 - Operativo con personal a cargo</option>
		    <option value="6" '.($fila['nivel'] == "6" ? "selected" : ""). '>6 - Operativo sin personal a cargo</option>
		  </select>
		  </div>
		  
		  <div class="form-group">
		  <label for="sel1">Estudios:</label>
		  <select class="form-control" name="estudios">
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="Sin Estudios" '.($fila['estudios'] == "Sin Estudios" ? "selected" : ""). '>Sin Estudios</option>
		    <option value="Primario" '.($fila['estudios'] == "Primario" ? "selected" : ""). '>Primario</option>
		    <option value="Secundario" '.($fila['estudios'] == "Secundario" ? "selected" : ""). '>Secundario</option>
		    <option value="Terciario" '.($fila['estudios'] == "Terciario" ? "selected" : ""). '>Terciario</option>
		    <option value="Universitario" '.($fila['estudios'] == "Universitario" ? "selected" : ""). '>Universitario</option>
		    <option value="Postgrado" '.($fila['estudios'] == "Postgrado" ? "selected" : ""). '>Postgrado</option>
		  </select>
		  </div>
		  
		<div class="form-group">
		  <label for="sel1">Funciones Ejecutivas:</label>
		  <select class="form-control" name="func_ejec">
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="Si" '.($fila['funcion_ejec'] == "Si" ? "selected" : ""). '>Si</option>
		    <option value="No" '.($fila['funcion_ejec'] == "No" ? "selected" : ""). '>No</option>
		  </select>
		  </div>
		  
		<div class="form-group">
		  <label for="sel1">Nivel Función Ejecutiva:</label>
		  <select class="form-control" name="niv_func_ejec">
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="0" '.($fila['niv_func_ejec'] == "0" ? "selected" : ""). '>0</option>
		    <option value="1" '.($fila['niv_func_ejec'] == "1" ? "selected" : ""). '>1</option>
		    <option value="2" '.($fila['niv_func_ejec'] == "2" ? "selected" : ""). '>2</option>
		    <option value="3" '.($fila['niv_func_ejec'] == "3" ? "selected" : ""). '>3</option>
		    <option value="4" '.($fila['niv_func_ejec'] == "4" ? "selected" : ""). '>4</option>
		    <option value="5" '.($fila['niv_func_ejec'] == "5" ? "selected" : ""). '>5</option>
		  </select>
		</div>
		
		<div class="form-group">
		  <label for="sel1">Sanciones:</label>
		  <select class="form-control" name="sanciones">
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="Si" '.($fila['sanciones'] == "Si" ? "selected" : ""). '>Si</option>
		    <option value="No" '.($fila['sanciones'] == "No" ? "selected" : ""). '>No</option>
		  </select>
		  </div>
		
		<button type="submit" class="btn btn-success btn-block" name="A"><img src="../../icons/devices/media-floppy.png"  class="img-reponsive img-rounded"> Guardar</button>
	      </form> <a href="../main/main.php"><button type="submit" class="btn btn-primary btn-block" ><img src="../../icons/actions/arrow-left.png"  class="img-reponsive img-rounded"> Volver</button></a>
	      <br>
	    </div>
	    </div>
	</div>';

}




function updateAgente($id,$nombre,$cuil,$f_nac,$nivel_grado,$revista,$sexo,$nivel,$estudios,$func_ejec,$niv_func_ejec,$sanciones,$conn){

		
	mysqli_select_db('siseval');
	$sqlInsert = "update empleados set nombre = '$nombre', cuil = '$cuil', f_nac = '$f_nac', nivel_grado = '$nivel_grado', revista = '$revista', sexo = '$sexo', nivel = '$nivel', estudios = '$estudios',sanciones = '$sanciones', funcion_ejec = '$func_ejec', niv_func_ejec = '$niv_func_ejec' where id = '$id'";
           
	$res = mysqli_query($conn,$sqlInsert);


	if($res){
		//mysqli_query($conn,$sqlInsert);
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-success" role="alert">';
		echo 'Registro Actualizado Exitosamente. Aguarde un Instante que será Redireccionado';
		echo "</div>";
		echo "</div>";	
	}else{
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo "Hubo un error al Actualizar el Registro!. Aguarde un Instante que será Redireccionado" .mysqli_error($conn);
		echo "</div>";
		echo "</div>";
	}
}



function empleados($conn){

if($conn){
	
	$sql = "SELECT * FROM empleados";
    	mysqli_select_db('siseval');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="alert alert-success">
	      <img src="../../icons/apps/preferences-contact-list.png"  class="img-reponsive img-rounded"> Agentes
	      </div><br>';
	
            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Nombre y Apellido</th>
                    <th class='text-nowrap text-center'>CUIL</th>
                    <th class='text-nowrap text-center'>Fecha Nac.</th>
                    <th class='text-nowrap text-center'>Nivel y Grado</th>
                    <th class='text-nowrap text-center'>Situación Revista</th>
                    <th class='text-nowrap text-center'>Sexo</th>
                    <th class='text-nowrap text-center'>Nivel</th>
                    <th class='text-nowrap text-center'>Estudios</th>
                    <th class='text-nowrap text-center'>Función Ejecutiva</th>
                    <th class='text-nowrap text-center'>Nivel Función Ejec.</th>
                    <th class='text-nowrap text-center'>Sanciones</th>
                    <th>&nbsp;</th>
                    </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['nombre']."</td>";
			 echo "<td align=center>".$fila['cuil']."</td>";
			 echo "<td align=center>".$fila['f_nac']."</td>";
			 echo "<td align=center>".$fila['nivel_grado']."</td>";
			 echo "<td align=center>".$fila['revista']."</td>";
			 echo "<td align=center>".$fila['sexo']."</td>";
			 echo "<td align=center>".$fila['nivel']."</td>";
			 echo "<td align=center>".$fila['estudios']."</td>";
			 echo "<td align=center>".$fila['funcion_ejec']."</td>";
			 echo "<td align=center>".$fila['niv_func_ejec']."</td>";
			 echo "<td align=center>".$fila['sanciones']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<a href="../agentes/editar.php?id='.$fila['id'].'" class="btn btn-primary btn-sm " ><span class="glyphicon glyphicon-pencil"></span> Editar</a>';
			 echo '<a href="#" data-href="../agentes/eliminar.php?id='.$fila['id'].'" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Borrar</a>';
			 echo '<a href="../evaluaciones/evaluar.php?id='.$fila['id'].'" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span> Evaluar</a>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<button type="button" class="btn btn-primary">Cantidad de Registros:  ' .$count; echo '</button>';
		echo '<hr>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}

function editPassUser($id,$conn){

      $sql = "select * from usuarios where id = '$id'";
      mysqli_select_db('siseval');
      $res = mysqli_query($conn,$sql);
      $fila = mysqli_fetch_assoc($res);
      

      echo '<div class="container">
	    <div class="row">
	    <div class="col-sm-8">
	      <h2>Cambiar Password</h2><hr>
	      
	      <form action="formUpdate.php" method="post">
	      <input type="hidden" id="id" name="id" value="' . $fila['id'].'" />
   
         
	  <div class="input-group">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	    <input id="text" type="text" class="form-control" value="' . $fila['nombre'].'" name="nombre" value="" onkeyup="this.value=Text(this.value);" readonly required>
	  </div>
	
	  <div class="input-group">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	    <input id="text" type="text" class="form-control" name="user" onKeyDown="limitText(this,20);" onKeyUp="limitText(this,20);" value="' . $fila['user'].'" readonly required>
	  </div>
	  <div class="input-group">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	    <input id="password" type="password" class="form-control" name="pass1" onKeyDown="limitText(this,15);" onKeyUp="limitText(this,15);" placeholder="Password" >
	  </div>
	  <div class="input-group">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	    <input  type="password" class="form-control" name="pass2" onKeyDown="limitText(this,15);" onKeyUp="limitText(this,15);" placeholder="Repita Password" >
	  </div>
	  <br>
	
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-12" align="left">
	  <button type="submit" class="btn btn-success" name="A"><span class="glyphicon glyphicon-pencil"></span>  Cambiar Password</button>
	  <a href="../main/main.php"><input type="button" value="Volver al Menú Principal" class="btn btn-primary"></a>
	  </div>
	  </div>
	</form> 
	      
	      </div>
	      </div>
	      </div>';

}


/*
* Funcion para editar la contraseña de los usuarios al sistema
*/

function updatePass($id,$pass1,$pass2,$conn){

	$sql = "UPDATE usuarios set password = '$pass1' WHERE id = '$id'";
    	mysqli_select_db('siseval');
    	
    	
    	if(strcmp($pass2, $pass1) == 0){
    		
		      mysqli_query($conn,$sql);
			echo "<br>";
			echo '<div class="section"><br>
			      <div class="container">
			      <div class="row">
			      <div class="col-md-12">';
			echo '<div class="alert alert-success" role="alert">';
			echo 'Password Actualizado Satisfactoriamente<br>';
			echo 'Aguarde un Instante que será redirigido';
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo '<meta http-equiv="refresh" content="4;URL=../main/main.php "/>';
			
	   	}else{
			echo "<br>";
			echo '<div class="section"><br>
			      <div class="container">
			      <div class="row">
			      <div class="col-md-12">';
			echo '<div class="alert alert-danger" role="alert">';
			echo "Las Contraseñas no Coinciden. Intente Nuevamente!<br>";
			echo 'Aguarde un instante que será redirigido';
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo '<meta http-equiv="refresh" content="4;URL=../main/main.php "/>';

    	}
   
}


function delAgente($id,$conn){

		
	mysqli_select_db('siseval');
	$sql = "delete from empleados where id = '$id'";
           
	$res = mysqli_query($conn,$sql);


	if($res){
		//mysqli_query($conn,$sqlInsert);
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-success" role="alert">';
		echo 'Registro Eliminado Exitosamente. Aguarde un Instante que será Redireccionado';
		echo "</div>";
		echo "</div>";	
	}else{
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo "Hubo un error al Eliminar el Registro!. Aguarde un Instante que será Redireccionado" .mysqli_error($conn);
		echo "</div>";
		echo "</div>";
	}
}

function addAgente($nombre,$cuil,$f_nac,$nivel_grado,$revista,$sexo,$nivel,$estudios,$func_ejec,$niv_func_ejec,$sanciones,$conn){

		
	mysqli_select_db('siseval');
	$sqlInsert = "INSERT INTO empleados ".
		"(nombre,cuil,f_nac,nivel_grado,revista,sexo,nivel,estudios,sanciones,funcion_ejec,niv_func_ejec)".
		"VALUES ".
      "('$nombre','$cuil','$f_nac','$nivel_grado','$revista','$sexo','$nivel','$estudios','$sanciones','$func_ejec','$niv_func_ejec')";
           
	$res = mysqli_query($conn,$sqlInsert);


	if($res){
		//mysqli_query($conn,$sqlInsert);
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-success" role="alert">';
		echo 'Registro Guardado Exitosamente. Aguarde un Instante que será Redireccionado';
		echo "</div>";
		echo "</div>";	
	}else{
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo "Hubo un error al guardar el Registro!. Aguarde un Instante que será Redireccionado" .mysqli_error($conn);
		echo "</div>";
		echo "</div>";
	}
}

/*
** Funcion para subir pdf
*/

function uploadPDF($id,$conn){

  // File upload path
$targetDir = '../../uploads/';
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;

$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('pdf');
    
    if(in_array($fileType, $allowTypes)){
    
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
           
            
            // Insert image file name into database
           
           $sql = "update normas set file_path = '$targetFilePath', file_name = '$fileName' where id = '$id'";
           mysqli_select_db('siseval');
	    $insert = mysqli_query($conn,$sql);
         
            if($insert){
            
			  echo '<div class="alert alert-success" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img src="../../img/success-img.png" alt="Avatar" class="avatar" ><strong> Base de Datos Actualizada. El Archivo '.$fileName. ' se ha subido correctamente..</strong>';
                          echo "</div><hr>";
                          echo '<div class="alert alert-success" role="alert">';
                          echo "<a href='../main/main.php'><button class='btn btn-warning navbar-btn'><span class='glyphicon glyphicon-chevron-left'></span> Volver</button></a>";
                          echo "</div><hr>";
                
            }else{
		  
			  echo '<div class="alert alert-success" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img src="../../img/success-img.png" alt="Avatar" class="avatar" ><strong>El Archivo '.$fileName. ' se ha subido correctamente.</strong>';
                          echo "</div><hr>";
                          echo '<div class="alert alert-success" role="alert">';
                          echo "<a href='../main/main.php'><button class='btn btn-warning navbar-btn'><span class='glyphicon glyphicon-chevron-left'></span> Volver</button></a>";
                          echo "</div><hr>";
                
            } 
        }else{
			  echo '<div class="alert alert-warning" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img src="../../img/think-img.png" alt="Avatar" class="avatar" ><strong> Ups. Hubo un error subiendo el Archivo.</strong>';
                          echo "</div><hr>";
                          echo '<div class="alert alert-success" role="alert">';
                          echo "<a href='../main/main.php'><button class='btn btn-warning navbar-btn'><span class='glyphicon glyphicon-chevron-left'></span> Volver</button></a>";
                          echo "</div><hr>";
        }
    }else{
    
			  echo '<div class="alert alert-danger" role="alert">';
			  echo '<h1 class="panel-title text-left" contenteditable="true"><img src="../../img/aircraft-crash64-img.png" alt="Avatar" class="avatar" ><strong> Ups, solo archivos con extensión: PDF son soportados.</strong>';
			  echo "</div><hr>";
                          echo '<div class="alert alert-success" role="alert">';
                          echo "<a href='../main/main.php'><button class='btn btn-warning navbar-btn'><span class='glyphicon glyphicon-chevron-left'></span> Volver</button></a>";
                          echo "</div><hr>";
    }
}else{
			  echo '<div class="alert alert-info" role="alert">';
                          echo '<h1 class="panel-title text-left" contenteditable="true"><img src="../../img/refresh-img.png" alt="Avatar" class="avatar" ><strong> Por favor, seleccione al archivo a subir.</strong>';
                          echo "</div><hr>";
                          echo '<div class="alert alert-success" role="alert">';
                          echo "<a href='../main/main.php'><button class='btn btn-warning navbar-btn'><span class='glyphicon glyphicon-chevron-left'></span> Volver</button></a>";
                          echo "</div><hr>";
}

}

// ============================================================================================

/*
** Formulario Nivel 1 - Gerencial
*/
function formulario1($agente,$cuil,$nivel_grado,$estudios,$nivel,$revista){

        echo '<div class="container-fluid"
		<div class="row">
		  <div class="col-sm-6">
		    <div class="panel panel-primary">
		    <div class="panel-heading">Formulario Nivel 1 Gerencial - Datos del Agente:  '.$agente.'</div>
		    <div class="panel-body">
		    <p>Serán evaluados en este nivel los agentes que cumplan con funciones de Director Nacional, General, Subdirector 
			o equivalentes y personal con funciones ejecutivas hasta nivel IV</p><hr>
			<h3><strong>Identificación del Organismo en el que revista según estructura</strong></h3><hr>
		    
		    <form action="../evaluaciones/resultadoForm1.php" method="POST">
		    <input type="hidden" id="id" name="nivel" value="'.$nivel.'" />
		     <input type="hidden" id="id" name="revista" value="'.$revista.'" />
		   
		   <div class="form-group">
		      <label for="nombre">Juriscidicción/Org. Descentralizado</label>
		      <input type="text" class="form-control" id="nombre" name="juris" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Secretaría / Gerencia</label>
		      <input type="text" class="form-control" id="nombre" name="secretaria" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Subsecretaría</label>
		      <input type="text" class="form-control" id="nombre" name="subsecretaria" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Dirección Nacional / General</label>
		      <input type="text" class="form-control" id="nombre" name="direccion" onKeyDown="limitText(this,60);" required>
		    </div><hr>
			
		    <div class="form-group">
		      <label for="nombre">Unidad</label>
		      <input type="text" class="form-control" id="nombre" name="unidad" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <h3><strong>Para casos en que el Agente preste servicios en otra Unidad de Evaluación diferente a la de revista</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Unidad de Evaluación</label>
		      <input type="text" class="form-control" id="nombre" name="unidad2" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Código Unidad de Evaluación</label>
		      <input type="text" class="form-control" id="nombre" name="cod_uni" onKeyDown="limitText(this,6);" required>
		    </div><hr>
		    
		    <h3><strong>Identificación del Evaluador</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Apellido y Nombre</label>
		      <input type="text" class="form-control" id="nombre" name="nombre_evaluador" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">DNI</label>
		      <input type="text" class="form-control" id="nombre" name="dni_evaluador" onKeyDown="limitText(this,8);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">Situacion Escalafonaria:</label>
		      <select class="form-control" name="sit_esc_eval">
			<option value="" disabled selected>Seleccionar</option>
			<option value="Otra">Otra</option>
			<option value="SINEP">SINAPA/SINEP</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Nivel y Grado</label>
		      <input type="text" class="form-control" id="nombre" name="nivel_grado_eval" onKeyDown="limitText(this,3);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Agrupamiento</label>
		      <input type="text" class="form-control" id="nombre" name="agrupamiento_eval" onKeyDown="limitText(this,25);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Cargo que Ocupa</label>
		      <input type="text" class="form-control" id="nombre" name="cargo_eval" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <h3><strong>Identificación del Agente</strong></h3><hr>
		    
		     <div class="form-group">
		      <label for="nombre">Apellido y Nombre</label>
		      <input type="text" class="form-control" id="nombre" name="nombre_agente" onKeyDown="limitText(this,60);" value="'.$agente.'" required readonly>
		     </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">DNI / CUIL</label>
		      <input type="text" class="form-control" id="nombre" name="dni_agente" onKeyDown="limitText(this,11);" value="'.$cuil.'" required readonly>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Legajo</label>
		      <input type="text" class="form-control" id="nombre" name="legajo_agente" onKeyDown="limitText(this,15);" value="'.$cuil.'" required>
		     </div><hr>
		     
		     <div class="form-group">
		      <label for="nombre">Nivel y Grado</label>
		      <input type="text" class="form-control" id="nombre" name="ng_agente" onKeyDown="limitText(this,3);" value="'.$nivel_grado.'" required readonly>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Agrupamiento</label>
		      <input type="text" class="form-control" id="nombre" name="agrupamiento2" onKeyDown="limitText(this,25);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Nivel Educativo</label>
		      <input type="text" class="form-control" id="nombre" name="educacion" onKeyDown="limitText(this,13);" value="'.$estudios.'" required readonly>
		    </div><hr>
		    
		    <h3><strong>Período Evaluado</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="f_nac">Fecha Desde</label>
		      <input type="date" class="form-control" id="f_desde" name="f_desde" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="f_nac">Fecha Hasta</label>
		      <input type="date" class="form-control" id="f_hasta" name="f_hasta" required>
		    </div><hr>
		    
		    </div>
		    <div class="panel-footer"><p><strong>Importante: No olvide completar ninguno de los datos anteriores</strong></p></div>
		  </div>
		</div>
	      
		  <div class="col-sm-6">
		    <div class="panel panel-primary">
		    <div class="panel-heading">Formulario Nivel 1 - Fomulario de Evaluación</div>
		    <div class="panel-body">
		    
		    <p>Cada uno de los Items a evaluar cuenta con 5 factores, cada factor tiene un valor asociado. El valor más alto está representado
			por el primero de los factores y el más bajo por el quinto, dichos valores van del 4 al 0.
			La sumatoria de los valores obtenidos en cada item darán un total el cuál será asociado a una Calificación final.</p><hr>
		    
		    <div class="form-group">
		      <label for="sel1">1 - Planificación:</label>
		      <select class="form-control" name="item1" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Planificación Altamente Eficiente</option>
			<option value="3">2 - Muy Buenos Programas y cursos de Acción</option>
			<option value="2">3 - Planifica adecuadamente y Establece metas razonables</option>
			<option value="1">4 - Presenta dificultades a la hora de establecer planes</option>
			<option value="0">5 - Planifica poco o establece planes poco eficientes</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">2 - Gestión de Planes y Programas:</label>
		      <select class="form-control" name="item2" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Logra el total cumplimiento eficaz de los objetivos</option>
			<option value="3">2 - Logra buen cumplimiento de los objetivos y metas propuestos</option>
			<option value="2">3 - Logra que las metas propuestas dentro de su área se alcancen en los plazos previstos</option>
			<option value="1">4 - Tiene Dificultades para lograr que se cumplan las metas</option>
			<option value="0">5 - Difícilmente logra concretar las metas previstas</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">3 - Control de Resultados:</label>
		      <select class="form-control" name="item3" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Controla de manera excelente la gestión de su área</option>
			<option value="3">2 - Controla la gestión de su área de manera muy eficiente</option>
			<option value="2">3 - Realiza controles adecuados</option>
			<option value="1">4 - Sus controles son puntuales o excesivos</option>
			<option value="0">5 - Rara vez evalúa y/o controla las tareas durante su ejecución</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">4.1 - Organización del Trabajo:</label>
		      <select class="form-control" name="item41" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente capacidad organizativa</option>
			<option value="3">2 - Muy buena capacidad organizativa y de asignación de recursos</option>
			<option value="2">3 - Organiza adecuadamente los procesos de trabajo</option>
			<option value="1">4 - Escasa capacidad organizativa</option>
			<option value="0">5 - Tiene problemas para integrar los factores de la producción</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">4.2 - Resolver Problemas:</label>
		      <select class="form-control" name="item42" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente habilidad para descomponer y analizar situaciones problemáticas</option>
			<option value="3">2 - Muy buena capacidad para analizar y resolver problemas</option>
			<option value="2">3 - Analiza y resuelve los problemas de rutina y evita complicaciones innecesarias</option>
			<option value="1">4 - En ocasiones manifiesta dificultades para analizar los problemas</option>
			<option value="0">5 - Generalmente tiene dificultades para percibir los problemas</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">5 - Conducción:</label>
		      <select class="form-control" name="item5" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente habilidad para dirigir y coordinar grupos de trabajo</option>
			<option value="3">2 - Muy buen criterio para dirigir</option>
			<option value="2">3 - Es efectivo en la dirección y coordinación del personal</option>
			<option value="1">4 - Suele tener dificultades para dirigir a su personal</option>
			<option value="0">5 - Contínuamente presenta problemas para dirigir la acción del personal</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">6.1 - Asumir representación interna y externa:</label>
		      <select class="form-control" name="item61" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Gran capacidad para relacionarse con el contexto y representar a su área</option>
			<option value="3">2 - Muy buena capacidad para representar a su área</option>
			<option value="2">3 - Establece y mantiene relaciones convenientes para el accionar laboral de su área</option>
			<option value="1">4 - A veces no asume convenientemente la representación de su área</option>
			<option value="0">5 - Tiene dificultades para establecer relaciones cuando asume la representación de su área</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">6.2 - Cerrar Transacciones:</label>
		      <select class="form-control" name="item62" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Notable facilidad para conducir negociaciones</option>
			<option value="3">2 - Conduce habilidosamente y concreta los procesos de negociación con muy buenos resultados</option>
			<option value="2">3 - Conduce y cierra satisfactoriamente procesos de negociación habituales</option>
			<option value="1">4 - Puede iniciar y conducir transacciones pero tiene dificultad para cerrarlas</option>
			<option value="0">5 - Su actuación normalmente lleva a cierres confusos e inconvenientes que deben ser rectificados</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">7.1 - Interpretación y predicción del contexto:</label>
		      <select class="form-control" name="item71" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Optima lectura de la realidad</option>
			<option value="3">2 - Realiza lecturas muy acertadas de la realidad en términos de ventajas y desventajas</option>
			<option value="2">3 - Sus lecturas de la realidad son razonablemente correctas</option>
			<option value="1">4 - A menudo tiene dificultades para leer correctamente la realidad</option>
			<option value="0">5 - Lectura habitualemnte incorrecta de la realidad</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">7.2 - Maximizar Oportunidades:</label>
		      <select class="form-control" name="item72" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente habilidad para aprovechar oportunidades en la programacón de su área</option>
			<option value="3">2 - Aprovecha muy bien las oportunidades del contexto</option>
			<option value="2">3 - Normalmente aprovecha oportunidades en la formulación de los planes y programas de su área</option>
			<option value="1">4 - Escasamente aprovecha las oportunidades, se mantiene en la rutina</option>
			<option value="0">5 - Muy poco capaz de aprovechar oportunidades que resultarían claramente favorables para su área</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">8 - Iniciativa:</label>
		      <select class="form-control" name="item8" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Notablemente capaz para generar acciones oportunas</option>
			<option value="3">2 - Muy buena capacidad para actuar oportunamente</option>
			<option value="2">3 - Actúa oportunamente asumiento los riesgos necesarios</option>
			<option value="1">4 - Ocasionalmente tiene problemas para actuar y asumir riesgos</option>
			<option value="0">5 - Tiene dificultades para pasar a la acción y asumir los riesgos que ello implica</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">9 - Adaptabilidad:</label>
		      <select class="form-control" name="item9" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Demuestra absoluta apertura para asimilar los cambios y para generar rápidamente cursos de acción</option>
			<option value="3">2 - Comprende los cambios rápidamente y sin dificultades</option>
			<option value="2">3 - Es permeable a los cambios y reacciona razonablemente bien en la generación de cursos de acción adecuados</option>
			<option value="1">4 - Le cuesta aceptar los cambios. Tiene dificultades para generar cursos de acción adecuados</option>
			<option value="0">5 - Es muy poco permeable a los nuevas situaciones de trabajo.</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">10 - Autonomía:</label>
		      <select class="form-control" name="item10" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Casi siempre se maneja con gran independencia, tomando las decisiones con total responsabilidad</option>
			<option value="3">2 - Generalmente muestra independencia, tomando decisiones bajo su propia responsabilidad</option>
			<option value="2">3 - Toma decisiones adecuadas a su función en situaciones usuales</option>
			<option value="1">4 - Pocas veces exhibe una conducta autónoma, con frecuencia solicita apoyo</option>
			<option value="0">5 - Muy frecuentemente necesita consultar a sus superiores o a pares para tomar decisiones</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">11 - Identificación con la Organización:</label>
		      <select class="form-control" name="item11" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Su desempeño está permanentemente comprometido con los fines de la organización</option>
			<option value="3">2 - Muy buen nivel de compromiso con los fines de la organización</option>
			<option value="2">3 - Adecuado compromiso con los fines y metas de la organización</option>
			<option value="1">4 - Bajo compromiso con los fines y metas de la organización</option>
			<option value="0">5 - Se compromete muy poco con los objetivos organizacionales y parece que siempre prevalecen sus interese personales</option>
		      </select>
		    </div><hr>
		    
		    </div>
		    <div class="panel-footer"><button type="submit" class="btn btn-success btn-block" name="A"><img src="../../icons/actions/go-next.png"  class="img-reponsive img-rounded"> Continuar</button>
		      </form> <br></div>
		  </div>
		</div>
	     
	     
	      </div>';

}

/////////////////// SECCION FORMULARIO 2 ////////////////////

/*
** Formulario Nivel 2 - Medio Profesional
*/
function formulario2($agente,$cuil,$nivel_grado,$estudios,$nivel,$revista){

        echo '<div class="container-fluid"
		<div class="row">
		  <div class="col-sm-6">
		    <div class="panel panel-primary">
		    <div class="panel-heading">Formulario Nivel 2 Medio Profesional o Técnico con Personal a Cargo - Datos del Agente:  '.$agente.'</div>
		    <div class="panel-body">
		    <p>Serán evaluados en este nivel los agentes que desempeñan funciones ejecutivas de nivel V y aquellos que cumplan funciones de
			jefatura no incluídas en los niveles anteriores que requieran la posesión de título académico de nivel Terciario o Universitario</p><hr>
			
			<h3><strong>Identificación del Organismo en el que revista según estructura</strong></h3><hr>
		    
		    <form action="../evaluaciones/resultadoForm2.php" method="POST">
		    <input type="hidden" id="id" name="nivel" value="'.$nivel.'" />
		     <input type="hidden" id="id" name="revista" value="'.$revista.'" />
		   
		   <div class="form-group">
		      <label for="nombre">Juriscidicción/Org. Descentralizado</label>
		      <input type="text" class="form-control" id="nombre" name="juris" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Secretaría / Gerencia</label>
		      <input type="text" class="form-control" id="nombre" name="secretaria" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Subsecretaría</label>
		      <input type="text" class="form-control" id="nombre" name="subsecretaria" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Dirección Nacional / General</label>
		      <input type="text" class="form-control" id="nombre" name="direccion" onKeyDown="limitText(this,60);" required>
		    </div><hr>
			
		    <div class="form-group">
		      <label for="nombre">Unidad</label>
		      <input type="text" class="form-control" id="nombre" name="unidad" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <h3><strong>Para casos en que el Agente preste servicios en otra Unidad de Evaluación diferente a la de revista</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Unidad de Evaluación</label>
		      <input type="text" class="form-control" id="nombre" name="unidad2" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Código Unidad de Evaluación</label>
		      <input type="text" class="form-control" id="nombre" name="cod_uni" onKeyDown="limitText(this,6);" required>
		    </div><hr>
		    
		    <h3><strong>Identificación del Evaluador</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Apellido y Nombre</label>
		      <input type="text" class="form-control" id="nombre" name="nombre_evaluador" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">DNI</label>
		      <input type="text" class="form-control" id="nombre" name="dni_evaluador" onKeyDown="limitText(this,8);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">Situacion Escalafonaria:</label>
		      <select class="form-control" name="sit_esc_eval">
			<option value="" disabled selected>Seleccionar</option>
			<option value="Otra">Otra</option>
			<option value="SINEP">SINAPA/SINEP</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Nivel y Grado</label>
		      <input type="text" class="form-control" id="nombre" name="nivel_grado_eval" onKeyDown="limitText(this,3);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Agrupamiento</label>
		      <input type="text" class="form-control" id="nombre" name="agrupamiento_eval" onKeyDown="limitText(this,25);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Cargo que Ocupa</label>
		      <input type="text" class="form-control" id="nombre" name="cargo_eval" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <h3><strong>Identificación del Agente</strong></h3><hr>
		    
		     <div class="form-group">
		      <label for="nombre">Apellido y Nombre</label>
		      <input type="text" class="form-control" id="nombre" name="nombre_agente" onKeyDown="limitText(this,60);" value="'.$agente.'" required readonly>
		     </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">DNI / CUIL</label>
		      <input type="text" class="form-control" id="nombre" name="dni_agente" onKeyDown="limitText(this,11);" value="'.$cuil.'" required readonly>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Legajo</label>
		      <input type="text" class="form-control" id="nombre" name="legajo_agente" onKeyDown="limitText(this,15);" required>
		     </div><hr>
		     
		     <div class="form-group">
		      <label for="nombre">Nivel y Grado</label>
		      <input type="text" class="form-control" id="nombre" name="ng_agente" onKeyDown="limitText(this,3);" value="'.$nivel_grado.'" required readonly>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Agrupamiento</label>
		      <input type="text" class="form-control" id="nombre" name="agrupamiento2" onKeyDown="limitText(this,25);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Nivel Educativo</label>
		      <input type="text" class="form-control" id="nombre" name="educacion" onKeyDown="limitText(this,13);" value="'.$estudios.'" required readonly>
		    </div><hr>
		    
		    <h3><strong>Período Evaluado</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="f_nac">Fecha Desde</label>
		      <input type="date" class="form-control" id="f_desde" name="f_desde" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="f_nac">Fecha Hasta</label>
		      <input type="date" class="form-control" id="f_hasta" name="f_hasta" required>
		    </div><hr>
		    
		    </div>
		    <div class="panel-footer"><p><strong>Importante: No olvide completar ninguno de los datos anteriores</strong></p></div>
		  </div>
		</div>
	      
		  <div class="col-sm-6">
		    <div class="panel panel-primary">
		    <div class="panel-heading">Formulario Nivel 2 - Fomulario de Evaluación</div>
		    <div class="panel-body">
		    
		    <p>Cada uno de los Items a evaluar cuenta con 5 factores, cada factor tiene un valor asociado. El valor más alto está representado
			por el primero de los factores y el más bajo por el quinto, dichos valores van del 4 al 0.
			La sumatoria de los valores obtenidos en cada item darán un total el cuál será asociado a una Calificación final.</p><hr>
		    
		    <div class="form-group">
		      <label for="sel1">1 - Planificación:</label>
		      <select class="form-control" name="item1" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Planificación Altamente Eficiente</option>
			<option value="3">2 - Muy Buenos Programas y cursos de Acción</option>
			<option value="2">3 - Planifica adecuadamente y Establece metas razonables</option>
			<option value="1">4 - Presenta dificultades a la hora de establecer planes</option>
			<option value="0">5 - Planifica poco o establece planes poco eficientes</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">2 - Gestión de Control de Programas y Planes:</label>
		      <select class="form-control" name="item2" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente capacidad para cumplir eficazmente los objetivos</option>
			<option value="3">2 - Logra buen cumplimiento de los objetivos y metas propuestos</option>
			<option value="2">3 - Logra cumplir las metas propuestas para su sector  controla adecuadamente los resultados</option>
			<option value="1">4 - Tiene Dificultades para lograr que se cumplan las metas previstas</option>
			<option value="0">5 - Difícilmente logra concretar las metas previstas</option>
		      </select>
		    </div><hr>
		    
		     <div class="form-group">
		      <label for="sel1">3 - Organización del Trabajo:</label>
		      <select class="form-control" name="item3" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente capacidad organizativa</option>
			<option value="3">2 - Muy buena capacidad organizativa y de asignación de recursos</option>
			<option value="2">3 - Organiza adecuadamente los procesos de trabajo</option>
			<option value="1">4 - Escasa capacidad organizativa</option>
			<option value="0">5 - Tiene problemas para integrar los factores de la producción</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">4 - Conducción:</label>
		      <select class="form-control" name="item4" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente habilidad para dirigir y coordinar grupos de trabajo</option>
			<option value="3">2 - Muy buen criterio para dirigir y coordinar</option>
			<option value="2">3 - Es efectivo en la dirección y coordinación del personal</option>
			<option value="1">4 - A veces presenta dificultades para dirigir y coordinar a su personal</option>
			<option value="0">5 - Contínuamente presenta problemas para dirigir y coordinar al personal</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">5 - Competencias Profesionales para la Función:</label>
		      <select class="form-control" name="item5" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente nivel de formación y actualización que aplca eficientemente en todas las fases del trabajo</option>
			<option value="3">2 - Muy buen nivel de formación y actualización, realiza su trabajo con solvencia profesional</option>
			<option value="2">3 - Sabe y aplica adecuadamente los conocimientos teórico-prácticos.</option>
			<option value="1">4 - Tiene conocimientos limitados y/o los aplica con dificultad</option>
			<option value="0">5 - Su nivel de conocimientos o su dominio para aplicarlos no le permite desenvolverse en su trabajo adecuadamente</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">6 - Creatividad:</label>
		      <select class="form-control" name="item6" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Notablemente capaz para generar permanentemente propuestas factibles de ser aplicadas</option>
			<option value="3">2 - Muy buena capacidad para proponer enfoques novedosos y factibles y desarrollar su propuesta en marcha</option>
			<option value="2">3 - Es capaz de generar propuestas adecuadas ante las necesidades de trabajo</option>
			<option value="1">4 - Ocasionalmente genera ideas o sugerencias dentro del área de su competencia</option>
			<option value="0">5 - Tiene serias dificultades para generar propuestas novedosas y factibles</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">7 - Resolver Problemas:</label>
		      <select class="form-control" name="item7" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente habilidad para descomponer las situaciones problemáticas</option>
			<option value="3">2 - Muy Buena capacidad para resolver los problemas de su área de modo que estos no lo superen</option>
			<option value="2">3 - Resuelve los problemas de rutina y evita complicaciones inncesarias</option>
			<option value="1">4 - En ocasiones manifiesta dificultades para encarar los problemas y hallar soluciones factibles</option>
			<option value="0">5 - Generalmente tiene dificultades para percibir los problemas. Le cuesta encontrar soluciones</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">8 - Interés por el Trabajo:</label>
		      <select class="form-control" name="item8" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excepcional compromiso. Se cuenta siempre con su ayuda en momentos de mayor presión y/o dificultad</option>
			<option value="3">2 - Muy buen nivel de compromiso con la tarea</option>
			<option value="2">3 - Buen nivel de compromiso e interés por la tarea</option>
			<option value="1">4 - Poco compromiso con la tarea</option>
			<option value="0">5 - Tiene serias dificultades para comprometerse con la tarea</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">9 - Actitud formativa:</label>
		      <select class="form-control" name="item9" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente predisposición para la actualización y formación</option>
			<option value="3">2 - Muy buena predisposición para la actualización y formación</option>
			<option value="2">3 - Cumple con los requerimientos de actualización y formación</option>
			<option value="1">4 - No demuestra especial interés por mejorar sus conocimientos profesionales</option>
			<option value="0">5 - No demuestra preocupación o compromiso por su actualización y formación profesional</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">10 - Capacidad Analítica:</label>
		      <select class="form-control" name="item10" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Sobresaliente por su aptitud analítica</option>
			<option value="3">2 - Analiza integralmente las situaciones sometidas a su estudio</option>
			<option value="2">3 - Analiza satisfactoriamente las situaciones emergentes de su trabajo específico</option>
			<option value="1">4 - Suele tener dificultades para analizar y relacionar los factores incluídos en las situaciones de trabajo</option>
			<option value="0">5 - Tiene grandes dificultades para valorar los hechos y sacar conclusiones</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">11 - Capacidad de Asesoramiento e Información:</label>
		      <select class="form-control" name="item11" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente aptitud para brindar información clara y precisa</option>
			<option value="3">2 - Buen nivel de asesoramiento</option>
			<option value="2">3 - Proporciona información y asesoramiento útil y transmite adecuadamente</option>
			<option value="1">4 - Tiene dificultades para trasnmitir información con claridad y precisión</option>
			<option value="0">5 - Usualmente sus opiniones y asesoramientos son inadecuados y faltos de oportunidad y/o su transmisión suele ser impropia</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">12 - Adaptabilidad:</label>
		      <select class="form-control" name="item12" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Encara con mucha soltura situaciones nuevas o cambiantes y siempre se involucra dinámicamente</option>
			<option value="3">2 - Comprende los cambios rápidamente y sin dificultad, actuando consecuntemente en la elaboración de respuestas pertinentes</option>
			<option value="2">3 - Es permeable a los cambios y reacciona razonablemente en la generación de los cursos de acción adecuados</option>
			<option value="1">4 - Le cuesta asimilar los cambios. Tiene dificultad para generar cursos de acción adecuados</option>
			<option value="0">5 - Es poco permeable a las nuevas situaciones de trabajo. Difícilmente genra cursos de acción eficaces ante las nuevas situaciones</option>
		      </select>
		    </div><hr>
		    
		    </div>
		    <div class="panel-footer"><button type="submit" class="btn btn-success btn-block" name="A"><img src="../../icons/actions/go-next.png"  class="img-reponsive img-rounded"> Continuar</button>
		      </form> <br></div>
		  </div>
		</div>
	     
	     
	      </div>';

}


//////////////////// SECCION FORMULARIO 3 //////////////////////

/*
** Formulario Nivel 3 - Medio con Personal a cargo
*/
function formulario3($agente,$cuil,$nivel_grado,$estudios,$nivel,$revista){

        echo '<div class="container-fluid"
		<div class="row">
		  <div class="col-sm-6">
		    <div class="panel panel-primary">
		    <div class="panel-heading">Formulario Nivel 3 Medio con Personal a Cargo - Datos del Agente:  '.$agente.'</div>
		    <div class="panel-body">
		    <p>Serán evaluados en este nivel los agentes que desempeñan funciones de Jefe de Departamento o equivalente y personal que 
			desempeña funciones ejecutivas de nivel V no incluídas en los niveles anteriores.</p><hr>
			
			<h3><strong>Identificación del Organismo en el que revista según estructura</strong></h3><hr>
		    
		    <form action="../evaluaciones/resultadoForm3.php" method="POST">
		    <input type="hidden" id="id" name="nivel" value="'.$nivel.'" />
		     <input type="hidden" id="id" name="revista" value="'.$revista.'" />
		   
		   <div class="form-group">
		      <label for="nombre">Juriscidicción/Org. Descentralizado</label>
		      <input type="text" class="form-control" id="nombre" name="juris" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Secretaría / Gerencia</label>
		      <input type="text" class="form-control" id="nombre" name="secretaria" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Subsecretaría</label>
		      <input type="text" class="form-control" id="nombre" name="subsecretaria" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Dirección Nacional / General</label>
		      <input type="text" class="form-control" id="nombre" name="direccion" onKeyDown="limitText(this,60);" required>
		    </div><hr>
			
		    <div class="form-group">
		      <label for="nombre">Unidad</label>
		      <input type="text" class="form-control" id="nombre" name="unidad" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <h3><strong>Para casos en que el Agente preste servicios en otra Unidad de Evaluación diferente a la de revista</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Unidad de Evaluación</label>
		      <input type="text" class="form-control" id="nombre" name="unidad2" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Código Unidad de Evaluación</label>
		      <input type="text" class="form-control" id="nombre" name="cod_uni" onKeyDown="limitText(this,6);" required>
		    </div><hr>
		    
		    <h3><strong>Identificación del Evaluador</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Apellido y Nombre</label>
		      <input type="text" class="form-control" id="nombre" name="nombre_evaluador" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">DNI</label>
		      <input type="text" class="form-control" id="nombre" name="dni_evaluador" onKeyDown="limitText(this,8);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">Situacion Escalafonaria:</label>
		      <select class="form-control" name="sit_esc_eval">
			<option value="" disabled selected>Seleccionar</option>
			<option value="Otra">Otra</option>
			<option value="SINEP">SINAPA/SINEP</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Nivel y Grado</label>
		      <input type="text" class="form-control" id="nombre" name="nivel_grado_eval" onKeyDown="limitText(this,3);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Agrupamiento</label>
		      <input type="text" class="form-control" id="nombre" name="agrupamiento_eval" onKeyDown="limitText(this,25);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Cargo que Ocupa</label>
		      <input type="text" class="form-control" id="nombre" name="cargo_eval" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <h3><strong>Identificación del Agente</strong></h3><hr>
		    
		     <div class="form-group">
		      <label for="nombre">Apellido y Nombre</label>
		      <input type="text" class="form-control" id="nombre" name="nombre_agente" onKeyDown="limitText(this,60);" value="'.$agente.'" required readonly>
		     </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">DNI / CUIL</label>
		      <input type="text" class="form-control" id="nombre" name="dni_agente" onKeyDown="limitText(this,11);" value="'.$cuil.'" required readonly>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Legajo</label>
		      <input type="text" class="form-control" id="nombre" name="legajo_agente" onKeyDown="limitText(this,15);" required>
		     </div><hr>
		     
		     <div class="form-group">
		      <label for="nombre">Nivel y Grado</label>
		      <input type="text" class="form-control" id="nombre" name="ng_agente" onKeyDown="limitText(this,3);" value="'.$nivel_grado.'" required readonly>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Agrupamiento</label>
		      <input type="text" class="form-control" id="nombre" name="agrupamiento2" onKeyDown="limitText(this,25);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Nivel Educativo</label>
		      <input type="text" class="form-control" id="nombre" name="educacion" onKeyDown="limitText(this,13);" value="'.$estudios.'" required readonly>
		    </div><hr>
		    
		    <h3><strong>Período Evaluado</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="f_nac">Fecha Desde</label>
		      <input type="date" class="form-control" id="f_desde" name="f_desde" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="f_nac">Fecha Hasta</label>
		      <input type="date" class="form-control" id="f_hasta" name="f_hasta" required>
		    </div><hr>
		    
		    </div>
		    <div class="panel-footer"><p><strong>Importante: No olvide completar ninguno de los datos anteriores y verificar que son los correctos.-</strong></p></div>
		  </div>
		</div>
	      
		  <div class="col-sm-6">
		    <div class="panel panel-primary">
		    <div class="panel-heading">Formulario Nivel 3 - Fomulario de Evaluación</div>
		    <div class="panel-body">
		    
		    <p>Cada uno de los Items a evaluar cuenta con 5 factores, cada factor tiene un valor asociado. El valor más alto está representado
			por el primero de los factores y el más bajo por el quinto, dichos valores van del 4 al 0.
			La sumatoria de los valores obtenidos en cada item darán un total el cuál será asociado a una Calificación final.</p><hr>
		    
		    <div class="form-group">
		      <label for="sel1">1 - Planificación:</label>
		      <select class="form-control" name="item1" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Planificación Altamente Eficiente</option>
			<option value="3">2 - Muy Buenos Programas y cursos de Acción</option>
			<option value="2">3 - Planifica adecuadamente y Establece metas razonables</option>
			<option value="1">4 - Presenta dificultades a la hora de establecer planes</option>
			<option value="0">5 - Planifica poco o establece planes poco eficientes</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">2 - Gestión de Control de Programas y Planes:</label>
		      <select class="form-control" name="item2" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente capacidad para cumplir eficazmente los objetivos</option>
			<option value="3">2 - Muy Buena capacidad para alcanzar los objetivos y metas propuestos</option>
			<option value="2">3 - Logra cumplir las metas propuestas para su sector  controla adecuadamente los resultados</option>
			<option value="1">4 - Tiene Dificultades para lograr que se cumplan las metas previstas</option>
			<option value="0">5 - Difícilmente logra concretar las metas previstas</option>
		      </select>
		    </div><hr>
		    
		     <div class="form-group">
		      <label for="sel1">3 - Organización del Trabajo:</label>
		      <select class="form-control" name="item3" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente capacidad organizativa</option>
			<option value="3">2 - Muy buena capacidad organizativa y de asignación de recursos</option>
			<option value="2">3 - Organiza adecuadamente los procesos de trabajo</option>
			<option value="1">4 - Escasa capacidad organizativa</option>
			<option value="0">5 - Tiene problemas para integrar los factores de la producción</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">4 - Conducción:</label>
		      <select class="form-control" name="item4" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente habilidad para dirigir y coordinar grupos de trabajo</option>
			<option value="3">2 - Muy buen criterio para dirigir y coordinar</option>
			<option value="2">3 - Su habilidad para conducir le permite lograr un buen trabajo en equipo</option>
			<option value="1">4 - A veces presenta dificultades para dirigir y coordinar a su personal</option>
			<option value="0">5 - Contínuamente presenta problemas para dirigir y coordinar al personal</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">5 - Competencias para la Función:</label>
		      <select class="form-control" name="item5" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Conoce plenamente el contenido de su función</option>
			<option value="3">2 - Muy buen nivel de conocimientos, técnicas, habilidades y procedimientos requeridos para su función</option>
			<option value="2">3 - Conoce su cometido y realiza bien su trabjo habitual</option>
			<option value="1">4 - Escaso nivel de conocimintos y habilidades requeridas. Su trabajo no siempre es satisfactorio</option>
			<option value="0">5 - Su muy bajo nivel de conocimientos y habilidades requeridos le impiden desenvolverse en su trabajo adecuadamente</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">6 - Iniciativa:</label>
		      <select class="form-control" name="item6" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Notablemente capaz para generar acciones oportunas asumiendo los riesgos necesarios</option>
			<option value="3">2 - Muy buena capacidad para actuar oportunamente asumiendo los riesgos necesarios</option>
			<option value="2">3 - Actúa oportunamente asumiendo los riesgos necesarios</option>
			<option value="1">4 - Ocasionalmente tiene problemas para actuar y asumir riesgos</option>
			<option value="0">5 - Tiene problemas para pasar a la acción y asumir los riesgos que ello implica</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">7 - Resolver Problemas:</label>
		      <select class="form-control" name="item7" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente habilidad para descomponer las situaciones problemáticas</option>
			<option value="3">2 - Muy Buena capacidad para resolver los problemas de su área de modo que estos no lo superen</option>
			<option value="2">3 - Resuelve los problemas de rutina y evita complicaciones inncesarias</option>
			<option value="1">4 - En ocasiones manifiesta dificultades para encarar los problemas y hallar soluciones factibles</option>
			<option value="0">5 - Generalmente tiene dificultades para percibir los problemas. Le cuesta encontrar soluciones</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">8 - Interés por el Trabajo:</label>
		      <select class="form-control" name="item8" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excepcional compromiso. Se cuenta siempre con su ayuda en momentos de mayor presión y/o dificultad</option>
			<option value="3">2 - Muy buen nivel de compromiso con la tarea</option>
			<option value="2">3 - Buen nivel de compromiso e interés por la tarea</option>
			<option value="1">4 - Poco compromiso con la tarea</option>
			<option value="0">5 - Tiene serias dificultades para comprometerse con la tarea</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">9 - Actitud formativa:</label>
		      <select class="form-control" name="item9" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Considera que la formación y capacitación son esenciales y trata de adquirirla y proporcionarla a sus subordinados</option>
			<option value="3">2 - Demuestra mucho interés en el desarrollo propio y de sus colaboradores</option>
			<option value="2">3 - Promueve su formación y la de sus colaboradores para el desarrollo del trabajo en su área</option>
			<option value="1">4 - No demuestra especial interés por mejorar sus conocimientos ni los de sus colaboradores</option>
			<option value="0">5 - Le da muy poca o ninguna importancia a la formación propia y a la de sus colaboradores</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">10 - Comunicación:</label>
		      <select class="form-control" name="item10" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - En general siempre establece una buena comunicación con sus pares, superiores y subordinados</option>
			<option value="3">2 - Muy buena habilidad para comunicarse con sus pares, superiores o subordinados</option>
			<option value="2">3 - Buena habilidad comunicativa, manejando la información adecuadamente en su área</option>
			<option value="1">4 - A veces muestra deficiencias en la comunicación o presenta dificultades en el manejo de la información</option>
			<option value="0">5 - Habitualmente tiene dificultades en la transmisión y utilización de la información recibida</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">11 - Colaboración:</label>
		      <select class="form-control" name="item11" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Ofrece permanentemente su colaboración ante cada circunstancia y problema</option>
			<option value="3">2 - Está muy dispuesto/a a colaborar</option>
			<option value="2">3 - Colabora adecuadamente en los esfuerzos por alcanzar los objetivos comunes</option>
			<option value="1">4 - Realiza aportes limitados y circunstanciales para la obtención de los objetivos comunes</option>
			<option value="0">5 - Suele tener dificultades para colaborar con sus pares y superiores</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">12 - Adaptabilidad:</label>
		      <select class="form-control" name="item12" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Encara con mucha soltura situaciones nuevas o cambiantes y siempre se involucra dinámicamente</option>
			<option value="3">2 - Comprende los cambios rápidamente y sin dificultad, actuando consecuntemente en la elaboración de respuestas pertinentes</option>
			<option value="2">3 - Es permeable a los cambios y reacciona razonablemente en la generación de los cursos de acción adecuados</option>
			<option value="1">4 - Le cuesta asimilar los cambios. Tiene dificultad para generar cursos de acción adecuados</option>
			<option value="0">5 - Es poco permeable a las nuevas situaciones de trabajo. Difícilmente genra cursos de acción eficaces ante las nuevas situaciones</option>
		      </select>
		    </div><hr>
		    
		    </div>
		    <div class="panel-footer">
		    <p><strong>Importante:</strong> Antes de presionar "Continuar" verifíque que cada uno de los items que han sido seleccionados sean los correctos.-</p><hr>
		    <button type="submit" class="btn btn-success btn-block" name="A"><img src="../../icons/actions/go-next.png"  class="img-reponsive img-rounded"> Continuar</button>
		      </form> <br></div>
		  </div>
		</div>
	     
	     
	      </div>';

}


//////////////////// SECCION FORMULARIO 4 //////////////////////

/*
** Formulario Nivel 4 - Medio sin Personal a cargo
*/
function formulario4($agente,$cuil,$nivel_grado,$estudios,$nivel,$revista){

        echo '<div class="container-fluid"
		<div class="row">
		  <div class="col-sm-6">
		    <div class="panel panel-primary">
		    <div class="panel-heading">Formulario Nivel 4 Medio sin Personal a Cargo - Datos del Agente:  '.$agente.'</div>
		    <div class="panel-body">
		    <p>Serán evaluados en este nivel los agentes de los niveles A, B, C y D que cumplan funciones
			profesionales, técnicas o de asesoría no incluídas en los niveles anteriores.</p><hr>
			
			<h3><strong>Identificación del Organismo en el que revista según estructura</strong></h3><hr>
		    
		    <form action="../evaluaciones/resultadoForm4.php" method="POST">
		    <input type="hidden" id="id" name="nivel" value="'.$nivel.'" />
		     <input type="hidden" id="id" name="revista" value="'.$revista.'" />
		   
		   <div class="form-group">
		      <label for="nombre">Juriscidicción/Org. Descentralizado</label>
		      <input type="text" class="form-control" id="nombre" name="juris" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Secretaría / Gerencia</label>
		      <input type="text" class="form-control" id="nombre" name="secretaria" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Subsecretaría</label>
		      <input type="text" class="form-control" id="nombre" name="subsecretaria" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Dirección Nacional / General</label>
		      <input type="text" class="form-control" id="nombre" name="direccion" onKeyDown="limitText(this,60);" required>
		    </div><hr>
			
		    <div class="form-group">
		      <label for="nombre">Unidad</label>
		      <input type="text" class="form-control" id="nombre" name="unidad" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <h3><strong>Para casos en que el Agente preste servicios en otra Unidad de Evaluación diferente a la de revista</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Unidad de Evaluación</label>
		      <input type="text" class="form-control" id="nombre" name="unidad2" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Código Unidad de Evaluación</label>
		      <input type="text" class="form-control" id="nombre" name="cod_uni" onKeyDown="limitText(this,6);" required>
		    </div><hr>
		    
		    <h3><strong>Identificación del Evaluador</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Apellido y Nombre</label>
		      <input type="text" class="form-control" id="nombre" name="nombre_evaluador" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">DNI</label>
		      <input type="text" class="form-control" id="nombre" name="dni_evaluador" onKeyDown="limitText(this,8);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">Situacion Escalafonaria:</label>
		      <select class="form-control" name="sit_esc_eval">
			<option value="" disabled selected>Seleccionar</option>
			<option value="Otra">Otra</option>
			<option value="SINEP">SINAPA/SINEP</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Nivel y Grado</label>
		      <input type="text" class="form-control" id="nombre" name="nivel_grado_eval" onKeyDown="limitText(this,3);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Agrupamiento</label>
		      <input type="text" class="form-control" id="nombre" name="agrupamiento_eval" onKeyDown="limitText(this,25);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Cargo que Ocupa</label>
		      <input type="text" class="form-control" id="nombre" name="cargo_eval" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <h3><strong>Identificación del Agente</strong></h3><hr>
		    
		     <div class="form-group">
		      <label for="nombre">Apellido y Nombre</label>
		      <input type="text" class="form-control" id="nombre" name="nombre_agente" onKeyDown="limitText(this,60);" value="'.$agente.'" required readonly>
		     </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">DNI / CUIL</label>
		      <input type="text" class="form-control" id="nombre" name="dni_agente" onKeyDown="limitText(this,11);" value="'.$cuil.'" required readonly>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Legajo</label>
		      <input type="text" class="form-control" id="nombre" name="legajo_agente" onKeyDown="limitText(this,15);" required>
		     </div><hr>
		     
		     <div class="form-group">
		      <label for="nombre">Nivel y Grado</label>
		      <input type="text" class="form-control" id="nombre" name="ng_agente" onKeyDown="limitText(this,3);" value="'.$nivel_grado.'" required readonly>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Agrupamiento</label>
		      <input type="text" class="form-control" id="nombre" name="agrupamiento2" onKeyDown="limitText(this,25);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Nivel Educativo</label>
		      <input type="text" class="form-control" id="nombre" name="educacion" onKeyDown="limitText(this,13);" value="'.$estudios.'" required readonly>
		    </div><hr>
		    
		    <h3><strong>Período Evaluado</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="f_nac">Fecha Desde</label>
		      <input type="date" class="form-control" id="f_desde" name="f_desde" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="f_nac">Fecha Hasta</label>
		      <input type="date" class="form-control" id="f_hasta" name="f_hasta" required>
		    </div><hr>
		    
		    </div>
		    <div class="panel-footer"><p><strong>Importante: No olvide completar ninguno de los datos anteriores y verificar que son los correctos.-</strong></p></div>
		  </div>
		</div>
	      
		  <div class="col-sm-6">
		    <div class="panel panel-primary">
		    <div class="panel-heading">Formulario Nivel 4 - Fomulario de Evaluación</div>
		    <div class="panel-body">
		    
		    <p>Cada uno de los Items a evaluar cuenta con 5 factores, cada factor tiene un valor asociado. El valor más alto está representado
			por el primero de los factores y el más bajo por el quinto, dichos valores van del 4 al 0.
			La sumatoria de los valores obtenidos en cada item darán un total el cuál será asociado a una Calificación final.</p><hr>
		    
		    <div class="form-group">
		      <label for="sel1">1 - Competencias Profesionales para la Función:</label>
		      <select class="form-control" name="item1" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente nivel de formacion y actualización que aplica eficientemente en todas las fases de su trabajo</option>
			<option value="3">2 - Muy buen nivel de formación y actualización, realiza su trabajo con solvencia profesional</option>
			<option value="2">3 - Posee y aplica adecuadamente los conocimientos teórico-prácticos requeridos por su puesto</option>
			<option value="1">4 - Tiene conocimientos limitados y/o los aplica con dificultad</option>
			<option value="0">5 - Su nivel de conocimientos o su dominio para aplicarlos no le permiten desenvolverse en su trabajo adecuadamente</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">2 - Creatividad:</label>
		      <select class="form-control" name="item2" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Notablemente capaz para generar permanentemente propuestas factibles de ser aplicadas</option>
			<option value="3">2 - Muy buena capacidad para proponer enfoques novedosos y factibles para desarrollar su propuesta en marcha</option>
			<option value="2">3 - Es capaz de generar propuestas adecuadas ante las necesidades de trabajo</option>
			<option value="1">4 - Ocasionalmente genera ideas o sugerencias dentro del área de su competencia</option>
			<option value="0">5 - Tiene serias dificultades para generar propuestas novedosas y factibles</option>
		      </select>
		    </div><hr>
		    
		     <div class="form-group">
		      <label for="sel1">3 - Resolver Problemas:</label>
		      <select class="form-control" name="item3" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente habilidad para descomponer las situaciones problemáticas</option>
			<option value="3">2 - Muy Buena capacidad para resolver los problemas de su área de modo que estos no lo superen</option>
			<option value="2">3 - Resuelve los problemas de rutina y evita complicaciones inncesarias</option>
			<option value="1">4 - En ocasiones manifiesta dificultades para encarar los problemas y hallar soluciones factibles</option>
			<option value="0">5 - Generalmente tiene dificultades para percibir los problemas. Le cuesta encontrar soluciones</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">4 - Cumplimiento con el Trabajo:</label>
		      <select class="form-control" name="item4" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Optimo cumplimiento en tiempo y forma de todas las tareas que se le encargan con excelentes resultadas</option>
			<option value="3">2 - Buen manejo de los plazos de tiempo y muy buenos resultados en el cumplimiento de las metas de trabajo</option>
			<option value="2">3 - Normalmente cumple en término con sus trabajos y logra resultados adecuados</option>
			<option value="1">4 - Es irregular en el cumplimiento de su trabajo. En ocasiones no respeta los plazos</option>
			<option value="0">5 - No completa adecuadamente sus trabajos o los realiza fuera de término</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">5 - Capacidad Analítica:</label>
		      <select class="form-control" name="item5" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Sobresaliente aptitud analítica</option>
			<option value="3">2 - Analiza integralmente las situaciones sometidas a su estudio</option>
			<option value="2">3 - Analiza satisfactoriamente las situaciones emergentes de su trabajo</option>
			<option value="1">4 - Suele presentar dificultades para analizar y relacionar los factores incluidos en las situaciones de trabajo</option>
			<option value="0">5 - Tiene dificultades para analizar integralmente los factores involucrados</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">6 - Capacidad de Asesoramiento:</label>
		      <select class="form-control" name="item6" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente aptitud para brindar información clara y precisa</option>
			<option value="3">2 - Buen nivel de asesoramiento</option>
			<option value="2">3 - Proporciona información y asesoramiento útil. Transmite adecuadamente</option>
			<option value="1">4 - Tiene dificultades para transmitir información</option>
			<option value="0">5 - Usualmente sus opiniones y asesoramientos son inadecuados</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">7 - Actitud Formativa:</label>
		      <select class="form-control" name="item7" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente predisposición para la actualización y formación</option>
			<option value="3">2 - Muy buena predisposición para la actualización y formación</option>
			<option value="2">3 - Cumple con los requerimientos de actualización y formación</option>
			<option value="1">4 - No demuestra especial interés por mejorar sus conocimientos profesionales</option>
			<option value="0">5 - No demuestra preocupación o compromiso por su actualización y formación profesional</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">8 - Interés por el Trabajo:</label>
		      <select class="form-control" name="item8" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excepcional compromiso. Se cuenta siempre con su ayuda en momentos de mayor presión y/o dificultad</option>
			<option value="3">2 - Muy buen nivel de compromiso con la tarea</option>
			<option value="2">3 - Buen nivel de compromiso e interés por la tarea</option>
			<option value="1">4 - Poco compromiso con la tarea</option>
			<option value="0">5 - Tiene serias dificultades para comprometerse con la tarea</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">9 - Colaboración</label>
		      <select class="form-control" name="item9" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente colaborador con sus superiores y sus pares, gran facilidad para integrarse activamente en equipos de trabajo</option>
			<option value="3">2 - Muy buena disposición para colaborar individualmente o cuando integra grupos de trabajo</option>
			<option value="2">3 - Buen colaborador, se integra adecuadamente en equipos de trabajo</option>
			<option value="1">4 - A veces poco dispuesto a colaborar, le cuesta integrarse en equipo</option>
			<option value="0">5 - Suele tener dificultades para colaborar con sus pares y superiores</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">10 - Adaptabilidad:</label>
		      <select class="form-control" name="item10" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Encara con mucha soltura situaciones nuevas o cambiantes y siempre se involucra dinámicamente</option>
			<option value="3">2 - Comprende los cambios rápidamente y sin dificultades</option>
			<option value="2">3 - Es permeable a los cambios y reacciona razonablemente en la generación de los cursos de acción adecuados</option>
			<option value="1">4 - Le cuesta asimilar los cambios, tiene dificultad para generar cursos de acción</option>
			<option value="0">5 - Es poco permeable a las nuevas situaciones de trabajo y muy poco capaz de adoptar cursos de acción adaptados a ellas</option>
		      </select>
		    </div><hr>
		    
		    
		    
		    </div>
		    <div class="panel-footer">
		    <p><strong>Importante:</strong> Antes de presionar "Continuar" verifíque que cada uno de los items que han sido seleccionados sean los correctos.-</p><hr>
		    <button type="submit" class="btn btn-success btn-block" name="A"><img src="../../icons/actions/go-next.png"  class="img-reponsive img-rounded"> Continuar</button>
		      </form> <br></div>
		  </div>
		</div>
	     
	     
	      </div>';

}

/////////////////////// SECCION FORMULARIO 5 ///////////////////

/*
** Formulario Nivel 5 - Operativo con Personal a cargo
*/
function formulario5($agente,$cuil,$nivel_grado,$estudios,$nivel,$revista){

        echo '<div class="container-fluid"
		<div class="row">
		  <div class="col-sm-6">
		    <div class="panel panel-primary">
		    <div class="panel-heading">Formulario Nivel 5 Operativo con Personal a Cargo - Datos del Agente:  '.$agente.'</div>
		    <div class="panel-body">
		    <p>Serán evaluados en este nivel los agentes que cumplan funciones de Jefe de División, Sección o equivalente
			para las que no se requiera título académico terciario o universitario.</p><hr>
			
			<h3><strong>Identificación del Organismo en el que revista según estructura</strong></h3><hr>
		    
		    <form action="../evaluaciones/resultadoForm5.php" method="POST">
		    <input type="hidden" id="id" name="nivel" value="'.$nivel.'" />
		     <input type="hidden" id="id" name="revista" value="'.$revista.'" />
		   
		   <div class="form-group">
		      <label for="nombre">Juriscidicción/Org. Descentralizado</label>
		      <input type="text" class="form-control" id="nombre" name="juris" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Secretaría / Gerencia</label>
		      <input type="text" class="form-control" id="nombre" name="secretaria" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Subsecretaría</label>
		      <input type="text" class="form-control" id="nombre" name="subsecretaria" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Dirección Nacional / General</label>
		      <input type="text" class="form-control" id="nombre" name="direccion" onKeyDown="limitText(this,60);" required>
		    </div><hr>
			
		    <div class="form-group">
		      <label for="nombre">Unidad</label>
		      <input type="text" class="form-control" id="nombre" name="unidad" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <h3><strong>Para casos en que el Agente preste servicios en otra Unidad de Evaluación diferente a la de revista</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Unidad de Evaluación</label>
		      <input type="text" class="form-control" id="nombre" name="unidad2" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Código Unidad de Evaluación</label>
		      <input type="text" class="form-control" id="nombre" name="cod_uni" onKeyDown="limitText(this,6);" required>
		    </div><hr>
		    
		    <h3><strong>Identificación del Evaluador</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Apellido y Nombre</label>
		      <input type="text" class="form-control" id="nombre" name="nombre_evaluador" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">DNI</label>
		      <input type="text" class="form-control" id="nombre" name="dni_evaluador" onKeyDown="limitText(this,8);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">Situacion Escalafonaria:</label>
		      <select class="form-control" name="sit_esc_eval">
			<option value="" disabled selected>Seleccionar</option>
			<option value="Otra">Otra</option>
			<option value="SINEP">SINAPA/SINEP</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Nivel y Grado</label>
		      <input type="text" class="form-control" id="nombre" name="nivel_grado_eval" onKeyDown="limitText(this,3);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Agrupamiento</label>
		      <input type="text" class="form-control" id="nombre" name="agrupamiento_eval" onKeyDown="limitText(this,25);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Cargo que Ocupa</label>
		      <input type="text" class="form-control" id="nombre" name="cargo_eval" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <h3><strong>Identificación del Agente</strong></h3><hr>
		    
		     <div class="form-group">
		      <label for="nombre">Apellido y Nombre</label>
		      <input type="text" class="form-control" id="nombre" name="nombre_agente" onKeyDown="limitText(this,60);" value="'.$agente.'" required readonly>
		     </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">DNI / CUIL</label>
		      <input type="text" class="form-control" id="nombre" name="dni_agente" onKeyDown="limitText(this,11);" value="'.$cuil.'" required readonly>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Legajo</label>
		      <input type="text" class="form-control" id="nombre" name="legajo_agente" onKeyDown="limitText(this,15);" required>
		     </div><hr>
		     
		     <div class="form-group">
		      <label for="nombre">Nivel y Grado</label>
		      <input type="text" class="form-control" id="nombre" name="ng_agente" onKeyDown="limitText(this,3);" value="'.$nivel_grado.'" required readonly>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Agrupamiento</label>
		      <input type="text" class="form-control" id="nombre" name="agrupamiento2" onKeyDown="limitText(this,25);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Nivel Educativo</label>
		      <input type="text" class="form-control" id="nombre" name="educacion" onKeyDown="limitText(this,13);" value="'.$estudios.'" required readonly>
		    </div><hr>
		    
		    <h3><strong>Período Evaluado</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="f_nac">Fecha Desde</label>
		      <input type="date" class="form-control" id="f_desde" name="f_desde" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="f_nac">Fecha Hasta</label>
		      <input type="date" class="form-control" id="f_hasta" name="f_hasta" required>
		    </div><hr>
		    
		    </div>
		    <div class="panel-footer"><p><strong>Importante: No olvide completar ninguno de los datos anteriores y verificar que son los correctos.-</strong></p></div>
		  </div>
		</div>
	      
		  <div class="col-sm-6">
		    <div class="panel panel-primary">
		    <div class="panel-heading">Formulario Nivel 5 - Fomulario de Evaluación</div>
		    <div class="panel-body">
		    
		    <p>Cada uno de los Items a evaluar cuenta con 5 factores, cada factor tiene un valor asociado. El valor más alto está representado
			por el primero de los factores y el más bajo por el quinto, dichos valores van del 4 al 0.
			La sumatoria de los valores obtenidos en cada item darán un total el cuál será asociado a una Calificación final.</p><hr>
		    
		    <div class="form-group">
		      <label for="sel1">1 - Organización:</label>
		      <select class="form-control" name="item1" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente Capacidad organizativa</option>
			<option value="3">2 - Tiene muy buena capacidad organizativa y de asignación de recursos, supera los requerimientos normales del puesto</option>
			<option value="2">3 - Organiza adecuadamente los procesos de trabajo normal y los mantiene bajo control</option>
			<option value="1">4 - Escasa capacidad organizativa. En ocasiones no maneja adecuadamente los factores involucrados</option>
			<option value="0">5 - Tiene dificultades para manejar adecuadamente los factores involucrados en el trabajo del equipo</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">2 - Supervisación:</label>
		      <select class="form-control" name="item2" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excepcional habilidad para supervisar personas o grupos de trabajo</option>
			<option value="3">2 - Buen criterio para supervisar. Logra muy buenos resultados de conjunto</option>
			<option value="2">3 - Logra un buen trabajo de conjunto. Tiene buen ascendente sobre su grupo</option>
			<option value="1">4 - A veces presenta dificultades para supervisar a su personal y obtener resultados de conjunto</option>
			<option value="0">5 - Contínuamente tiene dificultades en la supervisación de su personal</option>
		      </select>
		    </div><hr>
		    
		     <div class="form-group">
		      <label for="sel1">3.1 - Cantidad de Trabajo:</label>
		      <select class="form-control" name="item31" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Rendimiento excepcionalmente alto. Sobrepasa los márgenes requeridos normalmente en su puesto</option>
			<option value="3">2 - Siempre alcanza y frecuentemente supera el rendimiento requerido en los plazos previstos</option>
			<option value="2">3 - Alcanza los niveles normales de trabajo a un ritmo aceptable y en los plazos establecidos</option>
			<option value="1">4 - Su rendieminto está por debajo de los niveles requeridos</option>
			<option value="0">5 - Su rendimiento está muy por debajo de los requerimientos.</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">3.2 - Calidad de Trabajo:</label>
		      <select class="form-control" name="item32" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excepcional nivel de calidad de trabajo</option>
			<option value="3">2 - Muy buen nivel de calidad de trabajo</option>
			<option value="2">3 - Adecuado nivel de calidad de trabajo</option>
			<option value="1">4 - Tiene dificultades para realizar su trabajo con la calidad requerida</option>
			<option value="0">5 - Falta de calidad en la realización de su trabajo. Necesita constante monitoreo</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">3.3 - Manejo de Recursos:</label>
		      <select class="form-control" name="item33" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelete manejo de los recursos asignados a su puesto</option>
			<option value="3">2 - Muy efectivo para administrar recursos y reducir costos, mejorar métodos, procedimientos y técnicas</option>
			<option value="2">3 - Buen sentido de la admnistración de los recursos</option>
			<option value="1">4 - Tiene dificultades para administrar apropiadamente los recursos asignados a su puesto</option>
			<option value="0">5 - No aprovecha los recursos asiganos a su puesto</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">4 - Conocimientos de las Tareas:</label>
		      <select class="form-control" name="item4" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excepcional dominio de todas las fases de su trabajo</option>
			<option value="3">2 - Buen dominio de las fases de su trabajo y sólidos conocimientos de sus tareas</option>
			<option value="2">3 - Conoce adecuadamente su trabajo y las tareas relacionadas</option>
			<option value="1">4 - Posee sólo los conocimientos elementales relacionados con su tarea</option>
			<option value="0">5 - Conocimientos insuficientes para el desempeño de las tareas a su cargo</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">5 - Criterio:</label>
		      <select class="form-control" name="item5" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excepcional capacidad para comprender las pautas de trabajo y actuar en consecuencia</option>
			<option value="3">2 - Muy buena capacidad de comprensión de las pautas de trabajo que le permite actuar minimizando los errores</option>
			<option value="2">3 - Interpreta sin dificultad las pautas de trabajo y responde adecuadamente</option>
			<option value="1">4 - Tiene dificulad para interpretar las pautas de trabajo</option>
			<option value="0">5 - Le cuesta comprender las pautas de trabajo y requiere una permanente indicación y monitoreo de las tareas</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">6 - Colaboracion:</label>
		      <select class="form-control" name="item6" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente disposición a cooperar ante cada circunstacia o problema que se presente</option>
			<option value="3">2 - Muy dispuesto/a  a cooperar. En general es requerido por su actitud que es reconocida y valorada</option>
			<option value="2">3 - Coopera con sus jefes y compañeros</option>
			<option value="1">4 - Dispuesto a prestar ayuda sólo en algunos casos. Prefiere no trabajar en equipo</option>
			<option value="0">5 - Siempre tiene dificultades para cooperar con sus pares y superiores</option>
		      </select>
		    </div><hr>
		     
		    
		    </div>
		    <div class="panel-footer">
		    <p><strong>Importante:</strong> Antes de presionar "Continuar" verifíque que cada uno de los items que han sido seleccionados sean los correctos.-</p><hr>
		    <button type="submit" class="btn btn-success btn-block" name="A"><img src="../../icons/actions/go-next.png"  class="img-reponsive img-rounded"> Continuar</button>
		      </form> <br></div>
		  </div>
		</div>
	     
	     
	      </div>';

}


/////////////////// SECCION FORMULARIO 6 ///////////////////

/*
** Formulario Nivel 6 - Operativo sin Personal a cargo
*/
function formulario6($agente,$cuil,$nivel_grado,$estudios,$nivel,$revista){

        echo '<div class="container-fluid"
		<div class="row">
		  <div class="col-sm-6">
		    <div class="panel panel-primary">
		    <div class="panel-heading">Formulario Nivel 6 Operativo sin Personal a Cargo - Datos del Agente:  '.$agente.'</div>
		    <div class="panel-body">
		    <p>Serán evaluados en este nivel los agentes no incluídos en los niveles anteriores
			El personal con atención al público será evaluado teniendo en cuenta esta circunstancia.</p><hr>
			
			<h3><strong>Identificación del Organismo en el que revista según estructura</strong></h3><hr>
		    
		    <form action="../evaluaciones/resultadoForm6.php" method="POST">
		    <input type="hidden" id="id" name="nivel" value="'.$nivel.'" />
		     <input type="hidden" id="id" name="revista" value="'.$revista.'" />
		   
		   <div class="form-group">
		      <label for="nombre">Juriscidicción/Org. Descentralizado</label>
		      <input type="text" class="form-control" id="nombre" name="juris" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Secretaría / Gerencia</label>
		      <input type="text" class="form-control" id="nombre" name="secretaria" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Subsecretaría</label>
		      <input type="text" class="form-control" id="nombre" name="subsecretaria" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Dirección Nacional / General</label>
		      <input type="text" class="form-control" id="nombre" name="direccion" onKeyDown="limitText(this,60);" required>
		    </div><hr>
			
		    <div class="form-group">
		      <label for="nombre">Unidad</label>
		      <input type="text" class="form-control" id="nombre" name="unidad" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <h3><strong>Para casos en que el Agente preste servicios en otra Unidad de Evaluación diferente a la de revista</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Unidad de Evaluación</label>
		      <input type="text" class="form-control" id="nombre" name="unidad2" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Código Unidad de Evaluación</label>
		      <input type="text" class="form-control" id="nombre" name="cod_uni" onKeyDown="limitText(this,6);" required>
		    </div><hr>
		    
		    <h3><strong>Identificación del Evaluador</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Apellido y Nombre</label>
		      <input type="text" class="form-control" id="nombre" name="nombre_evaluador" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">DNI</label>
		      <input type="text" class="form-control" id="nombre" name="dni_evaluador" onKeyDown="limitText(this,8);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">Situacion Escalafonaria:</label>
		      <select class="form-control" name="sit_esc_eval">
			<option value="" disabled selected>Seleccionar</option>
			<option value="Otra">Otra</option>
			<option value="SINEP">SINAPA/SINEP</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Nivel y Grado</label>
		      <input type="text" class="form-control" id="nombre" name="nivel_grado_eval" onKeyDown="limitText(this,3);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Agrupamiento</label>
		      <input type="text" class="form-control" id="nombre" name="agrupamiento_eval" onKeyDown="limitText(this,25);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Cargo que Ocupa</label>
		      <input type="text" class="form-control" id="nombre" name="cargo_eval" onKeyDown="limitText(this,60);" required>
		    </div><hr>
		    
		    <h3><strong>Identificación del Agente</strong></h3><hr>
		    
		     <div class="form-group">
		      <label for="nombre">Apellido y Nombre</label>
		      <input type="text" class="form-control" id="nombre" name="nombre_agente" onKeyDown="limitText(this,60);" value="'.$agente.'" required readonly>
		     </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">DNI / CUIL</label>
		      <input type="text" class="form-control" id="nombre" name="dni_agente" onKeyDown="limitText(this,11);" value="'.$cuil.'" required readonly>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Legajo</label>
		      <input type="text" class="form-control" id="nombre" name="legajo_agente" onKeyDown="limitText(this,15);" value="'.$cuil.'" required readonly>
		     </div><hr>
		     
		     <div class="form-group">
		      <label for="nombre">Nivel y Grado</label>
		      <input type="text" class="form-control" id="nombre" name="ng_agente" onKeyDown="limitText(this,3);" value="'.$nivel_grado.'" required readonly>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Agrupamiento</label>
		      <input type="text" class="form-control" id="nombre" name="agrupamiento2" onKeyDown="limitText(this,25);" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Nivel Educativo</label>
		      <input type="text" class="form-control" id="nombre" name="educacion" onKeyDown="limitText(this,13);" value="'.$estudios.'" required readonly>
		    </div><hr>
		    
		    <h3><strong>Período Evaluado</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="f_nac">Fecha Desde</label>
		      <input type="date" class="form-control" id="f_desde" name="f_desde" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="f_nac">Fecha Hasta</label>
		      <input type="date" class="form-control" id="f_hasta" name="f_hasta" required>
		    </div><hr>
		    
		    </div>
		    <div class="panel-footer"><p><strong>Importante: No olvide completar ninguno de los datos anteriores y verificar que son los correctos.-</strong></p></div>
		  </div>
		</div>
	      
		  <div class="col-sm-6">
		    <div class="panel panel-primary">
		    <div class="panel-heading">Formulario Nivel 6 - Fomulario de Evaluación</div>
		    <div class="panel-body">
		    
		    <p>Cada uno de los Items a evaluar cuenta con 5 factores, cada factor tiene un valor asociado. El valor más alto está representado
			por el primero de los factores y el más bajo por el quinto, dichos valores van del 4 al 0.
			La sumatoria de los valores obtenidos en cada item darán un total el cuál será asociado a una Calificación final.</p><hr>
		    
		    
		     <div class="form-group">
		      <label for="sel1">1.1 - Cantidad de Trabajo:</label>
		      <select class="form-control" name="item11" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Rendimiento excepcionalmente alto. Sobrepasa los márgenes requeridos normalmente en su puesto</option>
			<option value="3">2 - Siempre alcanza y frecuentemente supera el rendimiento requerido en los plazos previstos</option>
			<option value="2">3 - Alcanza los niveles normales de trabajo a un ritmo aceptable y en los plazos establecidos</option>
			<option value="1">4 - Su rendieminto está por debajo de los niveles requeridos</option>
			<option value="0">5 - Su rendimiento está muy por debajo de los requerimientos.</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">1.2 - Calidad de Trabajo:</label>
		      <select class="form-control" name="item12" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excepcional nivel de calidad de trabajo</option>
			<option value="3">2 - Muy buen nivel de calidad de trabajo</option>
			<option value="2">3 - Adecuado nivel de calidad de trabajo</option>
			<option value="1">4 - Tiene dificultades para realizar su trabajo con la calidad requerida</option>
			<option value="0">5 - Falta de calidad en la realización de su trabajo. Necesita constante monitoreo</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">1.3 - Manejo de Recursos:</label>
		      <select class="form-control" name="item13" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelete manejo de los recursos asignados a su puesto</option>
			<option value="3">2 - Muy efectivo para administrar recursos y reducir costos, mejorar métodos, procedimientos y técnicas</option>
			<option value="2">3 - Buen sentido de la admnistración de los recursos</option>
			<option value="1">4 - Tiene dificultades para administrar apropiadamente los recursos asignados a su puesto</option>
			<option value="0">5 - No aprovecha los recursos asiganos a su puesto</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">2 - Conocimientos de las Tareas:</label>
		      <select class="form-control" name="item2" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excepcional dominio de todas las fases de su trabajo</option>
			<option value="3">2 - Buen dominio de las fases de su trabajo y sólidos conocimientos de sus tareas</option>
			<option value="2">3 - Interpreta sin dificultad las pautas de trabajo y responde adecuadamente</option>
			<option value="1">4 - Posee sólo los conocimientos elementales relacionados con su tarea</option>
			<option value="0">5 - Conocimientos insuficientes para el desempeño de las tareas a su cargo</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">3 - Criterio:</label>
		      <select class="form-control" name="item3" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excepcional capacidad para comprender las pautas de trabajo y actuar en consecuencia</option>
			<option value="3">2 - Muy buena capacidad de comprensión de las pautas de trabajo que le permite actuar minimizando los errores</option>
			<option value="2">3 - Conoce adecuadamente su trabajoy las tareas relacionadas</option>
			<option value="1">4 - Tiene dificulad para interpretar las pautas de trabajo</option>
			<option value="0">5 - Le cuesta comprender las pautas de trabajo y requiere una permanente indicación y monitoreo de las tareas</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">4 - Colaboracion:</label>
		      <select class="form-control" name="item4" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4">1 - Excelente disposición a cooperar ante cada circunstacia o problema que se presente</option>
			<option value="3">2 - Muy dispuesto/a  a cooperar. En general es requerido por su actitud que es reconocida y valorada</option>
			<option value="2">3 - Coopera con sus jefes y compañeros</option>
			<option value="1">4 - Dispuesto a prestar ayuda sólo en algunos casos. Prefiere no trabajar en equipo</option>
			<option value="0">5 - Siempre tiene dificultades para cooperar con sus pares y superiores</option>
		      </select>
		    </div><hr>
		     
		    
		    </div>
		    <div class="panel-footer">
		    <p><strong>Importante:</strong> Antes de presionar "Continuar" verifíque que cada uno de los items que han sido seleccionados sean los correctos.-</p><hr>
		    <button type="submit" class="btn btn-success btn-block" name="A"><img src="../../icons/actions/go-next.png"  class="img-reponsive img-rounded"> Continuar</button>
		      </form> <br></div>
		  </div>
		</div>
	     
	     
	      </div>';

}



///////////////////// SECCION EDITAR EVALUACIONES //////////////////////

/*
** Formulario Nivel 1 - Gerencial
*/
function editForm1($id,$nombre,$f_desde,$f_hasta,$conn){
        
        $sql = "select * from evaluaciones1 where id = '$id'";
        mysqli_select_db('siseval');
        $res = mysqli_query($conn,$sql);
        $fila = mysqli_fetch_assoc($res);
        
        $query = "select * from eval_datos where nombre_agente = '$nombre' and f_desde = '$f_desde' and f_hasta = '$f_hasta'";
        mysqli_select_db('siseval');
        $resp = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($resp);

        echo '<div class="container-fluid"
		<div class="row">
		  <div class="col-sm-6">
		    <div class="panel panel-primary">
		    <div class="panel-heading">Formulario Nivel 1 Gerencial - Datos del Agente:  '.$fila['agente'].'</div>
		    <div class="panel-body">
		    <p>Serán evaluados en este nivel los agentes que cumplan con funciones de Director Nacional, General, Subdirector 
			o equivalentes y personal con funciones ejecutivas hasta nivel IV</p><hr>
			<h3><strong>Identificación del Organismo en el que revista según estructura</strong></h3><hr>
		    
		    <form action="../evaluaciones/editResultadoForm1.php" method="POST">
		    <input type="hidden" id="id" name="id" value="'.$id.'" />
		        
		   <div class="form-group">
		      <label for="nombre">Juriscidicción/Org. Descentralizado</label>
		      <input type="text" class="form-control" id="nombre" name="juris" onKeyDown="limitText(this,60);" value="'.$row['jurisdiccion'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Secretaría / Gerencia</label>
		      <input type="text" class="form-control" id="nombre" name="secretaria" onKeyDown="limitText(this,60);" value="'.$row['secretaria'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Subsecretaría</label>
		      <input type="text" class="form-control" id="nombre" name="subsecretaria" onKeyDown="limitText(this,60);" value="'.$row['subsecretaria'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Dirección Nacional / General</label>
		      <input type="text" class="form-control" id="nombre" name="direccion" onKeyDown="limitText(this,60);" value="'.$row['direccion'].'" required>
		    </div><hr>
			
		    <div class="form-group">
		      <label for="nombre">Unidad</label>
		      <input type="text" class="form-control" id="nombre" name="unidad" onKeyDown="limitText(this,60);" value="'.$row['unidad'].'" required>
		    </div><hr>
		    
		    <h3><strong>Para casos en que el Agente preste servicios en otra Unidad de Evaluación diferente a la de revista</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Unidad de Evaluación</label>
		      <input type="text" class="form-control" id="nombre" name="unidad2" onKeyDown="limitText(this,60);" value="'.$row['unidad2'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Código Unidad de Evaluación</label>
		      <input type="text" class="form-control" id="nombre" name="cod_uni" onKeyDown="limitText(this,6);" value="'.$row['cod_uni'].'" required>
		    </div><hr>
		    
		    <h3><strong>Identificación del Evaluador</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Apellido y Nombre</label>
		      <input type="text" class="form-control" id="nombre" name="nombre_evaluador" onKeyDown="limitText(this,60);" value="'.$row['evaluador'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">DNI</label>
		      <input type="text" class="form-control" id="nombre" name="dni_evaluador" onKeyDown="limitText(this,8);" value="'.$row['dni_evaluador'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">Situacion Escalafonaria:</label>
		      <select class="form-control" name="sit_esc_eval">
			<option value="" disabled selected>Seleccionar</option>
			<option value="Otra" '.($row['sit_esc_eval'] == "Otra" ? "selected" : ""). '>Otra</option>
			<option value="SINEP" '.($row['sit_esc_eval'] == "SINEP" ? "selected" : ""). '>SINAPA/SINEP</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Nivel y Grado</label>
		      <input type="text" class="form-control" id="nombre" name="nivel_grado_eval" onKeyDown="limitText(this,3);" value="'.$row['niv_gr_eval'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Agrupamiento</label>
		      <input type="text" class="form-control" id="nombre" name="agrupamiento_eval" onKeyDown="limitText(this,25);" value="'.$row['agrup_eval'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Cargo que Ocupa</label>
		      <input type="text" class="form-control" id="nombre" name="cargo_eval" onKeyDown="limitText(this,60);" value="'.$row['cargo_eval'].'" required>
		    </div><hr>
		    
		    <h3><strong>Identificación del Agente</strong></h3><hr>
		    
		     <div class="form-group">
		      <label for="nombre">Apellido y Nombre</label>
		      <input type="text" class="form-control" id="nombre" name="nombre_agente" onKeyDown="limitText(this,60);" value="'.$row['nombre_agente'].'" required readonly>
		     </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">DNI / CUIL</label>
		      <input type="text" class="form-control" id="nombre" name="dni_agente" onKeyDown="limitText(this,11);" value="'.$row['dni_agente'].'" required readonly>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Legajo</label>
		      <input type="text" class="form-control" id="nombre" name="legajo_agente" onKeyDown="limitText(this,15);" value="'.$row['legajo_agente'].'" required>
		     </div><hr>
		     
		     <div class="form-group">
		      <label for="nombre">Nivel y Grado</label>
		      <input type="text" class="form-control" id="nombre" name="ng_agente" onKeyDown="limitText(this,3);" value="'.$row['niv_gr_agente'].'" required readonly>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Agrupamiento</label>
		      <input type="text" class="form-control" id="nombre" name="agrupamiento2" onKeyDown="limitText(this,25);" value="'.$row['agrup_agente'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Nivel Educativo</label>
		      <input type="text" class="form-control" id="nombre" name="educacion" onKeyDown="limitText(this,13);" value="'.$row['educacion'].'" required readonly>
		    </div><hr>
		    
		    <h3><strong>Período Evaluado</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="f_nac">Fecha Desde</label>
		      <input type="date" class="form-control" id="f_desde" name="f_desde" value="'.$fila['f_desde'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="f_nac">Fecha Hasta</label>
		      <input type="date" class="form-control" id="f_hasta" name="f_hasta" value="'.$fila['f_hasta'].'" required>
		    </div><hr>
		    
		    </div>
		    <div class="panel-footer"><p><strong>Importante: No olvide completar ninguno de los datos anteriores</strong></p></div>
		  </div>
		</div>
	      
		  <div class="col-sm-6">
		    <div class="panel panel-primary">
		    <div class="panel-heading">Formulario Nivel 1 - Fomulario de Evaluación</div>
		    <div class="panel-body">
		    
		    <p>Cada uno de los Items a evaluar cuenta con 5 factores, cada factor tiene un valor asociado. El valor más alto está representado
			por el primero de los factores y el más bajo por el quinto, dichos valores van del 4 al 0.
			La sumatoria de los valores obtenidos en cada item darán un total el cuál será asociado a una Calificación final.</p><hr>
		    
		    <div class="form-group">
		      <label for="sel1">1 - Planificación:</label>
		      <select class="form-control" name="item1" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item1'] == "4" ? "selected" : ""). '>1 - Planificación Altamente Eficiente</option>
			<option value="3" '.($fila['item1'] == "3" ? "selected" : ""). '>2 - Muy Buenos Programas y cursos de Acción</option>
			<option value="2" '.($fila['item1'] == "2" ? "selected" : ""). '>3 - Planifica adecuadamente y Establece metas razonables</option>
			<option value="1" '.($fila['item1'] == "1" ? "selected" : ""). '>4 - Presenta dificultades a la hora de establecer planes</option>
			<option value="0" '.($fila['item1'] == "0" ? "selected" : ""). '>5 - Planifica poco o establece planes poco eficientes</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">2 - Gestión de Planes y Programas:</label>
		      <select class="form-control" name="item2" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item2'] == "4" ? "selected" : ""). '>1 - Logra el total cumplimiento eficaz de los objetivos</option>
			<option value="3" '.($fila['item2'] == "3" ? "selected" : ""). '>2 - Logra buen cumplimiento de los objetivos y metas propuestos</option>
			<option value="2" '.($fila['item2'] == "2" ? "selected" : ""). '>3 - Logra que las metas propuestas dentro de su área se alcancen en los plazos previstos</option>
			<option value="1" '.($fila['item2'] == "1" ? "selected" : ""). '>4 - Tiene Dificultades para lograr que se cumplan las metas</option>
			<option value="0" '.($fila['item2'] == "0" ? "selected" : ""). '>5 - Difícilmente logra concretar las metas previstas</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">3 - Control de Resultados:</label>
		      <select class="form-control" name="item3" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item3'] == "4" ? "selected" : ""). '>1 - Controla de manera excelente la gestión de su área</option>
			<option value="3" '.($fila['item3'] == "3" ? "selected" : ""). '>2 - Controla la gestión de su área de manera muy eficiente</option>
			<option value="2" '.($fila['item3'] == "2" ? "selected" : ""). '>3 - Realiza controles adecuados</option>
			<option value="1" '.($fila['item3'] == "1" ? "selected" : ""). '>4 - Sus controles son puntuales o excesivos</option>
			<option value="0" '.($fila['item3'] == "0" ? "selected" : ""). '>5 - Rara vez evalúa y/o controla las tareas durante su ejecución</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">4.1 - Organización del Trabajo:</label>
		      <select class="form-control" name="item41" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item41'] == "4" ? "selected" : ""). '>1 - Excelente capacidad organizativa</option>
			<option value="3" '.($fila['item41'] == "3" ? "selected" : ""). '>2 - Muy buena capacidad organizativa y de asignación de recursos</option>
			<option value="2" '.($fila['item41'] == "2" ? "selected" : ""). '>3 - Organiza adecuadamente los procesos de trabajo</option>
			<option value="1" '.($fila['item41'] == "1" ? "selected" : ""). '>4 - Escasa capacidad organizativa</option>
			<option value="0" '.($fila['item41'] == "0" ? "selected" : ""). '>5 - Tiene problemas para integrar los factores de la producción</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">4.2 - Resolver Problemas:</label>
		      <select class="form-control" name="item42" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item42'] == "4" ? "selected" : ""). '>1 - Excelente habilidad para descomponer y analizar situaciones problemáticas</option>
			<option value="3" '.($fila['item42'] == "3" ? "selected" : ""). '>2 - Muy buena capacidad para analizar y resolver problemas</option>
			<option value="2" '.($fila['item42'] == "2" ? "selected" : ""). '>3 - Analiza y resuelve los problemas de rutina y evita complicaciones innecesarias</option>
			<option value="1" '.($fila['item42'] == "1" ? "selected" : ""). '>4 - En ocasiones manifiesta dificultades para analizar los problemas</option>
			<option value="0" '.($fila['item42'] == "0" ? "selected" : ""). '>5 - Generalmente tiene dificultades para percibir los problemas</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">5 - Conducción:</label>
		      <select class="form-control" name="item5" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item5'] == "4" ? "selected" : ""). '>1 - Excelente habilidad para dirigir y coordinar grupos de trabajo</option>
			<option value="3" '.($fila['item5'] == "3" ? "selected" : ""). '>2 - Muy buen criterio para dirigir</option>
			<option value="2" '.($fila['item5'] == "2" ? "selected" : ""). '>3 - Es efectivo en la dirección y coordinación del personal</option>
			<option value="1" '.($fila['item5'] == "1" ? "selected" : ""). '>4 - Suele tener dificultades para dirigir a su personal</option>
			<option value="0" '.($fila['item5'] == "0" ? "selected" : ""). '>5 - Contínuamente presenta problemas para dirigir la acción del personal</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">6.1 - Asumir representación interna y externa:</label>
		      <select class="form-control" name="item61" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item61'] == "4" ? "selected" : ""). '>1 - Gran capacidad para relacionarse con el contexto y representar a su área</option>
			<option value="3" '.($fila['item61'] == "3" ? "selected" : ""). '>2 - Muy buena capacidad para representar a su área</option>
			<option value="2" '.($fila['item61'] == "2" ? "selected" : ""). '>3 - Establece y mantiene relaciones convenientes para el accionar laboral de su área</option>
			<option value="1" '.($fila['item61'] == "1" ? "selected" : ""). '>4 - A veces no asume convenientemente la representación de su área</option>
			<option value="0" '.($fila['item61'] == "0" ? "selected" : ""). '>5 - Tiene dificultades para establecer relaciones cuando asume la representación de su área</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">6.2 - Cerrar Transacciones:</label>
		      <select class="form-control" name="item62" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item62'] == "4" ? "selected" : ""). '>1 - Notable facilidad para conducir negociaciones</option>
			<option value="3" '.($fila['item62'] == "3" ? "selected" : ""). '>2 - Conduce habilidosamente y concreta los procesos de negociación con muy buenos resultados</option>
			<option value="2" '.($fila['item62'] == "2" ? "selected" : ""). '>3 - Conduce y cierra satisfactoriamente procesos de negociación habituales</option>
			<option value="1" '.($fila['item62'] == "1" ? "selected" : ""). '>4 - Puede iniciar y conducir transacciones pero tiene dificultad para cerrarlas</option>
			<option value="0" '.($fila['item62'] == "0" ? "selected" : ""). '>5 - Su actuación normalmente lleva a cierres confusos e inconvenientes que deben ser rectificados</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">7.1 - Interpretación y predicción del contexto:</label>
		      <select class="form-control" name="item71" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item71'] == "4" ? "selected" : ""). '>1 - Optima lectura de la realidad</option>
			<option value="3" '.($fila['item71'] == "3" ? "selected" : ""). '>2 - Realiza lecturas muy acertadas de la realidad en términos de ventajas y desventajas</option>
			<option value="2" '.($fila['item71'] == "2" ? "selected" : ""). '>3 - Sus lecturas de la realidad son razonablemente correctas</option>
			<option value="1" '.($fila['item71'] == "1" ? "selected" : ""). '>4 - A menudo tiene dificultades para leer correctamente la realidad</option>
			<option value="0" '.($fila['item71'] == "0" ? "selected" : ""). '>5 - Lectura habitualemnte incorrecta de la realidad</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">7.2 - Maximizar Oportunidades:</label>
		      <select class="form-control" name="item72" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item72'] == "4" ? "selected" : ""). '>1 - Excelente habilidad para aprovechar oportunidades en la programacón de su área</option>
			<option value="3" '.($fila['item72'] == "3" ? "selected" : ""). '>2 - Aprovecha muy bien las oportunidades del contexto</option>
			<option value="2" '.($fila['item72'] == "2" ? "selected" : ""). '>3 - Normalmente aprovecha oportunidades en la formulación de los planes y programas de su área</option>
			<option value="1" '.($fila['item72'] == "1" ? "selected" : ""). '>4 - Escasamente aprovecha las oportunidades, se mantiene en la rutina</option>
			<option value="0" '.($fila['item72'] == "0" ? "selected" : ""). '>5 - Muy poco capaz de aprovechar oportunidades que resultarían claramente favorables para su área</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">8 - Iniciativa:</label>
		      <select class="form-control" name="item8" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item8'] == "4" ? "selected" : ""). '>1 - Notablemente capaz para generar acciones oportunas</option>
			<option value="3" '.($fila['item8'] == "3" ? "selected" : ""). '>2 - Muy buena capacidad para actuar oportunamente</option>
			<option value="2" '.($fila['item8'] == "2" ? "selected" : ""). '>3 - Actúa oportunamente asumiento los riesgos necesarios</option>
			<option value="1" '.($fila['item8'] == "1" ? "selected" : ""). '>4 - Ocasionalmente tiene problemas para actuar y asumir riesgos</option>
			<option value="0" '.($fila['item8'] == "0" ? "selected" : ""). '>5 - Tiene dificultades para pasar a la acción y asumir los riesgos que ello implica</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">9 - Adaptabilidad:</label>
		      <select class="form-control" name="item9" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item9'] == "4" ? "selected" : ""). '>1 - Demuestra absoluta apertura para asimilar los cambios y para generar rápidamente cursos de acción</option>
			<option value="3" '.($fila['item9'] == "3" ? "selected" : ""). '>2 - Comprende los cambios rápidamente y sin dificultades</option>
			<option value="2" '.($fila['item9'] == "2" ? "selected" : ""). '>3 - Es permeable a los cambios y reacciona razonablemente bien en la generación de cursos de acción adecuados</option>
			<option value="1" '.($fila['item9'] == "1" ? "selected" : ""). '>4 - Le cuesta aceptar los cambios. Tiene dificultades para generar cursos de acción adecuados</option>
			<option value="0" '.($fila['item9'] == "0" ? "selected" : ""). '>5 - Es muy poco permeable a los nuevas situaciones de trabajo.</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">10 - Autonomía:</label>
		      <select class="form-control" name="item10" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item10'] == "4" ? "selected" : ""). '>1 - Casi siempre se maneja con gran independencia, tomando las decisiones con total responsabilidad</option>
			<option value="3" '.($fila['item10'] == "3" ? "selected" : ""). '>2 - Generalmente muestra independencia, tomando decisiones bajo su propia responsabilidad</option>
			<option value="2" '.($fila['item10'] == "2" ? "selected" : ""). '>3 - Toma decisiones adecuadas a su función en situaciones usuales</option>
			<option value="1" '.($fila['item10'] == "1" ? "selected" : ""). '>4 - Pocas veces exhibe una conducta autónoma, con frecuencia solicita apoyo</option>
			<option value="0" '.($fila['item10'] == "0" ? "selected" : ""). '>5 - Muy frecuentemente necesita consultar a sus superiores o a pares para tomar decisiones</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">11 - Identificación con la Organización:</label>
		      <select class="form-control" name="item11" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item11'] == "4" ? "selected" : ""). '>1 - Su desempeño está permanentemente comprometido con los fines de la organización</option>
			<option value="3" '.($fila['item11'] == "3" ? "selected" : ""). '>2 - Muy buen nivel de compromiso con los fines de la organización</option>
			<option value="2" '.($fila['item11'] == "2" ? "selected" : ""). '>3 - Adecuado compromiso con los fines y metas de la organización</option>
			<option value="1" '.($fila['item11'] == "1" ? "selected" : ""). '>4 - Bajo compromiso con los fines y metas de la organización</option>
			<option value="0" '.($fila['item11'] == "0" ? "selected" : ""). '>5 - Se compromete muy poco con los objetivos organizacionales y parece que siempre prevalecen sus interese personales</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">Estado:</label>
		      <select class="form-control" name="estado" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="abierta" '.($fila['estado'] == "abierta" ? "selected" : ""). '>Abierta</option>
			<option value="cerrada" '.($fila['estado'] == "cerrada" ? "selected" : ""). '>Cerrada</option>
			</select>
		    </div><hr>
		    
		    </div>
		    <div class="panel-footer"><button type="submit" class="btn btn-success btn-block" name="A"><img src="../../icons/actions/go-next.png"  class="img-reponsive img-rounded"> Continuar</button>
		      </form> <br></div>
		  </div>
		</div>
	     
	     
	      </div>';

}



/*
** Formulario Nivel 6 - Operativo sin Personal a cargo
*/
function editForm6($id,$nombre,$f_desde,$f_hasta,$conn){
        
        $sql = "select * from evaluaciones6 where id = '$id'";
        mysqli_select_db('siseval');
        $res = mysqli_query($conn,$sql);
        $fila = mysqli_fetch_assoc($res);
        
        $query = "select * from eval_datos where nombre_agente = '$nombre' and f_desde = '$f_desde' and f_hasta = '$f_hasta'";
        mysqli_select_db('siseval');
        $resp = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($resp);
        
        
        echo '<div class="container-fluid"
		<div class="row">
		  <div class="col-sm-6">
		    <div class="panel panel-primary">
		    <div class="panel-heading">Editar - Formulario Nivel 6 Operativo sin Personal a Cargo - Datos del Agente:  '.$fila['agente'].'</div>
		    <div class="panel-body">
		    <p>Serán evaluados en este nivel los agentes no incluídos en los niveles anteriores
			El personal con atención al público será evaluado teniendo en cuenta esta circunstancia.</p><hr>
			
			<h3><strong>Identificación del Organismo en el que revista según estructura</strong></h3><hr>
		    
		    <form action="../evaluaciones/editResultadoForm6.php" method="POST">
		    <input type="hidden" id="id" name="id" value="'.$id.'" />
		        
		   <div class="form-group">
		      <label for="nombre">Juriscidicción/Org. Descentralizado</label>
		      <input type="text" class="form-control" id="nombre" name="juris" onKeyDown="limitText(this,60);" value="'.$row['jurisdiccion'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Secretaría / Gerencia</label>
		      <input type="text" class="form-control" id="nombre" name="secretaria" onKeyDown="limitText(this,60);" value="'.$row['secretaria'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Subsecretaría</label>
		      <input type="text" class="form-control" id="nombre" name="subsecretaria" onKeyDown="limitText(this,60);" 
		      value="'.$row['subsecretaria'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Dirección Nacional / General</label>
		      <input type="text" class="form-control" id="nombre" name="direccion" onKeyDown="limitText(this,60);" value="'.$row['direccion'].'" required>
		    </div><hr>
			
		    <div class="form-group">
		      <label for="nombre">Unidad</label>
		      <input type="text" class="form-control" id="nombre" name="unidad" onKeyDown="limitText(this,60);" value="'.$row['unidad'].'" required>
		    </div><hr>
		    
		    <h3><strong>Para casos en que el Agente preste servicios en otra Unidad de Evaluación diferente a la de revista</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Unidad de Evaluación</label>
		      <input type="text" class="form-control" id="nombre" name="unidad2" onKeyDown="limitText(this,60);" value="'.$row['unidad2'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Código Unidad de Evaluación</label>
		      <input type="text" class="form-control" id="nombre" name="cod_uni" onKeyDown="limitText(this,6);" value="'.$row['cod_uni'].'" required>
		    </div><hr>
		    
		    <h3><strong>Identificación del Evaluador</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Apellido y Nombre</label>
		      <input type="text" class="form-control" id="nombre" name="nombre_evaluador" onKeyDown="limitText(this,60);" value="'.$row['evaluador'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">DNI</label>
		      <input type="text" class="form-control" id="nombre" name="dni_evaluador" onKeyDown="limitText(this,8);" value="'.$row['dni_evaluador'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">Situacion Escalafonaria:</label>
		      <select class="form-control" name="sit_esc_eval">
			<option value="" disabled selected>Seleccionar</option>
			<option value="Otra" '.($row['sit_esc_eval'] == "Otra" ? "selected" : ""). '>Otra</option>
			<option value="SINEP" '.($row['sit_esc_eval'] == "SINEP" ? "selected" : ""). '>SINAPA/SINEP</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Nivel y Grado</label>
		      <input type="text" class="form-control" id="nombre" name="nivel_grado_eval" onKeyDown="limitText(this,3);" value="'.$row['niv_gr_eval'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Agrupamiento</label>
		      <input type="text" class="form-control" id="nombre" name="agrupamiento_eval" onKeyDown="limitText(this,25);" value="'.$row['agrup_eval'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Cargo que Ocupa</label>
		      <input type="text" class="form-control" id="nombre" name="cargo_eval" onKeyDown="limitText(this,60);" value="'.$row['cargo_eval'].'" required>
		    </div><hr>
		    
		    <h3><strong>Identificación del Agente</strong></h3><hr>
		    
		     <div class="form-group">
		      <label for="nombre">Apellido y Nombre</label>
		      <input type="text" class="form-control" id="nombre" name="nombre_agente" onKeyDown="limitText(this,60);" value="'.$row['nombre_agente'].'" required readonly>
		     </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">DNI / CUIL</label>
		      <input type="text" class="form-control" id="nombre" name="dni_agente" onKeyDown="limitText(this,11);" value="'.$row['dni_agente'].'" required readonly>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Legajo</label>
		      <input type="text" class="form-control" id="nombre" name="legajo_agente" onKeyDown="limitText(this,15);" value="'.$row['legajo_agente'].'" required readonly>
		     </div><hr>
		     
		     <div class="form-group">
		      <label for="nombre">Nivel y Grado</label>
		      <input type="text" class="form-control" id="nombre" name="ng_agente" onKeyDown="limitText(this,3);" value="'.$row['niv_gr_agente'].'" required readonly>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Agrupamiento</label>
		      <input type="text" class="form-control" id="nombre" name="agrupamiento2" onKeyDown="limitText(this,25);" value="'.$row['agrup_agente'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="nombre">Nivel Educativo</label>
		      <input type="text" class="form-control" id="nombre" name="educacion" onKeyDown="limitText(this,13);" value="'.$row['educacion'].'" required>
		    </div><hr>
		    
		    <h3><strong>Período Evaluado</strong></h3><hr>
		    
		    <div class="form-group">
		      <label for="f_nac">Fecha Desde</label>
		      <input type="date" class="form-control" id="f_desde" name="f_desde" value="'.$fila['f_desde'].'" required>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="f_nac">Fecha Hasta</label>
		      <input type="date" class="form-control" id="f_hasta" name="f_hasta" value="'.$fila['f_hasta'].'" required>
		    </div><hr>
		    
		    </div>
		    <div class="panel-footer"><p><strong>Importante: No olvide completar ninguno de los datos anteriores y verificar que son los correctos.-</strong></p></div>
		  </div>
		</div>
	      
		  <div class="col-sm-6">
		    <div class="panel panel-primary">
		    <div class="panel-heading">Formulario Nivel 6 - Fomulario de Evaluación</div>
		    <div class="panel-body">
		    
		    <p>Cada uno de los Items a evaluar cuenta con 5 factores, cada factor tiene un valor asociado. El valor más alto está representado
			por el primero de los factores y el más bajo por el quinto, dichos valores van del 4 al 0.
			La sumatoria de los valores obtenidos en cada item darán un total el cuál será asociado a una Calificación final.</p><hr>
		    
		    
		     <div class="form-group">
		      <label for="sel1">1.1 - Cantidad de Trabajo:</label>
		      <select class="form-control" name="item11" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item11'] == "4" ? "selected" : ""). '>1 - Rendimiento excepcionalmente alto. Sobrepasa los márgenes requeridos normalmente en su puesto</option>
			<option value="3" '.($fila['item11'] == "3" ? "selected" : ""). '>2 - Siempre alcanza y frecuentemente supera el rendimiento requerido en los plazos previstos</option>
			<option value="2" '.($fila['item11'] == "2" ? "selected" : ""). '>3 - Alcanza los niveles normales de trabajo a un ritmo aceptable y en los plazos establecidos</option>
			<option value="1" '.($fila['item11'] == "1" ? "selected" : ""). '>4 - Su rendieminto está por debajo de los niveles requeridos</option>
			<option value="0" '.($fila['item11'] == "0" ? "selected" : ""). '>5 - Su rendimiento está muy por debajo de los requerimientos.</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">1.2 - Calidad de Trabajo:</label>
		      <select class="form-control" name="item12" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item12'] == "4" ? "selected" : ""). '>1 - Excepcional nivel de calidad de trabajo</option>
			<option value="3" '.($fila['item12'] == "3" ? "selected" : ""). '>2 - Muy buen nivel de calidad de trabajo</option>
			<option value="2" '.($fila['item12'] == "2" ? "selected" : ""). '>3 - Adecuado nivel de calidad de trabajo</option>
			<option value="1" '.($fila['item12'] == "1" ? "selected" : ""). '>4 - Tiene dificultades para realizar su trabajo con la calidad requerida</option>
			<option value="0" '.($fila['item12'] == "0" ? "selected" : ""). '>5 - Falta de calidad en la realización de su trabajo. Necesita constante monitoreo</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">1.3 - Manejo de Recursos:</label>
		      <select class="form-control" name="item13" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item13'] == "4" ? "selected" : ""). '>1 - Excelete manejo de los recursos asignados a su puesto</option>
			<option value="3" '.($fila['item13'] == "3" ? "selected" : ""). '>2 - Muy efectivo para administrar recursos y reducir costos, mejorar métodos, procedimientos y técnicas</option>
			<option value="2" '.($fila['item13'] == "2" ? "selected" : ""). '>3 - Buen sentido de la admnistración de los recursos</option>
			<option value="1" '.($fila['item13'] == "1" ? "selected" : ""). '>4 - Tiene dificultades para administrar apropiadamente los recursos asignados a su puesto</option>
			<option value="0" '.($fila['item13'] == "0" ? "selected" : ""). '>5 - No aprovecha los recursos asiganos a su puesto</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">2 - Conocimientos de las Tareas:</label>
		      <select class="form-control" name="item2" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item2'] == "4" ? "selected" : ""). '>1 - Excepcional dominio de todas las fases de su trabajo</option>
			<option value="3" '.($fila['item2'] == "3" ? "selected" : ""). '>2 - Buen dominio de las fases de su trabajo y sólidos conocimientos de sus tareas</option>
			<option value="2" '.($fila['item2'] == "2" ? "selected" : ""). '>3 - Interpreta sin dificultad las pautas de trabajo y responde adecuadamente</option>
			<option value="1" '.($fila['item2'] == "1" ? "selected" : ""). '>4 - Posee sólo los conocimientos elementales relacionados con su tarea</option>
			<option value="0" '.($fila['item2'] == "0" ? "selected" : ""). '>5 - Conocimientos insuficientes para el desempeño de las tareas a su cargo</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">3 - Criterio:</label>
		      <select class="form-control" name="item3" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item3'] == "4" ? "selected" : ""). '>1 - Excepcional capacidad para comprender las pautas de trabajo y actuar en consecuencia</option>
			<option value="3" '.($fila['item3'] == "3" ? "selected" : ""). '>2 - Muy buena capacidad de comprensión de las pautas de trabajo que le permite actuar minimizando los errores</option>
			<option value="2" '.($fila['item3'] == "2" ? "selected" : ""). '>3 - Conoce adecuadamente su trabajoy las tareas relacionadas</option>
			<option value="1" '.($fila['item3'] == "1" ? "selected" : ""). '>4 - Tiene dificulad para interpretar las pautas de trabajo</option>
			<option value="0" '.($fila['item3'] == "0" ? "selected" : ""). '>5 - Le cuesta comprender las pautas de trabajo y requiere una permanente indicación y monitoreo de las tareas</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">4 - Colaboracion:</label>
		      <select class="form-control" name="item4" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="4" '.($fila['item4'] == "4" ? "selected" : ""). '>1 - Excelente disposición a cooperar ante cada circunstacia o problema que se presente</option>
			<option value="3" '.($fila['item4'] == "3" ? "selected" : ""). '>2 - Muy dispuesto/a  a cooperar. En general es requerido por su actitud que es reconocida y valorada</option>
			<option value="2" '.($fila['item4'] == "2" ? "selected" : ""). '>3 - Coopera con sus jefes y compañeros</option>
			<option value="1" '.($fila['item4'] == "1" ? "selected" : ""). '>4 - Dispuesto a prestar ayuda sólo en algunos casos. Prefiere no trabajar en equipo</option>
			<option value="0" '.($fila['item4'] == "0" ? "selected" : ""). '>5 - Siempre tiene dificultades para cooperar con sus pares y superiores</option>
		      </select>
		    </div><hr>
		    
		    <div class="form-group">
		      <label for="sel1">Estado:</label>
		      <select class="form-control" name="estado" required>
			<option value="" disabled selected>Seleccionar</option>
			<option value="abierta" '.($fila['estado'] == "abierta" ? "selected" : ""). '>Abierta</option>
			<option value="cerrada" '.($fila['estado'] == "cerrada" ? "selected" : ""). '>Cerrada</option>
			</select>
		    </div><hr>
		     
		    
		    </div>
		    <div class="panel-footer">
		    <p><strong>Importante:</strong> Antes de presionar "Continuar" verifíque que cada uno de los items que han sido seleccionados sean los correctos.-</p>
		    <p><strong>Si no presenta modificación en los Items solo cambie el estado de la Evaluación a Cerrada. Recuerde que una vez cerrada la evaluación no podrá ser modficada.</strong></p><hr>
		    <button type="submit" class="btn btn-success btn-block" name="A"><img src="../../icons/actions/go-next.png"  class="img-reponsive img-rounded"> Continuar</button>
		      </form> <br></div>
		  </div>
		</div>
	     
	     
	      </div>';

}


/////////////////////// SECCION GUARDAR EN BASE DE DATOS /////////////////////////////

/*
** Funcion de carga a base de datos eval_datos
*/

function addEvalDatos($jurisdiccion,$secretaria,$subsecretaria,$direccion,$unidad,$unidad2,$cod_uni,$nom_eval,$dni_eval,$sit_esc_eval,$niv_gr_eval,$agrup_eval,$cargo_eval,$nombre_agente,$dni_agente,$leg_agente,$ng_agente,$agrupamiento2,$educacion,$f_desde,$f_hasta,$conn){

		
	mysqli_select_db('siseval');
	$sqlInsert = "INSERT INTO eval_datos ".
		"(jurisdiccion,secretaria,subsecretaria,direccion,unidad,unidad2,cod_uni,evaluador,dni_evaluador,sit_esc_eval,niv_gr_eval,cargo_eval,agrup_eval,nombre_agente,dni_agente,legajo_agente,niv_gr_agente,agrup_agente,educacion,f_desde,f_hasta)".
		"VALUES ".
      "('$jurisdiccion','$secretaria','$subsecretaria','$direccion','$unidad','$unidad2','$cod_uni','$nom_eval','$dni_eval','$sit_esc_eval','$niv_gr_eval','$cargo_eval','$agrup_eval','$nombre_agente','$dni_agente','$leg_agente','$ng_agente','$agrupamiento2','$educacion','$f_desde','$f_hasta')";
           
	$res = mysqli_query($conn,$sqlInsert);


	if($res){
		//mysqli_query($conn,$sqlInsert);
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-success" role="alert">';
		echo 'Datos de la Evaluación Guardados Exitosamente.';
		echo "</div>";
		echo "</div>";	
	}else{
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo "Hubo un error al guardar el Registro!" .mysqli_error($conn);
		echo "</div>";
		echo "</div>";
	}
}


/*
** Funcion de carga a base de datos tabla evaluaciones6
*/

function addEvaluacion6($item11,$item12,$item13,$item2,$item3,$item4,$nombre_agente,$dni_agente,$ng_agente,$revista,$nivel,$sum,$result,$f_desde,$f_hasta,$estado,$conn){

		
	mysqli_select_db('siseval');
	$sqlInsert = "INSERT INTO evaluaciones6 ".
		"(item11,item12,item13,item2,item3,item4,agente,dni,nivel_grado,revista,nivel,puntaje,calificacion,f_desde,f_hasta,estado)".
		"VALUES ".
      "('$item11','$item12','$item13','$item2','$item3','$item4','$nombre_agente','$dni_agente','$ng_agente','$revista','$nivel','$sum','$result','$f_desde','$f_hasta','$estado')";
           
	$res = mysqli_query($conn,$sqlInsert);


	if($res){
		//mysqli_query($conn,$sqlInsert);
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-success" role="alert">';
		echo 'La evaluación ha sido guardada Exitosamente.';
		echo 'Esta estará en estado ABIERTA hasta que el superior determine la aprobación de la misma y se cambie a estado CERRADA.<br>';
		echo 'En en caso de existir modificaciones podrá realizar las mismas desde el botón Editar.<br>';
		echo 'Una vez que el estado sea CERRADA, no se podrán realizar cambios en la evaluación, hasta volver a poner el estado en ABIERTA';
		echo "</div>";
		echo "</div>";	
	}else{
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo "Hubo un error al guardar el Registro!." .mysqli_error($conn);
		echo "</div>";
		echo "</div>";
	}
}


/*
** Funcion de carga a base de datos tabla evaluaciones1
*/

function addEvaluacion1($item1,$item2,$item3,$item41,$item42,$item5,$item61,$item62,$item71,$item72,$item8,$item9,$item10,$item11,$nombre_agente,$dni_agente,$ng_agente,$revista,$nivel,$sum,$result,$f_desde,$f_hasta,$estado,$conn){

		
	mysqli_select_db('siseval');
	$sqlInsert = "INSERT INTO evaluaciones1 ".
        "(item1,item2,item3,item41,item42,item5,item61,item62,item71,item72,item8,item9,item10,item11,agente,dni,nivel_grado,revista,nivel,puntaje,
        calificacion,f_desde,f_hasta,estado)".
		"VALUES ".
      "('$item1','$item2','$item3','$item41','$item42','$item5','$item61','$item62','$item71','$item72','$item8','$item9','$item10','$item11','$nombre_agente','$dni_agente','$ng_agente','$revista','$nivel','$sum','$result','$f_desde','$f_hasta','$estado')";
           
	$res = mysqli_query($conn,$sqlInsert);


	if($res){
		//mysqli_query($conn,$sqlInsert);
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-success" role="alert">';
		echo 'La evaluación ha sido guardada Exitosamente.';
		echo 'Esta estará en estado ABIERTA hasta que el superior determine la aprobación de la misma y se cambie a estado CERRADA.<br>';
		echo 'En en caso de existir modificaciones podrá realizar las mismas desde el botón Editar.<br>';
		echo 'Una vez que el estado sea CERRADA, no se podrán realizar cambios en la evaluación, hasta volver a poner el estado en ABIERTA';
		echo "</div>";
		echo "</div>";	
	}else{
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo "Hubo un error al guardar el Registro!." .mysqli_error($conn);
		echo "</div>";
		echo "</div>";
	}
}


//////////////////// SECCION ACTUALIZACION BASE DE DATOS /////////////////////////////

/**
** Funcion para actualizar tabla evaluaciones1
**/

function updateResultadoEval1($id,$item1,$item2,$item3,$item41,$item42,$item5,$item61,$item62,$item71,$item72,$item8,$item9,$item10,$item11,$nombre_agente,$dni_agente,$ng_agente,$sum,$result,$f_desde,$f_hasta,$estado,$nom_eval,$conn){

		
	mysqli_select_db('siseval');
	$sqlInsert = "update evaluaciones1 set item1 = '$item1', item2 = '$item2', item3 = '$item3', item41 = '$item41', item42 = '$item42', 
	item5 = '$item5', item61 = '$item61', item62 = '$item62', item71 = '$item71', item72 = '$item72', item8 = '$item8', item9 = '$item9', item10 = '$item10', item11 = '$item11', agente = '$nombre_agente', dni = '$dni_agente', nivel_grado = '$ng_agente', puntaje = '$sum', calificacion = '$result', f_desde = '$f_desde', f_hasta = '$f_hasta', estado = '$estado', evaluador = '$nom_eval' where id = '$id'";
           
	$res = mysqli_query($conn,$sqlInsert);


	if($res){
		//mysqli_query($conn,$sqlInsert);
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-success" role="alert">';
		echo 'Registro Actualizado Exitosamente.<br>';
		echo "La Evaluación de $nombre_agente ha sido cerrada Satisfactoriamente";
		echo "</div>";
		echo "</div>";	
	}else{
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo "Hubo un error al Actualizar el Registro!." .mysqli_error($conn);
		echo "</div>";
		echo "</div>";
	}
}

/**
** Funcion para actualizar tabla evaluaciones6
**/

function updateResultadoEval6($id,$item11,$item12,$item13,$item2,$item3,$item4,$nombre_agente,$dni_agente,$ng_agente,$sum,$result,$f_desde,$f_hasta,$estado,$evaluador,$conn){

		
	mysqli_select_db('siseval');
	$sqlInsert = "update evaluaciones6 set item11 = '$item11', item12 = '$item12', item13 = '$item13', item2 = '$item2', item3 = '$item3', 
	item4 = '$item4', agente = '$nombre_agente', dni = '$dni_agente', nivel_grado = '$ng_agente', puntaje = '$sum', calificacion = '$result', 
	f_desde = '$f_desde', f_hasta = '$f_hasta', estado = '$estado', evaluador = '$evaluador' where id = '$id'";
           
	$res = mysqli_query($conn,$sqlInsert);


	if($res){
		//mysqli_query($conn,$sqlInsert);
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-success" role="alert">';
		echo 'Registro Actualizado Exitosamente.<br>';
		echo "La Evaluación de $nombre_agente ha sido cerrada Satisfactoriamente";
		echo "</div>";
		echo "</div>";	
	}else{
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo "Hubo un error al Actualizar el Registro!." .mysqli_error($conn);
		echo "</div>";
		echo "</div>";
	}
}


/////////////////////////////// SECCION FORMULARIO 1 RESULTADOS ///////////////////////////////////

/*
** Funcion que carga el formulario de resultados Formulario 1 Gerencial
*/
function resultadoForm1($nombre_agente,$item1,$item2,$item3,$item41,$item42,$item5,$item61,$item62,$item71,$item72,$item8,$item9,$item10,$item11,$sum,$result,$f_desde,$f_hasta){


   echo '<div class="container-fluid">    
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Resultado Evaluación Agente: '.$nombre_agente.'</div>
        <div class="panel-body">
                
        <h2>Período Evaluado Desde: <strong>'.$f_desde.'</strong> Hasta: <strong>'.$f_hasta.'</strong></h2>
        <p>Puntajes obtenidos en cada Item</p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th class="text-nowrap text-center">Item</th>
        <th class="text-nowrap text-center">Puntaje</th>
        </tr>
    </thead>
    <tbody>
      <tr>
        <td align=left>1. Planificación</td>
        <td align=center>'.$item1.'</td>
        </tr>
      <tr>
        <td align=left>2. Gestión de Planes y Programas</td>
        <td align=center>'.$item2.'</td>
        </tr>
      <tr>
        <td align=left>3. Control de Resultados</td>
        <td align=center>'.$item3.'</td>
        </tr>
        <tr>
        <td align=left>4.1. Organizar el Trabajo</td>
        <td align=center>'.$item41.'</td>
        </tr>
        <tr>
        <td align=left>4.2. Resolver Problemas</td>
        <td align=center>'.$item42.'</td>
        </tr>
        <tr>
        <td align=left>5. Conducción</td>
        <td align=center>'.$item5.'</td>
        </tr>
        <tr>
        <td align=left>6.1. Asumir la Representación</td>
        <td align=center>'.$item61.'</td>
        </tr>
        <tr>
        <td align=left>6.2. Cerrar Transacciones</td>
        <td align=center>'.$item62.'</td>
        </tr>
        <tr>
        <td align=left>7.1. Interpretación</td>
        <td align=center>'.$item71.'</td>
        </tr>
        <tr>
        <td align=left>7.2. Maximizar Oportunidades</td>
        <td align=center>'.$item72.'</td>
        </tr>
        <tr>
        <td align=left>8. Iniciativa</td>
        <td align=center>'.$item8.'</td>
        </tr>
        <tr>
        <td align=left>9. Adaptabilidad</td>
        <td align=center>'.$item9.'</td>
        </tr>
        <tr>
        <td align=left>10. Autonomía</td>
        <td align=center>'.$item10.'</td>
        </tr>
        <tr>
        <td align=left>11. Identificación con la Organización</td>
        <td align=center>'.$item11.'</td>
        </tr>
    </tbody>
  </table><hr>
              
        <h3>Puntaje Total Obtenido: <strong>'.$sum.'</strong></h3><hr>
        <h3>Calificación Final: <strong>'.$result.'<strong></h3><hr>';
        
        if($result == "Regular" || $result == "Deficiente"){
        
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo '<img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> Ante dicha Calificación deberá utilizar el Formulario B. Por favor completelo accediendo desde el botón aquí abajo';
		echo '<hr><a href="../evaluaciones/formularioB.php" class="btn btn-primary btn-sm " ><span class="glyphicon glyphicon-list-alt"></span> Formulario B</a>';
		echo "</div>";
		echo "</div>";
		
	  
        }
        
        echo '</div>
        <div class="panel-footer">
        <p style="text-align: center;""><strong>IMPORTANTE</strong></p><hr>
        <p>1. En caso que el agente haya obtenido una calificación "Regular" o "Deficiente" se deberá adjuntar el Formulario B con el Programa de Recuperación</p>
        <p>2. Los Agentes que hayan tenido sanciones disciplinarias en el período evaluado y/o en algunos de los factores evaluados haya obtenidos subtotal de "0" o "1", no pueden calificar con "Muy Bueno" o "Destacado"</p>
        
        </div>
      </div>
    </div>
    
   
  </div>
</div>';

}


/////////////////////////////// SECCION FORMULARIO 2 RESULTADOS ///////////////////////////////////
/*
** Funcion que carga el formulario de resultados Formulario 2 Medio Tecnico
*/
function resultadoForm2($nombre_agente,$item1,$item2,$item3,$item4,$item5,$item6,$item7,$item8,$item9,$item10,$item11,$item12,$sum,$result,$f_desde,$f_hasta){


   echo '<div class="container-fluid">    
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Resultado Evaluación Agente: '.$nombre_agente.'</div>
        <div class="panel-body">
                
        <h2>Período Evaluado Desde: <strong>'.$f_desde.'</strong> Hasta: <strong>'.$f_hasta.'</strong></h2>
        <p>Puntajes obtenidos en cada Item</p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th class="text-nowrap text-center">Item</th>
        <th class="text-nowrap text-center">Puntaje</th>
        </tr>
    </thead>
    <tbody>
      <tr>
        <td align=left>1. Planificación</td>
        <td align=center>'.$item1.'</td>
        </tr>
      <tr>
        <td align=left>2. Gestión y Control de Programas y Planes</td>
        <td align=center>'.$item2.'</td>
        </tr>
      <tr>
        <td align=left>3. Organización</td>
        <td align=center>'.$item3.'</td>
        </tr>
        <tr>
        <td align=left>4. Conducción</td>
        <td align=center>'.$item4.'</td>
        </tr>
        <tr>
        <td align=left>5. Competencia Profesional para la Función</td>
        <td align=center>'.$item5.'</td>
        </tr>
        <tr>
        <td align=left>6. Creatividad</td>
        <td align=center>'.$item6.'</td>
        </tr>
        <tr>
        <td align=left>7. Resolver Problemas</td>
        <td align=center>'.$item7.'</td>
        </tr>
        <tr>
        <td align=left>8. Interés por el Trabajo</td>
        <td align=center>'.$item8.'</td>
        </tr>
        <tr>
        <td align=left>9. Actitud Formativa</td>
        <td align=center>'.$item9.'</td>
        </tr>
        <tr>
        <td align=left>10. Capacidad Analítica</td>
        <td align=center>'.$item10.'</td>
        </tr>
        <tr>
        <td align=left>11. Capacidad de Asesoramiento e Información</td>
        <td align=center>'.$item11.'</td>
        </tr>
         <tr>
        <td align=left>12. Adaptabilidad</td>
        <td align=center>'.$item12.'</td>
        </tr>
      </tbody>
  </table><hr>
              
        <h3>Puntaje Total Obtenido: <strong>'.$sum.'</strong></h3><hr>
        <h3>Calificación Final: <strong>'.$result.'<strong></h3><hr>';
        
        if($result == "Regular" || $result == "Deficiente"){
        
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo '<img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> Ante dicha Calificación deberá utilizar el Formulario B. Por favor completelo accediendo desde el botón aquí abajo';
		echo '<hr><a href="../evaluaciones/formularioB.php" class="btn btn-primary btn-sm " ><span class="glyphicon glyphicon-list-alt"></span> Formulario B</a>';
		echo "</div>";
		echo "</div>";
		
	  
        }
        
        echo '</div>
        <div class="panel-footer">
        <p style="text-align: center;""><strong>IMPORTANTE</strong></p><hr>
        <p>1. En caso que el agente haya obtenido una calificación "Regular" o "Deficiente" se deberá adjuntar el Formulario B con el Programa de Recuperación</p>
        <p>2. Los Agentes que hayan tenido sanciones disciplinarias en el período evaluado y/o en algunos de los factores evaluados haya obtenidos subtotal de "0" o "1", no pueden calificar con "Muy Bueno" o "Destacado"</p>
        
        </div>
      </div>
    </div>
    
   
  </div>
</div>';

}


/////////////////////////////// SECCION FORMULARIO 3 RESULTADOS ///////////////////////////////////

/*
** Funcion que carga el formulario de resultados Formulario 3 Medio con personal a cargo
*/
function resultadoForm3($nombre_agente,$item1,$item2,$item3,$item4,$item5,$item6,$item7,$item8,$item9,$item10,$item11,$item12,$sum,$result,$f_desde,$f_hasta){


   echo '<div class="container-fluid">    
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Resultado Evaluación Agente: '.$nombre_agente.'</div>
        <div class="panel-body">
                
        <h2>Período Evaluado Desde: <strong>'.$f_desde.'</strong> Hasta: <strong>'.$f_hasta.'</strong></h2>
        <p>Puntajes obtenidos en cada Item</p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th class="text-nowrap text-center">Item</th>
        <th class="text-nowrap text-center">Puntaje</th>
        </tr>
    </thead>
    <tbody>
      <tr>
        <td align=left>1. Planificación</td>
        <td align=center>'.$item1.'</td>
        </tr>
      <tr>
        <td align=left>2. Gestión y Control de Programas y Planes</td>
        <td align=center>'.$item2.'</td>
        </tr>
      <tr>
        <td align=left>3. Organización</td>
        <td align=center>'.$item3.'</td>
        </tr>
        <tr>
        <td align=left>4. Conducción</td>
        <td align=center>'.$item4.'</td>
        </tr>
        <tr>
        <td align=left>5. Competencia para la Función</td>
        <td align=center>'.$item5.'</td>
        </tr>
        <tr>
        <td align=left>6. Iniciativa</td>
        <td align=center>'.$item6.'</td>
        </tr>
        <tr>
        <td align=left>7. Resolver Problemas</td>
        <td align=center>'.$item7.'</td>
        </tr>
        <tr>
        <td align=left>8. Interés por el Trabajo</td>
        <td align=center>'.$item8.'</td>
        </tr>
        <tr>
        <td align=left>9. Actitud Formativa</td>
        <td align=center>'.$item9.'</td>
        </tr>
        <tr>
        <td align=left>10. Comunicación</td>
        <td align=center>'.$item10.'</td>
        </tr>
        <tr>
        <td align=left>11. Colaboración</td>
        <td align=center>'.$item11.'</td>
        </tr>
         <tr>
        <td align=left>12. Adaptabilidad</td>
        <td align=center>'.$item12.'</td>
        </tr>
      </tbody>
  </table><hr>
              
        <h3>Puntaje Total Obtenido: <strong>'.$sum.'</strong></h3><hr>
        <h3>Calificación Final: <strong>'.$result.'<strong></h3><hr>';
        
        if($result == "Regular" || $result == "Deficiente"){
        
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo '<img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> Ante dicha Calificación deberá utilizar el Formulario B. Por favor completelo accediendo desde el botón aquí abajo';
		echo '<hr><a href="../evaluaciones/formularioB.php" class="btn btn-primary btn-sm " ><span class="glyphicon glyphicon-list-alt"></span> Formulario B</a>';
		echo "</div>";
		echo "</div>";
		
	  
        }
        
        echo '</div>
        <div class="panel-footer">
        <p style="text-align: center;""><strong>IMPORTANTE</strong></p><hr>
        <p>1. En caso que el agente haya obtenido una calificación "Regular" o "Deficiente" se deberá adjuntar el Formulario B con el Programa de Recuperación</p>
        <p>2. Los Agentes que hayan tenido sanciones disciplinarias en el período evaluado y/o en algunos de los factores evaluados haya obtenidos subtotal de "0" o "1", no pueden calificar con "Muy Bueno" o "Destacado"</p>
        
        </div>
      </div>
    </div>
    
   
  </div>
</div>';

}


/////////////////////////////// SECCION FORMULARIO 4 RESULTADOS ///////////////////////////////////
/*
** Funcion que carga el formulario de resultados Formulario 4 Medio con personal a cargo
*/
function resultadoForm4($nombre_agente,$item1,$item2,$item3,$item4,$item5,$item6,$item7,$item8,$item9,$item10,$sum,$result,$f_desde,$f_hasta){


   echo '<div class="container-fluid">    
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Resultado Evaluación Agente: '.$nombre_agente.'</div>
        <div class="panel-body">
                
        <h2>Período Evaluado Desde: <strong>'.$f_desde.'</strong> Hasta: <strong>'.$f_hasta.'</strong></h2>
        <p>Puntajes obtenidos en cada Item</p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th class="text-nowrap text-center">Item</th>
        <th class="text-nowrap text-center">Puntaje</th>
        </tr>
    </thead>
    <tbody>
      <tr>
        <td align=left>1. Competencia Profesional para la Función</td>
        <td align=center>'.$item1.'</td>
        </tr>
      <tr>
        <td align=left>2. Creatividad</td>
        <td align=center>'.$item2.'</td>
        </tr>
      <tr>
        <td align=left>3. Resolver Problemas</td>
        <td align=center>'.$item3.'</td>
        </tr>
        <tr>
        <td align=left>4. Cumplimiento con el Trabajo</td>
        <td align=center>'.$item4.'</td>
        </tr>
        <tr>
        <td align=left>5. Capacidad Analítica</td>
        <td align=center>'.$item5.'</td>
        </tr>
        <tr>
        <td align=left>6. Capacidad de Asesoramiento</td>
        <td align=center>'.$item6.'</td>
        </tr>
        <tr>
        <td align=left>7. Actitud Formativa</td>
        <td align=center>'.$item7.'</td>
        </tr>
        <tr>
        <td align=left>8. Interés por el Trabajo</td>
        <td align=center>'.$item8.'</td>
        </tr>
        <tr>
        <td align=left>9. Colaboración</td>
        <td align=center>'.$item9.'</td>
        </tr>
        <tr>
        <td align=left>10. Adaptabilidad</td>
        <td align=center>'.$item10.'</td>
        </tr>
       </tbody>
  </table><hr>
              
        <h3>Puntaje Total Obtenido: <strong>'.$sum.'</strong></h3><hr>
        <h3>Calificación Final: <strong>'.$result.'<strong></h3><hr>';
        
        if($result == "Regular" || $result == "Deficiente"){
        
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo '<img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> Ante dicha Calificación deberá utilizar el Formulario B. Por favor completelo accediendo desde el botón aquí abajo';
		echo '<hr><a href="../evaluaciones/formularioB.php" class="btn btn-primary btn-sm " ><span class="glyphicon glyphicon-list-alt"></span> Formulario B</a>';
		echo "</div>";
		echo "</div>";
		
	  
        }
        
        echo '</div>
        <div class="panel-footer">
        <p style="text-align: center;""><strong>IMPORTANTE</strong></p><hr>
        <p>1. En caso que el agente haya obtenido una calificación "Regular" o "Deficiente" se deberá adjuntar el Formulario B con el Programa de Recuperación</p>
        <p>2. Los Agentes que hayan tenido sanciones disciplinarias en el período evaluado y/o en algunos de los factores evaluados haya obtenidos subtotal de "0" o "1", no pueden calificar con "Muy Bueno" o "Destacado"</p>
        
        </div>
      </div>
    </div>
    
   
  </div>
</div>';

}


/////////////////////////////// SECCION FORMULARIO 5 RESULTADOS ///////////////////////////////////
/*
** Funcion que carga el formulario de resultados Formulario 5 Operativo con personal a cargo
*/
function resultadoForm5($nombre_agente,$item1,$item2,$item31,$item32,$item33,$item4,$item5,$item6,$sum,$result,$f_desde,$f_hasta){


   echo '<div class="container-fluid">    
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Resultado Evaluación Agente: '.$nombre_agente.'</div>
        <div class="panel-body">
                
        <h2>Período Evaluado Desde: <strong>'.$f_desde.'</strong> Hasta: <strong>'.$f_hasta.'</strong></h2>
        <p>Puntajes obtenidos en cada Item</p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th class="text-nowrap text-center">Item</th>
        <th class="text-nowrap text-center">Puntaje</th>
        </tr>
    </thead>
    <tbody>
      <tr>
        <td align=left>1. Organización</td>
        <td align=center>'.$item1.'</td>
        </tr>
      <tr>
        <td align=left>2. Supervisión</td>
        <td align=center>'.$item2.'</td>
        </tr>
      <tr>
        <td align=left>3.1 Cantidad de Trabajo</td>
        <td align=center>'.$item31.'</td>
        </tr>
        <tr>
        <td align=left>3.2 Calidad de Trabajo</td>
        <td align=center>'.$item32.'</td>
        </tr>
        <tr>
        <td align=left>3.3 Manejo de Recursos</td>
        <td align=center>'.$item33.'</td>
        </tr>
        <tr>
        <td align=left>4. Conocimiento de las Tareas</td>
        <td align=center>'.$item4.'</td>
        </tr>
        <tr>
        <td align=left>5. Criterio</td>
        <td align=center>'.$item5.'</td>
        </tr>
        <tr>
        <td align=left>6. Colaboración</td>
        <td align=center>'.$item6.'</td>
        </tr>
       </tbody>
  </table><hr>
              
        <h3>Puntaje Total Obtenido: <strong>'.$sum.'</strong></h3><hr>
        <h3>Calificación Final: <strong>'.$result.'<strong></h3><hr>';
        
        if($result == "Regular" || $result == "Deficiente"){
        
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo '<img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> Ante dicha Calificación deberá utilizar el Formulario B. Por favor completelo accediendo desde el botón aquí abajo';
		echo '<hr><a href="../evaluaciones/formularioB.php" class="btn btn-primary btn-sm " ><span class="glyphicon glyphicon-list-alt"></span> Formulario B</a>';
		echo "</div>";
		echo "</div>";
		
	  
        }
        
        echo '</div>
        <div class="panel-footer">
        <p style="text-align: center;""><strong>IMPORTANTE</strong></p><hr>
        <p>1. En caso que el agente haya obtenido una calificación "Regular" o "Deficiente" se deberá adjuntar el Formulario B con el Programa de Recuperación</p>
        <p>2. Los Agentes que hayan tenido sanciones disciplinarias en el período evaluado y/o en algunos de los factores evaluados haya obtenidos subtotal de "0" o "1", no pueden calificar con "Muy Bueno" o "Destacado"</p>
        
        </div>
      </div>
    </div>
    
   
  </div>
</div>';

}


/////////////////////////////// SECCION FORMULARIO 6 RESULTADOS ///////////////////////////////////
/*
** Funcion que carga el formulario de resultados Formulario 6 Operativo sin personal a cargo
*/
function resultadoForm6($nombre_agente,$item11,$item12,$item13,$item2,$item3,$item4,$sum,$result,$f_desde,$f_hasta){


   echo '<div class="container-fluid">    
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Resultado Evaluación Agente: '.$nombre_agente.'</div>
        <div class="panel-body">
                
        <h2>Período Evaluado Desde: <strong>'.$f_desde.'</strong> Hasta: <strong>'.$f_hasta.'</strong></h2>
        <p>Puntajes obtenidos en cada Item</p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th class="text-nowrap text-center">Item</th>
        <th class="text-nowrap text-center">Puntaje</th>
        </tr>
    </thead>
    <tbody>
      <tr>
        <td align=left>1.1 Cantidad de Trabajo</td>
        <td align=center>'.$item11.'</td>
        </tr>
      <tr>
        <td align=left>1.2 Calidad de Trabajo</td>
        <td align=center>'.$item12.'</td>
        </tr>
      <tr>
        <td align=left>1.3 Manejo de Recursos</td>
        <td align=center>'.$item13.'</td>
        </tr>
        <tr>
        <td align=left>2. Conocimientos de las Tareas</td>
        <td align=center>'.$item2.'</td>
        </tr>
        <tr>
        <td align=left>3. Criterio</td>
        <td align=center>'.$item3.'</td>
        </tr>
        <tr>
        <td align=left>4. Colaboración</td>
        <td align=center>'.$item4.'</td>
        </tr>
       </tbody>
  </table><hr>
              
        <h3>Puntaje Total Obtenido: <strong>'.$sum.'</strong></h3><hr>
        <h3>Calificación Final: <strong>'.$result.'<strong></h3><hr>';
        
        if($result == "Regular" || $result == "Deficiente"){
        
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo '<img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> Ante dicha Calificación deberá utilizar el Formulario B. Por favor completelo accediendo desde el botón aquí abajo';
		echo '<hr><a href="../evaluaciones/formularioB.php" class="btn btn-primary btn-sm " ><span class="glyphicon glyphicon-list-alt"></span> Formulario B</a>';
		echo "</div>";
		echo "</div>";
		
	  
        }
        
        echo '</div>
        <div class="panel-footer">
        <p style="text-align: center;""><strong>IMPORTANTE</strong></p><hr>
        <p>1. En caso que el agente haya obtenido una calificación "Regular" o "Deficiente" se deberá adjuntar el Formulario B con el Programa de Recuperación</p>
        <p>2. Los Agentes que hayan tenido sanciones disciplinarias en el período evaluado y/o en algunos de los factores evaluados haya obtenidos subtotal de "0" o "1", no pueden calificar con "Muy Bueno" o "Destacado"</p>
        
        </div>
      </div>
    </div>
    
   
  </div>
</div>';

}



/////////////////////// SECCION LISTADO DE EVALUACIONES /////////////////////

function eval1($conn){

if($conn){
	
	$sql = "SELECT * FROM evaluaciones1";
    	mysqli_select_db('siseval');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="alert alert-success">
	      <img src="../../icons/apps/preferences-contact-list.png"  class="img-reponsive img-rounded"> Evaluaciones Nivel 1 - Gerencial
	      </div><br>';
	
            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Nombre y Apellido</th>
            <th class='text-nowrap text-center'>CUIL/DNI</th>
            <th class='text-nowrap text-center'>Nivel y Grado</th>
            <th class='text-nowrap text-center'>Situación Revista</th>
            <th class='text-nowrap text-center'>Nivel</th>
            <th class='text-nowrap text-center'>Puntaje</th>
            <th class='text-nowrap text-center'>Calificación</th>
            <th class='text-nowrap text-center'>Fecha Desde</th>
            <th class='text-nowrap text-center'>Fecha Hasta</th>
            <th class='text-nowrap text-center'>Estado</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['agente']."</td>";
			 echo "<td align=center>".$fila['dni']."</td>";
			 echo "<td align=center>".$fila['nivel_grado']."</td>";
			 echo "<td align=center>".$fila['revista']."</td>";
			 echo "<td align=center>".$fila['nivel']."</td>";
			 echo "<td align=center>".$fila['puntaje']."</td>";
			 echo "<td align=center>".$fila['calificacion']."</td>";
			 echo "<td align=center>".$fila['f_desde']."</td>";
			 echo "<td align=center>".$fila['f_hasta']."</td>";
			 echo "<td align=center>".$fila['estado']."</td>";
			 echo "<td class='text-nowrap'>";
			 if($fila['estado'] == 'abierta'){
                echo '<a href="../evaluaciones/estado.php?id='.$fila['id'].' & nivel='.$fila['nivel'].'" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-refresh"></span> Cambiar Estado</a>';
			 }
			 if($fila['estado'] == 'cerrada'){
                echo '<a href="../evaluaciones/verEvaluacion1.php?id='.$fila['id'].'" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-eye-open"></span> Ver Evaluación</a>';
			 }
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<button type="button" class="btn btn-primary">Cantidad de Registros:  ' .$count; echo '</button>';
		echo '<hr>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}



function eval6($conn){

if($conn){
	
	$sql = "SELECT * FROM evaluaciones6";
    	mysqli_select_db('siseval');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="alert alert-success">
	      <img src="../../icons/apps/preferences-contact-list.png"  class="img-reponsive img-rounded"> Evaluaciones Nivel 6 - Opertivo sin personal a Cargo
	      </div><br>';
	
            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Nombre y Apellido</th>
            <th class='text-nowrap text-center'>CUIL/DNI</th>
            <th class='text-nowrap text-center'>Nivel y Grado</th>
            <th class='text-nowrap text-center'>Situación Revista</th>
            <th class='text-nowrap text-center'>Nivel</th>
            <th class='text-nowrap text-center'>Puntaje</th>
            <th class='text-nowrap text-center'>Calificación</th>
            <th class='text-nowrap text-center'>Fecha Desde</th>
            <th class='text-nowrap text-center'>Fecha Hasta</th>
            <th class='text-nowrap text-center'>Estado</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['agente']."</td>";
			 echo "<td align=center>".$fila['dni']."</td>";
			 echo "<td align=center>".$fila['nivel_grado']."</td>";
			 echo "<td align=center>".$fila['revista']."</td>";
			 echo "<td align=center>".$fila['nivel']."</td>";
			 echo "<td align=center>".$fila['puntaje']."</td>";
			 echo "<td align=center>".$fila['calificacion']."</td>";
			 echo "<td align=center>".$fila['f_desde']."</td>";
			 echo "<td align=center>".$fila['f_hasta']."</td>";
			 echo "<td align=center>".$fila['estado']."</td>";
			 echo "<td class='text-nowrap'>";
			 if($fila['estado'] == 'abierta'){
                echo '<a href="../evaluaciones/estado.php?id='.$fila['id'].' & nivel='.$fila['nivel'].'" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-refresh"></span> Cambiar Estado</a>';
			 }
			 if($fila['estado'] == 'cerrada'){
                echo '<a href="../evaluaciones/verEvaluacion6.php?id='.$fila['id'].'" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-eye-open"></span> Ver Evaluación</a>';
			 }
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<button type="button" class="btn btn-primary">Cantidad de Registros:  ' .$count; echo '</button>';
		echo '<hr>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}


////////////////////////// SECCION VER EVALUACIONES ///////////////////////

/*
** Funcion que carga el formulario de resultados Formulario 1 Gerencial
*/
function verEval1($id,$conn){
    
    $sql = "select * from evaluaciones1 where id = '$id'";
    mysqli_select_db('siseval');
	$query = mysqli_query($conn,$sql);
	$fila = mysqli_fetch_assoc($query);


   echo '<div class="container-fluid">    
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Resultado Evaluación Agente: '.$fila['agente'].'</div>
        <div class="panel-body">
                
        <h2>Período Evaluado Desde: <strong>'.$fila['f_desde'].'</strong> Hasta: <strong>'.$fila['f_hasta'].'</strong></h2>
        <p>Puntajes obtenidos en cada Item</p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th class="text-nowrap text-center">Item</th>
        <th class="text-nowrap text-center">Puntaje</th>
        </tr>
    </thead>
    <tbody>
      <tr>
        <td align=left>1. Planificación</td>
        <td align=center>'.$fila['item1'].'</td>
        </tr>
      <tr>
        <td align=left>2. Gestión de Planes y Programas</td>
        <td align=center>'.$fila['item2'].'</td>
        </tr>
      <tr>
        <td align=left>3. Control de Resultados</td>
        <td align=center>'.$fila['item3'].'</td>
        </tr>
        <tr>
        <td align=left>4.1. Organizar el Trabajo</td>
        <td align=center>'.$fila['item41'].'</td>
        </tr>
        <tr>
        <td align=left>4.2. Resolver Problemas</td>
        <td align=center>'.$fila['item42'].'</td>
        </tr>
        <tr>
        <td align=left>5. Conducción</td>
        <td align=center>'.$fila['item5'].'</td>
        </tr>
        <tr>
        <td align=left>6.1. Asumir la Representación</td>
        <td align=center>'.$fila['item61'].'</td>
        </tr>
        <tr>
        <td align=left>6.2. Cerrar Transacciones</td>
        <td align=center>'.$fila['item62'].'</td>
        </tr>
        <tr>
        <td align=left>7.1. Interpretación</td>
        <td align=center>'.$fila['item71'].'</td>
        </tr>
        <tr>
        <td align=left>7.2. Maximizar Oportunidades</td>
        <td align=center>'.$fila['item72'].'</td>
        </tr>
        <tr>
        <td align=left>8. Iniciativa</td>
        <td align=center>'.$fila['item8'].'</td>
        </tr>
        <tr>
        <td align=left>9. Adaptabilidad</td>
        <td align=center>'.$fila['item9'].'</td>
        </tr>
        <tr>
        <td align=left>10. Autonomía</td>
        <td align=center>'.$fila['item10'].'</td>
        </tr>
        <tr>
        <td align=left>11. Identificación con la Organización</td>
        <td align=center>'.$fila['item11'].'</td>
        </tr>
    </tbody>
  </table><hr>
              
        <h3>Puntaje Total Obtenido: <strong>'.$fila['puntaje'].'</strong></h3><hr>
        <h3>Calificación Final: <strong>'.$fila['calificacion'].'<strong></h3><hr>';
        
        if($fila['calificacion'] == "Regular" || $fila['calificacion'] == "Deficiente"){
        
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo '<img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> Ante dicha Calificación deberá utilizar el Formulario B. Por favor completelo accediendo desde el botón aquí abajo';
		echo '<hr><a href="../evaluaciones/formularioB.php" class="btn btn-primary btn-sm " ><span class="glyphicon glyphicon-list-alt"></span> Formulario B</a>';
		echo "</div>";
		echo "</div>";
		
	  
        }
        
        echo '</div>
        <div class="panel-footer">
        <p style="text-align: center;""><strong>IMPORTANTE</strong></p><hr>
        <p>1. En caso que el agente haya obtenido una calificación "Regular" o "Deficiente" se deberá adjuntar el Formulario B con el Programa de Recuperación</p>
        <p>2. Los Agentes que hayan tenido sanciones disciplinarias en el período evaluado y/o en algunos de los factores evaluados haya obtenidos subtotal de "0" o "1", no pueden calificar con "Muy Bueno" o "Destacado"</p>
        
        </div>
      </div>
    </div>
    
   
  </div>
</div>';

}


/*
** Funcion que carga el formulario de ver evaluaciones Formulario 6 Operativo sin personal a cargo
*/
function verEval6($id,$conn){
    
    $sql = "select * from evaluaciones6 where id = '$id'";
    mysqli_select_db('siseval');
	$query = mysqli_query($conn,$sql);
	$fila = mysqli_fetch_assoc($query);

   echo '<div class="container-fluid">    
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Resultado Evaluación Agente: '.$fila['agente'].'</div>
        <div class="panel-body">
                
        <h2>Período Evaluado Desde: <strong>'.$fila['f_desde'].'</strong> Hasta: <strong>'.$fila['f_hasta'].'</strong></h2>
        <p>Puntajes obtenidos en cada Item</p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th class="text-nowrap text-center">Item</th>
        <th class="text-nowrap text-center">Puntaje</th>
        </tr>
    </thead>
    <tbody>
      <tr>
        <td align=left>1.1 Cantidad de Trabajo</td>
        <td align=center>'.$fila['item11'].'</td>
        </tr>
      <tr>
        <td align=left>1.2 Calidad de Trabajo</td>
        <td align=center>'.$fila['item12'].'</td>
        </tr>
      <tr>
        <td align=left>1.3 Manejo de Recursos</td>
        <td align=center>'.$fila['item13'].'</td>
        </tr>
        <tr>
        <td align=left>2. Conocimientos de las Tareas</td>
        <td align=center>'.$fila['item2'].'</td>
        </tr>
        <tr>
        <td align=left>3. Criterio</td>
        <td align=center>'.$fila['item3'].'</td>
        </tr>
        <tr>
        <td align=left>4. Colaboración</td>
        <td align=center>'.$fila['item4'].'</td>
        </tr>
       </tbody>
  </table><hr>
              
        <h3>Puntaje Total Obtenido: <strong>'.$fila['puntaje'].'</strong></h3><hr>
        <h3>Calificación Final: <strong>'.$fila['calificacion'].'<strong></h3><hr>';
        
        if($fila['calificacion'] == "Regular" || $fila['calificacion'] == "Deficiente"){
        
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo '<img src="../../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> Ante dicha Calificación deberá utilizar el Formulario B. Por favor completelo accediendo desde el botón aquí abajo';
		echo '<hr><a href="../evaluaciones/formularioB.php" class="btn btn-primary btn-sm " ><span class="glyphicon glyphicon-list-alt"></span> Formulario B</a>';
		echo "</div>";
		echo "</div>";
		
	  
        }
        
        echo '</div>
        <div class="panel-footer">
        <p style="text-align: center;""><strong>IMPORTANTE</strong></p><hr>
        <p>1. En caso que el agente haya obtenido una calificación "Regular" o "Deficiente" se deberá adjuntar el Formulario B con el Programa de Recuperación</p>
        <p>2. Los Agentes que hayan tenido sanciones disciplinarias en el período evaluado y/o en algunos de los factores evaluados haya obtenidos subtotal de "0" o "1", no pueden calificar con "Muy Bueno" o "Destacado"</p>
        
        </div>
      </div>
    </div>
    
   
  </div>
</div>';

}



?>
