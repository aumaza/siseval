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
	echo '<div class="container">
	      <div class="alert alert-success">
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
		echo '</div>';
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
	      <h2>Cargar Agente</h2><hr>
	        <form action="../agentes/formNuevoRegistro.php" method="POST">
	        
	        <div class="form-group">
		  <label for="nombre">Nombre y Apellido</label>
		  <input type="text" class="form-control" id="nombre" name="nombre" onKeyDown="limitText(this,60);" required>
		</div>
		
		<div class="form-group">
		  <label for="cuil">CUIL</label>
		  <input type="text" class="form-control" id="cuil" name="cuil" onKeyDown="limitText(this,11);" required>
		</div>
		
		<div class="form-group">
		  <label for="f_nac">Fecha de Nacimiento</label>
		  <input type="date" class="form-control" id="f_nac" name="f_nac" required>
		</div>
		
		<div class="form-group">
		  <label for="nivel_grado">Nivel y Grado</label>
		  <input type="text" class="form-control" id="nivel_grado" name="nivel_grado" onKeyDown="limitText(this,3);" required>
		</div>
		
		<div class="form-group">
		  <label for="sel1">Situación de Revista</label>
		  <select class="form-control" name="revista">
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="Planta Permanente">Planta Permanente</option>
		    <option value="Ley Marco">Ley Marco</option>
		    <option value="Contrato">Contrato</option>
		  </select>
		</div> 
		
		<div class="form-group">
		  <label for="sel1">Sexo:</label>
		  <select class="form-control" name="sexo">
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="Masculino">Masculino</option>
		    <option value="Femenino">Femenino</option>
		  </select>
		  </div>
		
		<div class="form-group">
		  <label for="sel1">Nivel:</label>
		  <select class="form-control" name="nivel">
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="1">Gerencial</option>
		    <option value="2">Medio Profesional/Técnico con personal a cargo</option>
		    <option value="3">Medio con personal a cargo</option>
		    <option value="4">Medio sin personal a cargo</option>
		    <option value="5">Operativo con personal a cargo</option>
		    <option value="6">Operativo sin personal a cargo</option>
		  </select>
		  </div>
		  
		<div class="form-group">
		  <label for="sel1">Funciones Ejecutivas:</label>
		  <select class="form-control" name="func_ejec">
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="Si">Si</option>
		    <option value="No">No</option>
		  </select>
		  </div>
		  
		<div class="form-group">
		  <label for="sel1">Nivel Función Ejecutiva:</label>
		  <select class="form-control" name="niv_func_ejec">
		    <option value="" disabled selected>Seleccionar</option>
		    <option value="0">0</option>
		    <option value="1">1</option>
		    <option value="2">2</option>
		    <option value="3">3</option>
		    <option value="4">4</option>
		  </select>
		</div>
		
		<div class="form-group">
		  <label for="sel1">Sanciones:</label>
		  <select class="form-control" name="sanciones">
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
		    <option value="1" '.($fila['nivel'] == "1" ? "selected" : ""). '>Gerencial</option>
		    <option value="2" '.($fila['nivel'] == "2" ? "selected" : ""). '>Medio Profesional/Técnico con personal a cargo</option>
		    <option value="3" '.($fila['nivel'] == "3" ? "selected" : ""). '>Medio con personal a cargo</option>
		    <option value="4" '.($fila['nivel'] == "4" ? "selected" : ""). '>Medio sin personal a cargo</option>
		    <option value="5" '.($fila['nivel'] == "5" ? "selected" : ""). '>Operativo con personal a cargo</option>
		    <option value="6" '.($fila['nivel'] == "6" ? "selected" : ""). '>Operativo sin personal a cargo</option>
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




function updateAgente($id,$nombre,$cuil,$f_nac,$nivel_grado,$revista,$sexo,$nivel,$func_ejec,$niv_func_ejec,$sanciones,$conn){

		
	mysqli_select_db('siseval');
	$sqlInsert = "update empleados set nombre = '$nombre', cuil = '$cuil', f_nac = '$f_nac', nivel_grado = '$nivel_grado', revista = '$revista', sexo = '$sexo', nivel = '$nivel', sanciones = '$sanciones', funcion_ejec = '$func_ejec', niv_func_ejec = '$niv_func_ejec' where id = '$id'";
           
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
	echo '<div class="container">
	      <div class="alert alert-success">
	      <img src="../../icons/actions/meeting-attending.png"  class="img-reponsive img-rounded"> Agentes
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
			 echo "<td align=center>".$fila['funcion_ejec']."</td>";
			 echo "<td align=center>".$fila['niv_func_ejec']."</td>";
			 echo "<td align=center>".$fila['sanciones']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<a href="../agentes/editar.php?id='.$fila['id'].'" class="btn btn-primary btn-sm " ><span class="glyphicon glyphicon-pencil"></span> Editar</a>';
			 echo '<a href="#" data-href="../agentes/eliminar.php?id='.$fila['id'].'" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Borrar</a>';
			 echo '<a href="../agentes/upload.php?id='.$fila['id'].'" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-cloud-upload"></span> PDF</a>';
			 echo '<a href="../agentes/download.php?file_name='.$fila['file_name'].'" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-cloud-download"></span> PDF</a>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<button type="button" class="btn btn-primary">Cantidad de Registros:  ' .$count; echo '</button>';
		echo '</div><br>';
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

function addAgente($nombre,$cuil,$f_nac,$nivel_grado,$revista,$sexo,$nivel,$func_ejec,$niv_func_ejec,$sanciones,$conn){

		
	mysqli_select_db('siseval');
	$sqlInsert = "INSERT INTO empleados ".
		"(nombre,cuil,f_nac,nivel_grado,revista,sexo,nivel,sanciones,funcion_ejec,niv_func_ejec)".
		"VALUES ".
      "('$nombre','$cuil','$f_nac','$nivel_grado','$revista','$sexo','$nivel','$sanciones','$func_ejec','$niv_func_ejec')";
           
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


?>