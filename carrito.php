<?php session_start();?>
<?php require_once("inc/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php 
	$pagina = "Carrito";
	$titulo = "Tu cesta";
?>
<?php require_once("inc/encabezado.php"); ?>

<?php 
	if(empty($_SESSION['carrito'])){
		$mensaje="Carrito vacío";
		mostrarMensaje($mensaje);
	}
	else{
?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Tu carrito</h1>
      <p >La tienda con las mejores ofertas de internet que podrás compartir con tu amigos.</p>
      <p><a class="btn btn-primary btn-lg" href="productos.php" role="button">Seguir comprando »</a></p>
    </div>
  </div>
<div class="container">
<div class="row px-5">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Producto</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Precio</th>
      <th scope="col">SubTotal</th>
    </tr>
  </thead>
  <tbody>
<?php $total=0;?>
<?php 
	
	foreach($_SESSION['carrito'] as $id=>$cantidad){
		$producto = seleccionarProducto($id);
		
		$nombre = $producto['nombre'];
		$precio = $producto['precioOferta'];
		$subtotal = $precio*$cantidad;
		
		$total=$total+$subtotal;
?>

    <tr>
      <td scope="col"><?php echo $nombre; ?></td>
      <td scope="col"><a class="fas fa-minus-circle" href="procesarCarrito.php?id=<?php echo $id; ?>&op=remove"> </a><?php echo  $cantidad ;?><a class="fas fa-plus-circle" href="procesarCarrito.php?id=<?php echo $id; ?>&op=add"></a></td>
      <td scope="col"><?php echo $precio;?></td>
      <td scope="col"><?php echo $subtotal;?></td>
    </tr>

<?php	}
?>
  </tbody>

<?php 
	
?>

  <tfoot>
	<tr>
      <th scope="row" colspan="3" class="text-right">Total</th>
	  <td><?php echo $total;?></td>
    </tr>
  </tfoot>
</table>

<a href="procesarCarrito.php?id=<?php echo "$id";?>&op=empty" class="btn btn-danger">Vaciar carrito</a>
<a href="confirmarPedido.php" class="btn btn-success ml-3">Confirmar pedido</a>

<?php 
	$_SESSION['total']=$total;
?>

</div>
</div>
<?php } ?>
</main>
<?php require_once("inc/pie.php"); ?>
