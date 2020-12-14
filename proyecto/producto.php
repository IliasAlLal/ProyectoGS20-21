
<?php

include 'global/config.php';
include 'global/conexion.php'; 
include 'carrito.php';
include 'conexion.php';


?>
<!doctype html>
<html lang="en">
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>


  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <title>Home</title>
  <!--<style type="text/css">
    .d-block{
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 100%;
      height: 100%;
    }
    .carousel-control-prev-icon,


    .carousel-control-next-icon:after
    {
      margin-right: 119%;
      content: '>';
      font-size: 55px;
      color: red;
    }

    .carousel-control-prev-icon:after {
      content: '<';
      font-size: 55px;
      color: red;
    }
  </style>-->
<link href="css/csspro.css" rel="stylesheet" >
</head>
<body>

 <?php
 include 'navcon.php';
 ?>
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Productos</li>
  </ol>
</nav>
<?php if($mensaje!="") {?>
  <div class="alert alert-success"> <!--este mensaje cambiara cuando el usuario ponga algo en el carrito-->
    <?php echo $mensaje; ?>  
    <a href="mostrarCarrito.php" class="badge badge-success">Ver carrito</a>
  </div>
<?php } ?>

<?php
$idproducto = $_REQUEST['idproducto'];
$sentencia=$pdo->prepare("SELECT * FROM productos WHERE ID='$idproducto'");
$sentencia->execute();
$listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
      //print_r($listaProductos);
?>

<?php foreach($listaProductos as $producto){ ?>


  <div class="container mt-5">
    <a href="index.php">Volver atras</a>
  </div>
  <div class="container my-2 shadow p-3 mb-5 bg-white rounded">



    <div class="row">
      <div class="col-12 col-sm-5">
       <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img width="800" height="800" class="d-block" src="imagenes/<?php echo $producto['Imagen']; ?>" alt="First slide">
          </div>
          <div class="carousel-item">
            <img  width="800" height="800" class="d-block" src="imagenes/<?php echo $producto['Imagen2']; ?>" alt="Second slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">

          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">

          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>

    <div class="col-12 col-sm-7">
      <h2><?php echo $producto['Nombre']; ?></h2>
      <h1 style="color:orange;"><?php echo $producto['Precio']; ?> €</h1>
      <?php
      $productoid = $producto['id'];
      $resultado = mysqli_query($conn, "SELECT AVG(rango) as avg FROM likes WHERE post='$idproducto'");
      if($resultado){
        $row = mysqli_fetch_assoc($resultado);
        echo "<br>";
        if($row['avg']<=1&& $row['avg']>0){
          echo "<img width='17%' height='5%' src='https://cdn.discordapp.com/attachments/753403948194332733/782742731491377182/unknown.png'>";
        }else if($row['avg']>1 && $row['avg']<=2){
          echo "<img width='17%' height='5%' src='https://cdn.discordapp.com/attachments/753403948194332733/782742831001370634/unknown.png' >";
        }else if($row['avg']>2 && $row['avg']<=3){
          echo" <img width='17%' height='5%' src='https://cdn.discordapp.com/attachments/753403948194332733/782742961778982973/unknown.png'>";
        }else if($row['avg']>3 && $row['avg']<=4){
         echo" <img width='17%' height='5%' src='https://cdn.discordapp.com/attachments/753403948194332733/782743064900927498/unknown.png'>";
       }else if($row['avg']>4 && $row['avg']<=5){
        echo"<img width='17%' height='5%' src='https://cdn.discordapp.com/attachments/753403948194332733/782743166717132830/unknown.png'>";
      }else{
        echo "<small><i><b>SIN VOTACIONES AÚN</b></i></small>";
      }

    }else{
      echo 0;
    }?>
    <?php
    $contarcomentarios = $conn->query("SELECT * FROM comentarios WHERE publicacion = '".$idproducto."'");
    $ccomentarios = $contarcomentarios->num_rows;
    $usuarioactual = $_SESSION['user'];
    $contarlikes = $conn->query("SELECT * FROM likes WHERE post = '".$idproducto."'");
    $clikes = $contarlikes->num_rows;
    ?>
    <small id="contador"><?php echo $clikes;  ?> han votado | <?php echo $ccomentarios;  ?> opiniones</small> 
    <h4 class="mt-3">Descripción</h4> 
    <h6><?php echo $producto['Descripcion']; ?></h6>
    <div class="row mt-3">
      <div class="col-5">
        <form action="" method="post">

          <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['id'], COD, KEY); ?>">
          <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['Nombre'], COD, KEY); ?>">
          <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio'], COD, KEY); ?>">
          <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">

          <button  name="btnAccion" value="Agregar" type="submit" class="btn btn-primary">Agregar al carrito</button>

        </form>

      </div>
    </div>

  </div>
  <div class="row ml-4 mt-4">
   <form id="evaluarr" action="" method="POST">


     <?php 
     $usuarioactual = $_SESSION['user'];
     $sqllike = "SELECT * FROM likes WHERE usuario='$usuarioactual' AND post='$idproducto'";
     $resultlike = $conn->query($sqllike);
     if ($resultlike->num_rows > 0) { ?>  
      <div class="col-12"><b>No puedes votar de nuevo</b>         
        <div style="cursor: not-allowed"><img width='10%' height='10%' src='https://cdn.discordapp.com/attachments/753403948194332733/782743166717132830/unknown.png'></div>
      <?php } else {  ?>
        <div class="col-12"><b>Valorar artículo:</b>
         <div class="rateyo mt-1 mb-1" id= "rating".
         data-rateyo-rating="5"
         data-rateyo-num-stars="5"
         data-rateyo-score ="3">
       </div>
       <input type="hidden" name="usuariol" value="<?php echo $_SESSION['user'];?>" id="usuariol">
       <input type="hidden" name="postl" id="postl" value="<?php echo $producto['id'];?>">
       <input type="hidden" name="rating" id="nota">
       <?php 
       $usuarionow = $_SESSION['user'];
          //echo $_SESSION['user'];
       $sql = "SELECT * FROM likes WHERE usuario='$usuarionow' AND post='$idproducto'";
       $result = $conn->query($sql);
       if ($result->num_rows > 0) { ?>           
        <div></div>
      <?php } else {  ?>
       <input type="submit" value="Enviar" class=" mt-2 btn btn-warning" name="enviar">  
       <div id="noti"></div>
     <?php }
     ?>
   </form>
 </div>
<?php }
?>

