<?php session_start(); ?>
<?php require_once("inc/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>
<?php $pagina="Registro";
	  $titulo="Regístrate";
?>
<?php require_once("inc/encabezado.php"); ?>
<?php 
	function mostrarFormulario($email, $password,$nombre,$apellidos,$direccion,$telefono){
?>
<main role="main" class="container">
	<form action="" method="POST" enctype="multipart/form-data" >
	  <div class="form-group">
		<label for="email">Email:</label>
		<input type="text" class="form-control" id="email" name="email" value="<?php echo $email;?>"/>
	  </div>
	  
	  <div class="form-group">
		<label for="password">Contraseña:</label>
		<input type="password" class="form-control" id="password" name="password" value="<?php echo $password;?>"/>
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
	 <button type="submit" class="btn btn-secondary" name="guardar" value="Enviar">Enviar</button>
	 <a class="btn btn-primary " href="login.php">Volver al login</a>
	</form>
</main>
<?php } ?>

<?php if(!isset($_REQUEST['guardar'])){ 
	$email="";
	$password="";
	$nombre="";
	$apellidos="";

	$direccion="";
	$telefono="";

	mostrarFormulario($email, $password, $nombre, $apellidos, $direccion, $telefono);
}
else{
	$email=recoge("email");
	$password=recoge("password");
	$nombre=recoge("nombre");
	$apellidos=recoge("apellidos");
	$direccion=recoge("direccion");
	$telefono=recoge("telefono");
	
	$errores="";
	
	//Validar reCaptcha

		$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify'; 
		$recaptcha_secret = CLAVE_SECRETA; 
		$recaptcha_response = recoge('recaptcha_response'); 
		$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response); 
		$recaptcha = json_decode($recaptcha); 

		if($recaptcha->score < 0.7){

		  // código para procesar los campos y enviar el form
			$errores = $errores."<li>Detectado robot</li>";
		} 


	
	if($email == ""){
		$errores = $errores."<li>El campo email no puede estar vacío</li>";
	}
	
	if($password == ""){
		$errores = $errores."<li>El campo contraseña no puede estar vacío</li>";
	}
	
	if($nombre == ""){
		$errores = $errores."<li>El campo nombre no puede estar vacío</li>";
	}

	if($apellidos == ""){
		$errores = $errores."<li>El campo apellidos no puede estar vacío</li>";
	}
	if($direccion == ""){
		$errores = $errores."<li>El campo dirección no puede estar vacío</li>";
	}
	if($telefono == ""){
		$errores = $errores."<li>El campo teléfono no puede estar vacío</li>";
	}
	if($errores != ""){
		echo "<h2>Errores</h2><ul>$errores</ul>";
		
		mostrarFormulario($email, $password, $nombre, $apellidos, $direccion, $telefono);
	}
	
	else{
		$password = password_hash($password, PASSWORD_DEFAULT );
		$email = insertarUsuario($email, $password, $nombre, $apellidos, $direccion, $telefono);
		
		if($email != ""){
			echo "<div class='alert alert-success' role='alert'>Usuario $email registrado correctamente </div>";
			echo "<p><a href='index.php' class='btn btn-secondary'>Volver al inicio</a></p>";
		}
		else{
			echo "<div class='alert alert-danger' role='alert'>A simple danger alert—check it out! </div>ERROR: Usuario NO registrado";
			mostrarFormulario($email, $password);
		}
	}
}

?>
<?php require_once("inc/pie.php"); ?>