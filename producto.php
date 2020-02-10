
<?php require_once("inc/funciones.php"); ?>

<?php require_once("inc/bbdd.php"); ?>
<?php 
	$idProducto = recoge('id');//recojo el id de la url      producto.php?id=5
	$producto = seleccionarProducto($idProducto);
	//print_r($productos);
	//print_r($producto);
	
	$nombre= $producto['nombre'];
	$idProducto= $producto['idProducto'];
	$introDescripcion= $producto['introDescripcion'];
	$descripcion= $producto['descripcion'];
	$imagen= $producto['imagen'];
	$precio= $producto['precio'];
	$precioOferta= $producto['precioOferta'];

?>
<?php $pagina = "productos";
	  $titulo = $nombre;
?>

<?php require_once("inc/encabezado.php"); ?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3"><?php echo $nombre; ?></h1>
      
      <p><a class="btn btn-primary btn-lg" href="#" role="button">Nuestras ofertas »</a></p>
    </div>
  </div>

  <div class="container">
	
	<div class="row col-10 mx-auto">
		
		<div class="col-6 ">
			<p><?php echo $descripcion; ?></p>
			<div class="col-12 mx-auto d-flex justify-content-center">
				<a href="carrito.php" class="btn btn-success text-justify">Añadir al carrito</a>
			</div>
		</div>
		
		<div class="col-6 ">
		<img src="imagenes/<?php echo $imagen; ?>" alt="<?php echo $nombre; ?>" class="card-img-top rounded"></img>
			<div class="row mt-2 mx-auto">
				<span class="text-danger col-6 text-justify display-4">
					Antes <del><?php echo $precio;?></del>
				</span>
				
				<span class="text-success col-6 text-right display-4">
					Ahora <?php echo $precioOferta;?>
				</span>
			</div>
		</div>
	</div>

  </div> <!-- /container -->

</main>
<?php require_once("inc/pie.php");?>
