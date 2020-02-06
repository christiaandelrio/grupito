<?php require_once "inc/bbdd.php"; ?>
<?php require_once "inc/encabezado.php"; ?>

<main role="main" class="container">

    <h1 class="mt-5">Listado de usuarios</h1>
	
	<p><a href='insertarusuario.php' class='btn btn-dark'>Nuevo usuario</a></p>
	
	<?php 
		$usuarios = seleccionarTodosUsuarios();
		//print_r($tareas);
	?>
	
	<table class="table table-striped table-dark">
	  <thead>
		<tr>
		  <th scope="col">Nombre</th>
		  <th scope="col">Contraseña</th>
		</tr>
	  </thead>
	  <tbody>
		<?php 
			foreach($usuarios as $usuario){
				$user = $usuario['usuario'];
				$password = $usuario['password'];
				
		 ?>	
		<tr>
		  <td><?php echo $user; ?></td>
		  <td><?php echo $password; ?></td>
		  <td><a class='btn btn-secondary' href='actualizarusuario.php?usuario=<?php echo $user;?>' name='actualizar' value='actualizar'>Actualizar</button></td>
		</tr>
		<?php 
		} ?>
	  </tbody>
	</table>
	<a class="btn btn-warning" href="borrarsesion.php" role="button">Cerrar Sesión</a>
	<a class="btn btn-info" href="menu.php" role="button" name="volver" id="volver" value="Volver al menú">Volver al menú</a>



</main>	
<?php require_once "inc/pie.php"; ?>