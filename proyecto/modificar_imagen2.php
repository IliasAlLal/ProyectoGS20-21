<?php
//Si hay un id en la url luego verificamos si esa id corresponde a un usuario y la mostramos por pantalla


if(empty($_REQUEST['id'])){// verifica si en la url hay un id
	header("location: index.php");//si no lo hay te manda al index
} 
else{
	//y si no guarda el id en una variable
	$idproducto = $_REQUEST['id'];
	//conexion a la base de datois
	include 'conexion.php';

	//si le damos al boton aceptar

	if(!empty($_POST) && is_uploaded_file($_FILES['imag_file2']['tmp_name'])){ //si le damos al boton aceptar
		$alert='';
		if(empty($_POST['idproducto'])) {
			echo "pon todos los campos";
			$alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
		} else{ 
			$idproducto = $_POST['idproducto'];			
			
			$upload_dir="imagenes/";
			

			$imagen2 = $_FILES['imag_file2']['tmp_name'];
			$ruta2 = $_FILES['imag_file2']['name'];
			move_uploaded_file($imagen2,$upload_dir.$ruta2);
	  //recogemos el valor del formulario para recoger el id del usuario
			$sql = "UPDATE productos SET Imagen2='$ruta2' WHERE ID='$idproducto'";


	//$sqlpubli = "DELETE FROM publicaciones WHERE user='$idusuario'"; //tambn borra las publicaciones que tiene

	//hay que borrar mas


	//$conn->query($sqlpubli);
			$result = $conn->query($sql);
			if($result){
				
				$alert = "<div class='alert alert-success' role='alert'>
				Producto actualizado correctamente. <a href='index.php'> Volver</a>
				</div>";
				//echo"<script>location = 'index.php';</script>";

			} else{
				echo"Error al eliminar";
			}
		}
	} 
	$sql = "SELECT * FROM productos WHERE id='$idproducto'"; //el idusuario es para comprobar si existe uno en la tabla
	
	 $result = mysqli_query($conn, $sql);  //se hace la consulta
	 $result1 =mysqli_num_rows($result); //nos devuelve una cantidad de filas

	if($result1>0){ //validamos si nos ha dado esa cantidad de filas
	 	while ($data = mysqli_fetch_array($result)) { //devuelve el resultado de las tablas en array para que podamos trabajar con los datos
	 		$nombreproducto = $data['Nombre'];
	 		$precio = $data['Precio'];
	 		$descripcion = $data['Descripcion'];
	 		$imagen = $data['Imagen'];
	 		$imagen2 = $data['Imagen2'];

	 	}
	 }else{
	 	header("location: index.php");
	 }
	}
	?>

	<!DOCTYPE html>
	<html>
	<head>

		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<meta charset="utf-8">
		
		<title>Eliminar un producto</title>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.php">
         <img class="mt-1 mb-1 col-11" width="440" height="200" src="imagenes/kingphone2.png">

      </a>

  </nav>
		<div class="container mt-5 shadow-lg p-3 mb-5 bg-white rounded" style="background-color: #F5F5F5;text-align:center;">
			<div class="row">
				<div class="col-12 mt-4">
					<h2>Producto "<span><?php echo $nombreproducto;?></span>"</h2>
					<div class="row">
						<div class="col-12 mt-4">
							<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
							<form enctype="multipart/form-data" method="POST"  action="">
								<!-- esto es para conseguir el id del usuario cunado le demos a aceptar-->
								<input type="hidden" name="idproducto" value="<?php echo $idproducto?>">
								
								<!--<div class="form-group row">
									<label for="statictelefono" class="col-sm-2 col-form-label">Imagen</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="imagen" value="<?php echo $imagen?>">
									</div>
								</div>-->
								

								<b>Imagen actual 2</b> 
								
								<div class="col-12 m-3">
									<img id="imgSalida2" src="imagenes/<?php echo $imagen2;?>" width="300" />
								</div>
								<div><b>Subir imagen de producto 2</b></div> 

								<input id="imag_file2" type="file" name="imag_file2" />
								<div class="col-12 m-3">
									<b>Nueva imagen</b>
									<div id="resultadoa2" class=""><img id="imgSalida3" width="300" /></div>
								</div>

								<input type="submit" name="Aceptar" class="btn btn-primary" value="Aceptar">
								<a href="index.php" class="btn btn-danger">Cancelar</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
			<?php include 'footer.php'; ?>
			<script src="scripts.js"></script>
		</body>
		</html>