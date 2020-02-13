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
	$usuario = seleccionarDatos($email,$password,$nombre, $apellidos, $direccion, $telefono);
	
	foreach($usuario as $user){
		echo $user;
	}
?>

<?php require_once("inc/pie.php");?>