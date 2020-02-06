<?php include "configuracion.php"; ?>

<?php
//Función para conectarnos a la base de datos.
function conectarBD(){
	try{
		$con = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=UTF8", USER, PASS);
		
		$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo "Error: Error al conectar la Base de Datos: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $con;
}

//Función para desconectar Base de Datos
function desconectarBD($con){
	$con = NULL;
	return $con;
}

//Función para comprobar usuario
function seleccionarUsuario($usuario){
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM usuarios WHERE usuario=:usuario";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':usuario', $usuario);
		
		$stmt->execute();
		
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	}
		
	catch(PDOException $e){
		echo "Error: Error al comprobar un usuario: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $row;
}

//Función para crear un usuario
function insertarUsuario($usuario,$password){
	$con = conectarBD();
	
	try{
		$sql = "INSERT INTO usuarios (usuario,password) VALUES (:usuario,:password)";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':usuario', $usuario);
		$stmt->bindParam(':password', $password);
		
		$stmt->execute();
		
		
	}
		
	catch(PDOException $e){
		echo "Error: Error al crear un usuario: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $stmt->rowCount();
}

//Función seleccionar todos los usuarios 
function seleccionarTodosUsuarios(){
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM usuarios"; //Primero hacemos la sentencia sql
		
		$stmt = $con->query($sql); //Llamar al método query
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); //Así nos crea un array asociativo
	}
	
	catch(PDOException $e){
		echo "Error: Error al seleccionar todas las tareas: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $rows;
}

//Función para actualizar usuario

function actualizarUsuario($usuario,$password){
	
	$con = conectarBD();
	
	try{
		$sql = "UPDATE usuarios SET usuario=:usuario, password=:password WHERE usuario=:usuario";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':usuario',$usuario);
		$stmt->bindParam(':password',$password);
		
		$stmt->execute();
	}
	catch(PDOException $e){
		echo "Error: Error al actualizar los datos del usuario: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $stmt->rowCount();
}
//Seleccionar productos
function seleccionarProductos(){
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM productos"; //Primero hacemos la sentencia sql
		
		$stmt = $con->query($sql); //Llamar al método query
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); //Así nos crea un array asociativo
	}
	
	catch(PDOException $e){
		echo "Error: Error al seleccionar todas las tareas: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $rows;
}

//Paginación productos
function paginacionProductos($inicio, $productosPagina){
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM productos LIMIT :inicio,:productosPagina"; //Primero hacemos la sentencia sql
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':inicio',$inicio, PDO::PARAM_INT);
		$stmt->bindParam(':productosPagina',$productosPagina,PDO::PARAM_INT);
		
		$stmt->execute();

		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); //Así nos crea un array asociativo
	}
	
	catch(PDOException $e){
		echo "Error: Error al seleccionar todos los usuarios: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $rows;
}
//Función insertar productos
function insertarProducto($nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta){
	$con = conectarBD();
	
	try{
		$sql = "INSERT INTO productos (nombre,introDescripcion,descripcion,imagen,precio,precioOferta) VALUES (:nombre,:introDescripcion,:descripcion,:imagen,:precio,:precioOferta)";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':introDescripcion', $introDescripcion);
		$stmt->bindParam(':descripcion', $descripcion);
		$stmt->bindParam(':imagen', $imagen);
		$stmt->bindParam(':precio', $precio);
		$stmt->bindParam(':precioOferta', $precioOferta);
		
		$stmt->execute();
		
		
	}
		
	catch(PDOException $e){
		echo "Error: Error al crear un producto: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $stmt->rowCount();
}