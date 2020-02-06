<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/bbdd.php"; ?>
<?php require_once "inc/encabezado.php"; ?>
<?php session_start();
/*
if(!isset($_SESSION["login"])){
	header("Location:index.php");
}*/
 ?>
<?php 
	function imprimirFormulario($email,$password,$nombre,$apellidos,$direccion,$telefono){
?>

<form method="post" >
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
    <label for="direccion">Dirección:</label>
    <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion;?>"/>
  </div>

  <div class="form-group">
    <label for="telefono">Teléfono:</label>
    <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono;?>"/>
  </div>

 <button type="submit" class="btn btn-secondary" name="enviar" value="Enviar">Enviar</button>
 
</form>

<?php } ?>

<main role="main" class="container">

    <h1 class="mt-5">Crear un nuevo usuario</h1>

<?php 

if(!isset($_REQUEST['enviar'])){ 
	$nombre="";
	$password="";


	imprimirFormulario($nombre, $password);
}
else{
	$nombre=recoge("nombre");
	$password=recoge("password");
		
	$errores="";
	
	if($nombre == ""){
		$errores = $errores."<li>El campo nombre no puede estar vacío</li>";
	}
	
	if($password == ""){
		$errores = $errores."<li>El campo de la contraseña no puede estar vacío</li>";
	}

	if($errores != ""){
		echo "<h2>Errores</h2><ul>$errores</ul>";
		
		imprimirFormulario($nombre, $password);
	}
	
	else{
		$password = password_hash($password, PASSWORD_DEFAULT);
		$usuario = insertarUsuario($nombre, $password);
		
		if($usuario != ""){
			echo "<div class='alert alert-success' role='alert'>Usuario creado correctamente</div>";
			echo "<p><a href='menu.php' class='btn btn-secondary'>Ir al menú</a></p>";
		}
		else{
			echo "<div class='alert alert-danger' role='alert'>ERROR: Usuario NO creado</div>";
			imprimirFormulario($nombre, $password);
		}
	}
}

?>



<?php require_once "inc/pie.php"; ?>