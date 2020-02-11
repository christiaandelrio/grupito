<?php session_start(); ?>
<?php require_once("inc/bbdd.php"); ?>
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
	  
	  <div class="form-group">
		<label for="nombre">Nombre:</label>
		<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre;?>"/>
	  </div>
	  
	  <div class="form-group">
		<label for="apellidos">Apellidos:</label>
		<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $apellidos;?>"/>
	  </div>
	  

	 <button type="submit" class="btn btn-secondary" name="enviar" value="Enviar">Enviar</button>
	 <a class="btn btn-primary " href="registro.php">Crear un usuario</a>
	</form>
</main>
<?php } ?>