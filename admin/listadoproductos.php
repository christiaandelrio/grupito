<?php session_start(); ?>
<?php require_once "inc/bbdd.php"; ?>
<?php require_once "inc/encabezado.php"; ?>
<?php require_once "inc/funciones.php"; ?>

<main role="main" class="container">

    <h1 class="mt-5">Listado de productos</h1>
	
	<p><a href='añadirproducto.php' class='btn btn-dark'>Nuevo producto</a></p>
	
	<?php 
		$productos = seleccionarProductos();
		
		
		$numProductos = count($productos);
		$productosPagina = 2;
		$paginas = ceil($numProductos/$productosPagina); //redondear al alza
		
		$pagina = recoge("pagina"); //para saber en qué página estoy
		
		if($pagina==false OR $pagina<=0 OR $pagina>$paginas){
			$pagina=1;
		}
		
		
		$inicio = ($pagina-1)*$productosPagina;
		$productos = paginacionProductos($inicio, $productosPagina);
	?>
	
	<table class="table table-striped table-dark">
	  <thead>
		<tr>
		  <th scope="col">Nombre</th>
		  <th scope="col">introDescripción</th>
		  <th scope="col">Descripción</th>
		  <th scope="col">Imagen</th>	
		  <th scope="col">Precio</th>
		  <th scope="col">Precio Oferta</th>
		  
		</tr>
	  </thead>
	  <tbody>
		<?php 
			foreach($productos as $producto){
				$product = $producto['nombre'];
				$intro = $producto['introDescripcion'];
				$descripcion = $producto['descripcion'];
				$imagen = $producto['imagen'];
				$precio = $producto['precio'];
				$precioOferta = $producto['precioOferta'];

		 ?>	
		<tr>
		  <td><?php echo $product; ?></td>
		  <td><?php echo $intro; ?></td>
		  <td><?php echo $descripcion; ?></td>
		  <td><img height="155" width="200" src="imagenes/<?php echo $imagen; ?>"></img></td>
		  <td><?php echo $precio; ?></td>
		  <td><?php echo $precioOferta; ?></td>

		  <td><a class='btn btn-secondary' href='actualizarusuario.php?usuario=<?php echo $user;?>' name='actualizar' value='actualizar'>Actualizar</button></td>
		</tr>
		<?php 
		} ?>
	  </tbody>
	</table>
	<a class="btn btn-dark" href="borrarsesion.php" role="button">Cerrar Sesión</a>
	<a class="btn btn-info" href="menu.php" role="button" name="volver" id="volver" value="Volver al menú">Volver al menú</a>


	<nav aria-label="Page navigation example">
	  <ul class="pagination">
		<li class="page-item <?php if($pagina==1){echo 'disabled';} ?>"><a class="page-link" href="listadoproductos.php?pagina=<?php echo $pagina-1; ?>">Anterior</a></li>
		<?php for($i=1;$i<=$paginas;$i++){ ?>
			<li class="page-item <?php if($i==$pagina){echo "active";}?>"><a class="page-link" href="listadoproductos.php?pagina=<?php echo $i;?>"><?php echo $i;?></a></li>
		<?php } ?>
		<li class="page-item <?php if($pagina==$paginas){echo 'disabled';}?>"><a class="page-link" href="listadoproductos.php?pagina=<?php echo $pagina+1;?>">Siguiente</a></li>
	  </ul>
	</nav>
</main>	
<?php require_once "inc/pie.php"; ?>