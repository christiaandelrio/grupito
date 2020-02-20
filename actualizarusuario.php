<?php session_start();?>
<?php require_once("inc/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php 
	$pagina = "Actualizar";
	$titulo = "Actualizar usuario";
?>

<?php require_once("inc/encabezado.php"); ?>
<?php if(!isset($_SESSION["login"])){
	header("Location:index.php");
}?>

<?php 
	function mostrarFormulario($email,$nombre,$apellidos,$direccion,$telefono){
		$usuario=seleccionarDatos($_SESSION["login"]);
		
		$email=$usuario["email"];
		$nombre=$usuario["nombre"];
		$apellidos=$usuario["apellidos"];
		$direccion=$usuario["direccion"];
		$telefono=$usuario["telefono"];
?>
<main role="main" class="container">
	<form action="" method="POST" enctype="multipart/form-data" >
	  <div class="form-group">
		<label for="email">Email:</label>
		<input type="text" class="form-control" id="email" name="email" value="<?php echo $email;?>"/>
	  </div>
	  
	  <div class="form-group">
		<label for="nombre">Nombre:</label>
		<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre;?>"/>
	  </div>
	  
	  <div class="form-group">
		<label for="apellidos">Apellidos:</label>
		<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $apellidos;?>"/>
	  </div>
	  
	  <div class="form-group">
		<label for="direccion">Direccion:</label>
		<input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion;?>"/>
	  </div>
	  
	  <div class="form-group">
		<label for="telefono">Teléfono:</label>
		<input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono;?>"/>
	  </div>
	 <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
	 <button type="submit" class="btn btn-secondary" name="guardar" value="Guardar">Guardar datos</button>

	</form>
</main>
<?php } ?>

<?php 
	if(!isset($_REQUEST['guardar'])){
		$email="";
		$nombre="";
		$apellidos="";
		$direccion="";
		$telefono="";
		
		mostrarFormulario($email,$nombre,$apellidos,$direccion,$telefono);
	}
	
	else{
		$email=recoge("email");
		$nombre=recoge("nombre");
		$apellidos=recoge("apellidos");
		$direccion=recoge("direccion");
		$telefono=recoge("telefono");
		
		$errores="";
		
		if($email == ""){
			$errores=$errores."<li>El campo email no puede estar vacío</li>";
		}
		
		if($nombre == ""){
			$errores=$errores."<li>El campo nombre no puede estar vacío</li>";
		}
		
		if($apellidos == ""){
			$errores=$errores."<li>El campo de los apellidos no puede estar vacío</li>";
		}
		
		if($direccion == ""){
			$errores=$errores."<li>El campo de la dirección no puede estar vacío</li>";
		}
		
		if($telefono == ""){
			$errores=$errores."<li>El campo del teléfono no puede estar vacío</li>";
		}
		
		if($errores != ""){
			echo "<ul>
					$errores	
				  </ul>";
			
			mostrarFormulario($email,$nombre,$apellidos,$direccion,$telefono); 
		}
		
		else{
			$ok= actualizarUsuario($email,$nombre,$apellidos,$direccion,$telefono); 
				if($ok == 1){
					echo "<div class='alert alert-success' role='alert'>Usuario $nombre actualizado correctamente</div>";
					echo "<p><a href='listadousuarioslistadousuarios.php' class='btn btn-secondary'>Volver al listadousuarios</a></p>";
				}
				else{
					echo "<div class='alert alert-danger' role='alert'>ERROR: Usuario NO actualizado</div>";
					mostrarFormulario($email,$nombre,$apellidos,$direccion,$telefono); 
				}
		}
	}
?>