<?php
//requerimos de conexion a la base de datos para poder usar el php
require "conexion.php";
session_start();

//hacemos la consulta para poder obtener el resultadode la query
$query = "SELECT * FROM productos";
//verifica si el buscador no esta vacio
if(isset($_POST['consulta'])){
			//convierte los datos obtenidos mediante post
	$q= $conn->real_escape_string($_POST['consulta']);
          //se realiza la querry compara lo que as escrito en el buscador con la base de datos y te da el resultado
	$query = "SELECT * FROM productos WHERE Nombre LIKE '%".$q."%'";
}

//ejecuta la querry anteriormente realizada
$resultmostrar = $conn->query($query);
//comprueba si no se a iniciado la sesion de usuario
if(!isset($_SESSION['user'])){
	//comprueba si hay algun articulo en la base de dato relacionado con la busqueda 
	if ($resultmostrar->num_rows > 0) {
	 //mientra haya una concordancia en la base de datos con el nombre que se introdusca en la base de datos se realizara lo siguiente 
		while($producto=$resultmostrar->fetch_assoc()){ ?>


			<!--se muestra en html el contenido de la base de datos con respecto al articulo buscado -->
			<div class="col-xs-12 col-lg-3 mt-5 ml-4">
				<div class="card" style="width: 18rem;">
					<img title="<?php echo $producto['Nombre']; ?>" alt="<?php echo $producto['Nombre']; ?>" src="imagenes/<?php echo $producto['Imagen'] ?>" class="card-img-top" data-toggle="popover" data-trigger="hover"data-content="<?php echo $producto['Descripcion']; ?>" height="317px">
					<div class="card-body">
						<span><?php echo $producto['Nombre']; ?></span>
						<h5 class="card-title"><?php echo $producto['Precio']; ?> €</h5>

						<form action="" method="post">

							<input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY); ?>">
							<input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['Nombre'], COD, KEY); ?>">
							<input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio'], COD, KEY); ?>">
							<input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">
						</form>

					</div>
				</div>
			</div> 
		<?php   } } 
		//En caso de no encontrar el articulo en la base de datos se mostrara el siguiente div
		else { 
			echo"<div style='color:black;'class='col-12 my-5'>No hay resultados</div>";
		}
		//comprueba si el usuario esta reguistrado
}elseif($_SESSION['user'] != 'admin'){
	//comprueba si hay algun articulo en la base de dato relacionado con la busqueda
	if ($resultmostrar->num_rows > 0) {
	 	//mientra haya una concordancia en la base de datos con el nombre que se introdusca en la base de datos se realizara lo siguiente 
		while($producto=$resultmostrar->fetch_assoc()){ ?>


			<!--se muestra en html el contenido de la base de datos con respecto al articulo buscado -->
			<div class="col-xs-12 col-lg-3 mt-5 ml-4">
				<div class="card" style="width: 18rem;">
					<img title="<?php echo $producto['Nombre']; ?>" alt="<?php echo $producto['Nombre']; ?>" src="imagenes/<?php echo $producto['Imagen'] ?>" class="card-img-top" data-toggle="popover" data-trigger="hover"data-content="<?php echo $producto['Descripcion']; ?>" height="317px">
					<div class="card-body">
						<span><?php echo $producto['Nombre']; ?></span>
						<h5 class="card-title"><?php echo $producto['Precio']; ?> €</h5>

						<form action="" method="post">

							<input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY); ?>">
							<input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['Nombre'], COD, KEY); ?>">
							<input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio'], COD, KEY); ?>">
							<input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">

							<?php echo"<a href='producto.php?idproducto=".$producto['id']."' class='btn btn-info btn-sm'> Ver producto </a>";?>
						</form>

					</div>
				</div>
			</div> 
		<?php   } }
		//En caso de no encontrar el articulo en la base de datos se mostrara el siguiente div
		 else { 
			echo"<div style='color:black;'class='col-12 my-5'>No hay resultados</div>";
		}

} 
		?>