<?php
include "global/config.php";
include "global/conexion.php";
include "carrito.php";

?>

<?php

//print_r($_GET);

$ClientID="ASXcwEbySV_wzhh1kvnK2sWIgmbQq1o9mVcj8fQxnD5IdA_E3-bb8uK5ckWbtCM7L6pR09bE0bn_FAuV";
$Secret="EBdm3m7W7fSYZODnk2wiYQM_YFPoCdZxxMlGxpOOJf8LYhKd5N0NzbpNaif8U1My6prkMnnYyd38EGTB";

	$Login = curl_init("https://api.sandbox.paypal.com/v1/oauth2/token");

	curl_setopt($Login, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($Login, CURLOPT_USERPWD,$ClientID.":".$Secret);
	curl_setopt($Login, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

	$Respuesta=curl_exec($Login);

	

	$objRespuesta=json_decode($Respuesta); //decodificar para  trasformarlo en un objeto y recoger el toekn

	$AccessToken=$objRespuesta->access_token; //este token sirve para acceder a la infromacion de la venta

	//print_r($AccessToken);

	$venta = curl_init("https://api.sandbox.paypal.com/v1/payments/payment/".$_GET['paymentID']); //consultar la informacion de ese pago
	
	curl_setopt($venta, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer ".$AccessToken)); //enviar datos para que nos de informacion de esa venta
	curl_setopt($venta, CURLOPT_SSL_VERIFYPEER, TRUE);
	curl_setopt($venta, CURLOPT_RETURNTRANSFER, TRUE);
	$RespuestaVenta=curl_exec($venta);
	
	//print_r($RespuestaVenta);

	$objDatosTransaccion=json_decode($RespuestaVenta);

	//print_r($objDatosTransaccion->payer->payer_info->email); //convertimos en un objeto

	$state=$objDatosTransaccion->state;
	$email =$objDatosTransaccion->payer->payer_info->email;
	$total = $objDatosTransaccion->transactions[0]->amount->total;
	$currency = $objDatosTransaccion->transactions[0]->amount->currency;
	$custom = $objDatosTransaccion->transactions[0]->custom;

	$clave = explode("#", $custom); //valor qeu buscamos
	$SID = $clave[0]; //antes del comodin
	$claveVenta = openssl_decrypt($clave[1], COD, KEY); //quitamos la encriptacion

	curl_close($venta);
	curl_close($Login);

	//validar si el pago es aprobado

	//echo $state;

	if ($state=="approved") {
	$mensajePaypal = "<h3>Pago Realizado Con Exito</h3>";

	$sentencia=$pdo->prepare("UPDATE `tblventas` SET `PaypalDatos` =:PaypalDatos, `status` = 'aprobado' WHERE `tblventas`.`ID` =:ID;");
	$sentencia->bindParam(":ID",$claveVenta);
	$sentencia->bindParam(":PaypalDatos",$RespuestaVenta);
	$sentencia->execute();

	//con estos valores validamos que el total y el id sean de la transaccion
	$sentencia=$pdo->prepare("UPDATE `tblventas` SET `status` ='completo' WHERE ClaveTransaccion=:ClaveTransaccion AND Total=:TOTAL AND ID =:ID;");
	$sentencia->bindParam(":ClaveTransaccion",$SID);
	$sentencia->bindParam(":TOTAL",$total);
	$sentencia->bindParam(":ID",$claveVenta);
	$sentencia->execute();

	$completado=$sentencia->rowCount();
	unset($_SESSION['CARRITO']);
}else{
	$mensajePaypal = "<h3>Hay un problema con el pago de paypal</h3>";
}
//echo $mensajePaypal;
//echo $mensajePaypal." ".$SID." ".$claveVenta." ".$total;

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
  <nav aria-label="breadcrumb" class="hadow-sm">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Carrito</li>
  </ol>
</nav>

<div class="jumbotron container">
	<h1 class="display-4">¡Conseguido!</h1>
	<hr class="my-4">
	<p class="lead"><?php echo $mensajePaypal; ?></p>
	<p>
	<div class="p-2 bd-highlight"><img class="mt-1 mb-1 p-2 bd-highlight" width="440" height="250" src="imagenes/itempago.png"></div>
	<a href="index.php">Volver atras</a>
	</p>
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