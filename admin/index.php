<?php session_start();
	  require_once "inc/funciones.php"; 
	  require_once "inc/bbdd.php"; 
      require_once "inc/encabezado.php"; 
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Menú</title>
	</head>
	
	<body>
		<main role="main" class="container">
		<h3 class="mt-5">Menú de selección de listados</h3>
		<?php 
			
		?>
		<p>
		
		<div class="card-deck">
		  <div class="card">
			<img src="imagenes/80.jpg" class="card-img-top" alt="...">
			<div class="card-body">
			  <h5 class="card-title">Listado de pedidos</h5>
			  <a class="btn btn-primary" href="listadopedidos.php" role="button">Ir al listado</a>
			</div>
		  </div>
		  <div class="card">
			<img src="imagenes/20.jpg" class="card-img-top" alt="...">
			<div class="card-body">
			  <h5 class="card-title">Listado de usuarios</h5>
			  <a class="btn btn-primary" href="listadousuarios.php" role="button">Ir al listado</a>
			</div>
		  </div>
		  <div class="card">
			<img src="imagenes/2.jpg" class="card-img-top" alt="...">
			<div class="card-body">
			  <h5 class="card-title">Listado de productos</h5>
			  <a class="btn btn-primary" href="listadoproductos.php" role="button">Ir al listado</a>
			</div>
		  </div>
		</div>
		
			
		</p>
		</main>
	</body>
</html>