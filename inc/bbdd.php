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

//Función seleccionar ofertas
function seleccionarOfertasPortada($numOfertas){
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM productos LIMIT :numOfertas";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':numOfertas', $numOfertas, PDO::PARAM_INT);
		
		$stmt->execute();
		$rows= $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}
	catch(PDOException $e){
		echo "Error: Error al seleccionar ofertas: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $rows;
}

//Seleccionar todas ofertas

function seleccionarTodasOfertas(){
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM productos";
		
		$stmt = $con->prepare($sql);
		
		
		$stmt->execute();
		$rows= $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}
	catch(PDOException $e){
		echo "Error: Error al seleccionar ofertas: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $rows;
}

//Seleccionar productos
function seleccionarProducto($idProducto){
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM productos WHERE idProducto=:idProducto";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
		
		$stmt->execute();
		$row= $stmt->fetch(PDO::FETCH_ASSOC);
		
	}
	catch(PDOException $e){
		echo "Error: Error al seleccionar producto: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $row;
}

//Función para crear un usuario
function insertarUsuario($email,$password,$nombre, $apellidos, $direccion, $telefono){
	$con = conectarBD();
	
	try{
		$sql = "INSERT INTO usuarios (email,password,nombre,apellidos,direccion,telefono) VALUES (:email,:password,:nombre,:apellidos,:direccion,:telefono)";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':apellidos', $apellidos);
		$stmt->bindParam(':direccion', $direccion);
		$stmt->bindParam(':telefono', $telefono);
		$stmt->execute();
		
		
	}
		
	catch(PDOException $e){
		echo "Error: Error al crear un usuario: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $stmt->rowCount();
}

//Función para seleccionar usuario
function seleccionarUsuario($email){
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM usuarios WHERE email=:email";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':email', $email);

		
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

//Función para seleccionar los datos de un usuario
function seleccionarDatos($email){
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM usuarios WHERE email=:email";
		
		$stmt = $con->prepare($sql);
		

		$stmt->bindParam(':email', $email);

		
		
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

//Función para insertar pedido
function insertarPedido($idUsuario, $detallePedido, $total){
	$con = conectarBD();
	
	try{
		$con->beginTransaction();
		
		$sql = "INSERT INTO pedidos (idUsuario, total) VALUES (:idUsuario, :total)";
		
		$sentencia = $con->prepare($sql);
		
		$sentencia-> bindParam(":idUsuario",$idUsuario);
		$sentencia-> bindParam(":total",$total);
		
		$sentencia->execute();
		$idPedido = $con->lastInsertId();
		
		foreach($detallePedido as $idProducto=>$cantidad){
			
			$producto = seleccionarProducto($idProducto);
			$precio = $producto['precioOferta'];
			
			$sql2 = "INSERT INTO detallePedido (idPedido, idProducto, cantidad, precio) VALUES (:idPedido, :idProducto, :cantidad, :precio)";
			
			$sentencia = $con->prepare($sql2);
			
			$sentencia-> bindParam(":idPedido",$idPedido);
			$sentencia-> bindParam(":idProducto",$idProducto);
			$sentencia-> bindParam(":cantidad",$cantidad);
			$sentencia-> bindParam(":precio",$precio);
			
			$sentencia->execute();
		}
		$con->commit(); //se hace al final si va todo bien
		
	}
	catch(PDOException $e){
		$con->rollback();//si algo va mal deshago todo
		echo "Error: Error al insertar un pedido: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $idPedido;
	
	
}

//FUNCIÓN PARA ACTUALIZAR LOS DATOS DEL USUARIO
function actualizarUsuario($email,$nombre,$apellidos,$direccion,$telefono){
	$con=conectarBD();
	
	try{
		$sql = "UPDATE usuarios SET email=:email, nombre=:nombre, apellidos=:apellidos, direccion=:direccion, telefono=:telefono WHERE email=:email";
		
		$stmt = $con->prepare($sql);
		

		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':apellidos', $apellidos);
		$stmt->bindParam(':direccion', $direccion);
		$stmt->bindParam(':telefono', $telefono);
		
		
		$stmt->execute();
		
	}
		
	catch(PDOException $e){
		echo "Error: Error al comprobar un usuario: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	
	return $stmt->rowCount();
}