</div>
<div class="row">
  <div class="col-12 ml-4 mt-4"><h5><b>Opiniones</b></h5></div>
  <div class='col-12 mt-3'>                                          
    <form method='post' action='' id="enviardatos">  

      <div class='col-12'>
        <label id="record-<?php echo $producto['id'];?>">
          <input type="text" class="enviar-btn form-control input-sm" style="width: 1100px;" placeholder="Escribe un comentario" name="comentario" id="comentario-<?php  echo $producto['id'];?>"  required>
          <input type="hidden" name="usuario" value="<?php echo $_SESSION['user'];?>" id="usuario">
          <input type="hidden" name="publicacion" value="<?php echo $producto['id'];?>" id="publicacion">
          <input type="hidden" name="nombre" value="<?php echo $_SESSION['user'];?>" id="nombre">
        </div>


      </form>
      <div id="nuevocomentario<?php  echo $producto['id'];?>"></div>                       
    </div>
  </div>
</div>
<?php
$sentencia1=$pdo->prepare("SELECT * FROM comentarios WHERE publicacion='$idproducto' ORDER BY id DESC");
$sentencia1->execute();
$listaComentarios=$sentencia1->fetchAll(PDO::FETCH_ASSOC);
      //print_r($listaProductos);
?>

<?php foreach($listaComentarios as $comentario){ ?>
  <div class='col-12'>
    <hr style='width:75%;'>
    <div class='row'>
      <div class='col-12'>
        <div class='row'>
          <div class='col-12' style='text-align:left;'>
            <small><i><b><?php  echo $comentario['usuario'];?></b></i></small>
          </div>
        <!-- <div class="row">
            <div class="col">
                <?php //echo "<b>" . $comentario['usuario'] . "</b>" . " ·\t" . "<small>" . $comentario['fecha'] . "</small>" ;  
                    //if($comentario['nota']<=1&& $comentario['nota']>0){?>
                        <img width="30%" height="100%"  src="https://cdn.discordapp.com/attachments/753403948194332733/782742731491377182/unknown.png">
                    <?php   
                    //}else if($comentario['nota']<=2&& $comentario['nota']>1){?>
                        <img width="30%" height="100%"  src="https://cdn.discordapp.com/attachments/753403948194332733/782742831001370634/unknown.png">
                    <?php 
                   // }else if($comentario['nota']<=3&& $comentario['nota']>2){?>
                        <img width="30%" height="100%"  src="https://cdn.discordapp.com/attachments/753403948194332733/782742961778982973/unknown.png">
                    <?php 
                   // }else if($comentario['nota']<=4&& $comentario['nota']>3){?>
                        <img width="30%" height="100%"  src="https://cdn.discordapp.com/attachments/753403948194332733/782743064900927498/unknown.png">
                    <?php 
                   // }else{?>
                        <img width="30%" height="100%"  src="https://cdn.discordapp.com/attachments/753403948194332733/782743166717132830/unknown.png">
                    //<?php 
                   // }
                  //?>
            </div>
        </div>
      -->
      <div class='col-12' style='text-align:left;'>
        <small style='color:#A9A9A9;'>
          <?php  echo $comentario['fecha'];?></small>
        </div>
        <div class='col-12' style='text-align:left;'>
          <small><?php  echo $comentario['comentario'];?></small>
          <hr style='width:75%;'>
        </div>
      </div>
    </div>
  </div>
</div>

<?php  }  ?>
</div>
</div>
<?php  }  ?>
    <?php
  include "footer.php";
  ?>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="scripts.js"></script>
</body>
</html>