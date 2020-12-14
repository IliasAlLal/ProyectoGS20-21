<?php
include "global/config.php";
include "global/conexion.php";
include "carrito.php";


?>

<?php 
	

	if($_POST){

		$total=0;//lo que le vamos a cobrar al usuario
		$SID = session_id();//devuelve una clave de la sesion.. evitamos confusion con otros pedidos
		$Correo =$_POST['email'];

		foreach($_SESSION['CARRITO'] as $indice=>$producto){
			$total=$total+($producto['PRECIO']*$producto['CANTIDAD']);
		}

		$sentencia=$pdo->prepare("INSERT INTO `tblventas` (`ID`, `ClaveTransaccion`, `PaypalDatos`, `Fecha`, `Correo`, `Total`, `status`) VALUES (NULL, :ClaveTransaccion, '', NOW(),:Correo, :Total, 'pendiente');");

		$sentencia->bindParam(":ClaveTransaccion",$SID);
		$sentencia->bindParam(":Correo",$Correo);
		$sentencia->bindParam(":Total",$total);
		$sentencia->execute();

		$idVenta=$pdo->lastInsertId(); //recuperamos el id de venta para que despues hagamos una relacion con la venta y el detalle de la venta
		foreach($_SESSION['CARRITO'] as $indice=>$producto){
			
		
		$sentencia1=$pdo->prepare("INSERT INTO `tbldetalleventa` (`ID`, `IDVENTA`, `IDPRODUCTO`, `PRECIOUNITARIO`, `CANTIDAD`, `DESCARGADO`) VALUES (NULL,:IDVENTA,:IDPRODUCTO,:PRECIOUNITARIO,:CANTIDAD, '0');");

		$sentencia1->bindParam(":IDVENTA",$idVenta);
		$sentencia1->bindParam(":IDPRODUCTO",$producto['ID']);
		$sentencia1->bindParam(":PRECIOUNITARIO",$producto['PRECIO']);
		$sentencia1->bindParam(":CANTIDAD",$producto['CANTIDAD']);
		$sentencia1->execute();
		}


		//se imprime en la pagina pagar.php
	}

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

 <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>

<style>
        /* Media query for mobile viewport */
        @media screen and (max-width: 400px) {
            #paypal-button-container {
                width: 100%;
            }
        }
        
        /* Media query for desktop viewport */
        @media screen and (min-width: 400px) {
            #paypal-button-container {
                width: 250px;
            }
        }
    </style>

<div class="jumbotron container">
	<h1 class="display-4">¡Ya Casi Estamos!</h1>
	<hr class="my-4">
	<p class="lead">Estás a punto de pagar con paypal la cantidad de:
		<h4><?php echo number_format($total,2); ?>€</h4>
		  <div class="mt-4" id="paypal-button-container"></div>
	</p>
		<!--<p>Los productos podrán ser descargados una vez que se procese el pago</p>
		<strong><i>(Para aclaraciones, contacta con nosotros...)</i></strong>-->
</div>





    <!-- Set up a container element for the button -->
  
    <!-- Include the PayPal JavaScript SDK -->
   
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
 <script>
    paypal.Button.render({
        env: 'sandbox', // sandbox | production
        style: {
            label: 'checkout',  // checkout | credit | pay | buynow | generic
            size:  'responsive', // small | medium | large | responsive
            shape: 'pill',   // pill | rect
            color: 'gold'   // gold | blue | silver | black
        },
 
        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create

        client: {
            sandbox:    'Acz02h4D7D4gVDP_N4aMrD11fNFerjQ45w4alpEZxYsCbq3fgQTksSU4h207qU9t_q8-T9K2R_mGbZq5',
            production: ''
        },
 
        // Wait for the PayPal button to be clicked
 
        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '<?php echo $total;?>', currency: 'EUR' },
                            description:"Compra de productos a ComPC",
                            custom:"<?php echo $SID;?>#<?php echo openssl_encrypt($idVenta, COD, KEY);?>"
                        }
                    ]
                }
            });
        },
 
        // Wait for the payment to be authorized by the customer
 
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                console.log(data);
                window.location="verificador.php?paymentToken="+data.paymentToken+"&paymentID="+data.paymentID;
            });
        }
   
    }, '#paypal-button-container');
 
</script>
        
        <?php include 'footer.php'; ?>
      <!-- Optional JavaScript; choose one of the two! -->

      <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
      <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <script src="scripts.js"></script>
    </body>
    </html>
