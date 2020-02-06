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
	function imprimirFormulario($nombre, $introDescripcion,$descripcion,$imagen,$precio,$precioOferta){
?>

<form action="" method="POST" enctype="multipart/form-data" >
  <div class="form-group">
    <label for="nombre">Nombre:</label>
    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre;?>"/>
  </div>
  <div class="form-group">
    <label for="intro">introDescripcion:</label>
    <input type="text" class="form-control" id="intro" name="intro" value="<?php echo $introDescripcion;?>"/>
  </div>
  <div class="form-group">
    <label for="descripcion">Descripcion:</label>
    <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $descripcion;?>"/>
  </div>
  <div class="form-group">
    <label for="imagen">Imagen:</label>
    <input type="file" class="form-control" id="imagen" name="imagen" value="<?php echo $imagen;?>"/>
  </div>
  <div class="form-group">
    <label for="precio">Precio:</label>
    <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $precio;?>"/>
  </div>
  <div class="form-group">
    <label for="precioOferta">PrecioOferta:</label>
    <input type="text" class="form-control" id="precioOferta" name="precioOferta" value="<?php echo $precioOferta;?>"/>
  </div>

 <button type="submit" class="btn btn-secondary" name="enviar" value="Enviar">Enviar</button>
 
</form>

<?php } ?>

<main role="main" class="container">

    <h1 class="mt-5">Crear un nuevo producto</h1>

<?php 

if(!isset($_REQUEST['enviar'])){ 
	$nombre = "";
	$introDescripcion = "";
	$descripcion = "";
	$imagen = "";
	$precio = "";
	$precioOferta ="";


	imprimirFormulario($nombre, $introDescripcion,$descripcion,$imagen,$precio,$precioOferta);

}
else{
	$nombre = recoge("nombre");
	$introDescripcion = recoge("intro");
	$descripcion = recoge("descripcion");
	$imagen = recoge("imagen");
	$precio = recoge("precio");
	$precioOferta = recoge("precioOferta");
		
	$errores="";
	
	if($nombre == ""){
		$errores = $errores."<li>El campo nombre no puede estar vacío</li>";
	}
	
	if($errores != ""){
		echo "<h2>Errores</h2><ul>$errores</ul>";
		
		imprimirFormulario($nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta);
	}
	
	else{
		insertarProducto($nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta);
		/*$archivo = $_FILES['archivo'];
					$nombre  = $archivo['name'];
					$tipo 	 = $archivo['type'];
					$tamaño	 = $archivo['size'];
		move_uploaded_file($archivo['tmp_name'],"imagenes/".$nombre);
		echo "<h2>Imagen $nombre subida correctamente</h2>";*/
		
	}

}

?>



<?php require_once "inc/pie.php"; ?>