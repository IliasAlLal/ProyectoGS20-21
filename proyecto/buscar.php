<?php
require "conexion.php";//requerimos de conexion a la base de datos para poder usar el php

//hacemos la consulta para poder obtener el resultadode la query
$query = "SELECT * FROM productos";
//verifica si el buscador no esta vacio
if(isset($_POST['consulta'])){
			//convierte los datos obtenidos mediante post
	$q= $conn->real_escape_string($_POST['consulta']);
          //se realiza la querry compara lo que as escrito en el buscador con la base de datos y te da el resultado
	$query = "SELECT * FROM productos WHERE Nombre LIKE '%".$q."%'";
}


$resultmostrar = $conn->query($query);
if ($resultmostrar->num_rows > 0) { 
	while($producto=$resultmostrar->fetch_assoc()){ ?>



		<div class="col-xs-12 col-lg-3 mt-5 ml-4">
			<div class="card" style="width: 18rem;">
				<img title="<?php echo $producto['Nombre']; ?>" alt="<?php echo $producto['Nombre']; ?>" src="<?php echo $producto['Imagen'] ?>" class="card-img-top" data-toggle="popover" data-trigger="hover"data-content="<?php echo $producto['Descripcion']; ?>" height="317px">
				<div class="card-body">
					<span><?php echo $producto['Nombre']; ?></span>
					<h5 class="card-title"><?php echo $producto['Precio']; ?> €</h5>

					<form action="" method="post">

						<input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY); ?>">
						<input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['Nombre'], COD, KEY); ?>">
						<input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio'], COD, KEY); ?>">
						<input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">

						<?php echo"<a href='producto.php?id=".$producto['id']."' class='btn btn-info btn-sm'> Ver producto </a>";?>

					</form>

				</div>
			</div>
		</div> 
	<?php   } } else { 
		echo"<div style='color:black;'class='col-12 my-5'>No hay resultados</div>";
	} 
	?>