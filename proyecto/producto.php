 <?php
  session_start();
  $idproducto = $_REQUEST['id'];
  ?>
<!doctype html>
<html lang="en">
<head>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

 <title>Home</title>
<style type="text/css">
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
</style>

</head>
<body>

  <?php
  
  include 'global/config.php';
  include 'global/conexion.php';
  include 'conexion.php';
  ?>



  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">


        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="user.png" height="26">Mi cuenta
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="configuracion.php">Configuración</a>
            <a class="dropdown-item" href="">Tu tienda</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="desconectarse.php">Desconectarse</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>



  <?php
  $sentencia=$pdo->prepare("SELECT * FROM productos WHERE ID='$idproducto'");
  $sentencia->execute();
  $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
      //print_r($listaProductos);
  ?>

  <?php foreach($listaProductos as $producto){ ?>



   <div class="container my-5 shadow p-3 mb-5 bg-white rounded">



    <div class="row">
      <div class="col-3">
       <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img width="600" height="600" class="d-block" src="<?php echo $producto['Imagen']; ?>" alt="First slide">
          </div>
          <div class="carousel-item">
            <img  width="600" height="600" class="d-block" src="<?php echo $producto['Imagen2']; ?>" alt="Second slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>

    <div class="col-9">
      <h2><?php echo $producto['Nombre']; ?></h2>
      <h1><?php echo $producto['Precio']; ?>€</h1>
      <img width="10%" src="estrellas.jpg">
      <?php
       $contarcomentarios = $conn->query("SELECT * FROM comentarios WHERE publicacion = '".$idproducto."'");
       $ccomentarios = $contarcomentarios->num_rows;
      ?>
      <small id="contador"><?php echo $ccomentarios;  ?> comentarios</small> 
      <h4>Descripción</h4> 
      <h6><?php echo $producto['Descripcion']; ?></h6>
      <div class="row mt-3">
        <div class="col-5">
          <button type="button" class="btn btn-warning">
            <img width="3%" src="carrito.webp">
            Añadir al carrito
          </button>
          <a href="index.php">Volver atras</a>
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-12 ml-4 mt-4"><h3>Comentarios</h3></div>
      <div class='col-12 mt-3'>                                          
        <form method='post' action=''>                        
          <div class='col-12'>
            <label id="record-<?php echo $producto['id'];?>">
              <input type="text" class="enviar-btn form-control input-sm" style="width: 1100px;" placeholder="Escribe un comentario" name="comentario" id="comentario-<?php  echo $producto['id'];?>">
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
<?php  }  ?>
            
            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
            <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <script src="scripts.js"></script>
          </body>
          </html>