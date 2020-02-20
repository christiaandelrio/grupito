<?php session_start();?>
<?php 
	  require_once("inc/funciones.php");
	  require_once("inc/funciones.php"); 

	  $pagina ="carrito";
	  $titulo= "Tu pedido";
	  
	  require_once("inc/encabezado.php");
	 

	  if(!isset($_SESSION["login"])){
		  header("index.php");
	  }
?>