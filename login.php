<?php session_start(); ?>
<?php require_once("inc/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>
<?php $pagina="Login";
	  $titulo="Identifícate";
?>
<?php require_once("inc/encabezado.php"); ?>
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
		<input type="password" class="form-control" id="password" name="password" value="<?php echo $password;?>"/>
	  </div>
	  

	 <button type="submit" class="btn btn-secondary" name="enviar" value="Enviar">Enviar</button>
	 <a class="btn btn-primary " href="registro.php">Crear un usuario</a>
	</form>
</main>
<?php } ?>
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
				  
			mostrarFormulario($email,$password);
		}
		
		else{
			$email = seleccionarUsuario($email,$password);
			$userOk= password_verify($password,$email["password"]);
			
			if($userOk){
				$_SESSION["login"]=$email["email"];
				header("Location:index.php");
			}
			else{
				echo "Error al loguearte";
				mostrarFormulario($email,$password);
			}
		}
	}
	

?>

<?php require_once("inc/pie.php"); ?>





