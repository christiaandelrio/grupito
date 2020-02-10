<?php session_start(); ?>
<?php require_once("inc/funciones.php"); ?>

<?php 
	function imprimirFormulario($email, $password){
?>
<main role="main" class="container">
	<form action="" method="POST" enctype="multipart/form-data" >
	  <div class="form-group">
		<label for="email">Email:</label>
		<input type="text" class="form-control" id="email" name="email" value="<?php echo $email;?>"/>
	  </div>
	  
	  <div class="form-group">
		<label for="password">Contraseña:</label>
		<input type="text" class="form-control" id="password" name="password" value="<?php echo $password;?>"/>
	  </div>
	  

	 <button type="submit" class="btn btn-secondary" name="enviar" value="Enviar">Enviar</button>
	 
	</form>
</main>
<?php } ?>
<?php require_once("inc/encabezado.php"); ?>
<?php if(empty($_REQUEST)){
		$email = "";
		$password = "";
		imprimirFormulario($email,$password);
	}
	
	else{
		$email = recoge("email");
		$password = recoge("password");
		
		$errores = "";
		
		if($email == ""){
			$errores = $errores."<li>El email no puede estar vacío</li>";
		}
		
		if($password == ""){
			$errores = $errores."<li>La password no puede estar vacía</li>";
		}
		
		if($errores != ""){
			echo "<ul>
					$errores
				  </ul>";
		}
	}
	

?>

<?php require_once("inc/pie.php"); ?>





