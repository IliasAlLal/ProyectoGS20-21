<?php
include 'global/config.php';
include 'carrito.php';


?>
<html lang="en">
<head>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

 <body>
</head>
<?php
	include 'navcon.php';
?>
  <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Carrito</li>
  </ol>
</nav>
<!--Nos muestra  el carrito con los acticulos-->
<div class="container" style="margin-top:5%;">
<div class="col-12 mb-5"><h1>Lista del carrito</h1></div>
<?php if(!empty($_SESSION['CARRITO'])) { ?>
<table class="table table-light table-bordered table table-hover ">
	<thead class="thead-dark">
		<tr>
			<th >Descripción</th>
			<th class="text-center"  scope="col">Cantidad</th>
			<th class="text-center" scope="col">Precio</th>
			<th class="text-center">Total</th>
			<th >--</th>
		</tr>
	 </thead>
		<tbody>
		<?php 
		$total=0; 
		?>
		<?php foreach($_SESSION['CARRITO'] as $indice=>$producto){ ?> 
		<tr scope="row">
			<td ><?php echo $producto['NOMBRE']; ?></td>
			<td class="text-center"><?php echo $producto['CANTIDAD']; ?></td>
			<td class="text-center"><?php echo $producto['PRECIO'] ?></td>
			<td class="text-center"><?php echo number_format($producto['PRECIO']*$producto['CANTIDAD'],2); ?></td>


			<form action="" method="post">

				<input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY); ?>">

				<td><button class="btn btn-danger btn-sm" type="submit" name="btnAccion" value="Eliminar">Eliminar</button></td>

			</form>

		</tr>
		<?php $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);?>
		<?php }?>

		<tr style="margin-left: 123213px:">
			
			<td ></td>
			<td ></td>
			<td ></td>
			<td ><h3>TOTAL</h3></td>
			<td ><h3><?php echo number_format($total,2); ?> </h3></td>
		</tr>

		<tr>
			<td colspan="5">
				<form method="post" action="pagar.php">
					<div class="alert alert-success">
						<div class="form-group">
						<label>Correo de contacto: </label><br>
						<input type="email" name="email" id="email" placeholder="Por favor escribe tu correo" required>
					</div>
					<small id="emailHelp" class="form-text text-muted">Los productos se enviarán a este correo</small>
					</div>
					<button class="btn btn-primary btn-lg btn-block" type="submit" value="proceder" name="btnAccion">Proceder a pagar >></button>
				</form>
			</td>
		</tr>
	</tbody>
</table>
<?php }else{ ?>
	<div class="alert alert-danger mt-5 mb-5">
		<p>No hay productos en el carrito.</p>
		<p>Ve a la tienda para comprar los mejores productos de nuestra página web!</p>
	</div>
	<div class="col-12 mt-5">
	</div>
<?php } ?>
</div>
<?php include 'footer.php'; ?>

      <!-- Optional JavaScript; choose one of the two! -->

      <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
      <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <script src="scripts.js"></script>
    </body>
    </html>