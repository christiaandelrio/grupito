<?php session_start();?>
<?php require_once("inc/bbdd.php"); ?>
<?php $pagina = "Mis datos";
	  $titulo = "Mis Datos";
?>
<?php require_once("inc/funciones.php"); ?>
<?php if(!isset($_SESSION["login"])){
	header("Location:index.php");
}

?>
<?php require_once("inc/encabezado.php"); ?>

<?php 

	$usuario = seleccionarDatos($_SESSION["login"]);
	
	$email=$usuario["email"];
	$nombre=$usuario["nombre"];
	$apellidos=$usuario["apellidos"];
	$direccion=$usuario["direccion"];
	$telefono=$usuario["telefono"];
	
?>	
 <div class="jumbotron">
    <div class="container">
      <h1 class="display-3" >Tus datos</h1>
    </div>
  </div>

  <div class="container">
	<table class="table">
	  <thead class="thead-dark">
		<tr>
		  <th scope="col">Email</th>
		  <th scope="col">Nombre</th>
		  <th scope="col">Apellidos</th>
		  <th scope="col">Dirección</th>
		  <th scope="col">Teléfono</th>
		</tr>
	  </thead>
	  <tbody>
		<tr>

		  <td><?php echo $email; ?></td>
		  <td><?php echo $nombre; ?></td>
		  <td><?php echo $apellidos; ?></td>
		  <td><?php echo $direccion; ?></td>
		  <td><?php echo $telefono; ?></td>

		</tr>
	  </tbody>
	</table>
	<a href="actualizarusuario.php" class="btn btn-dark"  role="button" >Actualizar datos</a>
  </div>
  
<?php require_once("inc/pie.php");?>