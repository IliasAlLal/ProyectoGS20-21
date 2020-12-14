<!doctype html>
<html lang="en">
<head>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

 <title>KingPhone</title>
 <!--<style type="text/css">
  .tabla {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    text-align: center;
  }

  .tabla td, .tabla th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  .tabla tr:nth-child(even){background-color: #f2f2f2;}

  .tabla tr:hover {background-color: #ddd;}

  .navbar-brand {
    margin-left: 13%;
  }
</style>-->
<link href="css/cssindex.css" rel="stylesheet" >
</head>
<body>
  <?php
  session_start();
  include 'global/config.php';
  include 'global/conexion.php';
  include 'conexion.php';
  //si no eres usuario
  if(!isset($_SESSION['user'])){?>

    <?php
    include 'navcon.php';

    ?>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Inicio</li>
      </ol>
    </nav>
    <section class="col-12">
      <div id="slider-animation" class="carousel slide" data-ride="carousel">

        <!-- Indicadores -->
        <ul class="carousel-indicators">
          <li data-target="#slider-animation" data-slide-to="0" class="active"></li>
          <li data-target="#slider-animation" data-slide-to="1"></li>
          <li data-target="#slider-animation" data-slide-to="2"></li>
        </ul>

        <!-- El Slaider -->
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img id="imagenca1"class="col-12"src="https://cdn.lumingo.com/medias/p30p40-slider-min.jpg?context=bWFzdGVyfGltYWdlc3wzODUxNnxpbWFnZS9qcGVnfGltYWdlcy9oYmQvaDhhLzkzMTIzMDIzMDEyMTQuanBnfDMyN2RjMjgwMjhkOTE1ODc2NWQ5OGU0MzQ4Nzk0YmEwNThjOGY4Y2VkMTFlMDRkMzNmMTNhOTJhMmZjYTE3MTE" alt="Los Angeles">

          </div>
          <div class="carousel-item">
            <img id="imagenca2"class="col-12"src="imagenes/aaa.jpg" alt="Chicago">

          </div>

        </div>

        <!-- Los botones y presion -->
        <a class="carousel-control-prev" href="#slider-animation" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#slider-animation" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>

      </div>

    </section>
    <div class="container-fluid mt-5">
      <div class="row">

        <!-- menu -->
        <div class="col-lg-2 ">
          <h5 class="mb-4">Marcas</h5>

     <!--<div class="row">
      menu 
      <div class="col-lg-2 ">
        <h5 class="mb-4">Marcas</h5>-->


        <div class="list-group list-group-flush" id="list-tab" role="tablist">
          <a class="list-group-item list-group-item-action  list-group-item-light active" id="list-novedades-list" data-toggle="list" href="#list-novedades" role="tab" aria-controls="novedades">Novedades</a>
          <a class="list-group-item list-group-item-action  list-group-item-light" id="list-iphone-list" data-toggle="list" href="#list-iphone" role="tab" aria-controls="iphone">Iphone</a>
          <a class="list-group-item list-group-item-action list-group-item-light" id="list-samsung-list" data-toggle="list" href="#list-samsung" role="tab" aria-controls="samsung">Samsung</a>
          <a class="list-group-item list-group-item-action list-group-item-light" id="list-huawei-list" data-toggle="list" href="#list-huawei" role="tab" aria-controls="huawei">Huawei</a>
        </div>



      </div>
      <div class="col-10">
        <h6 id="titulomovil" class="ml-5">Por Favor Inicie Sesion o Registrese</h6>
        <h2 id="titulomovil" class="ml-5">Últimos artículos</h2>
        <!--<?php if($mensaje!="") {?>-->
        <div class="alert alert-success"> <!--este mensaje cambiara cuando el usuario ponga algo en el carrito-->
          <?php echo $mensaje; ?>  
          <a href="mostrarCarrito.php" class="badge badge-success">Ver carrito</a>
        </div>
      <?php } ?>
      <!--utensilios para vender-->
      <div class="row" id="info" style="margin-left: 5%;">

        <?php
        $sentencia=$pdo->prepare("SELECT * FROM productos");
        $sentencia->execute();
        $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
      //print_r($listaProductos);
        ?>

        <?php foreach($listaProductos as $producto){ ?>
          <div class="novedades">
            <div class="tab-content" id="nav-tabContent">
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
                      <?php echo"<a class='btn btn-info btn-sm' href='#' data-toggle='modal' data-target='#exampleModal'> Añadir al Carrito</a>";?>

                    </form>

                  </div>
                </div>
              </div>
            </div> 
          </div>


        <?php  }  ?>
        <?php 
        $sentenciaiphone=$pdo->prepare("SELECT * FROM productos WHERE marca= 'iphone'");
        $sentenciaiphone->execute();
        $listaProductosiphone=$sentenciaiphone->fetchAll(PDO::FETCH_ASSOC);
        foreach($listaProductosiphone as $producto){ ?>
          <div class="iphone">
            <div class="tab-content" id="nav-tabContent">
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
                      <?php echo"<a class='btn btn-info btn-sm' href='#' data-toggle='modal' data-target='#exampleModal'> Añadir al Carrito</a>";?>

                    </form>

                  </div>
                </div>
              </div>
            </div> 
          </div>


        <?php  }  ?>

        <?php 
        $sentenciaiphone=$pdo->prepare("SELECT * FROM productos WHERE marca= 'samsung'");
        $sentenciaiphone->execute();
        $listaProductosiphone=$sentenciaiphone->fetchAll(PDO::FETCH_ASSOC);
        foreach($listaProductosiphone as $producto){ ?>
          <div class="samsung">
            <div class="tab-content" id="nav-tabContent">
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
                      <?php echo"<a class='btn btn-info btn-sm' href='#' data-toggle='modal' data-target='#exampleModal'> Añadir al Carrito</a>";?>

                    </form>

                  </div>
                </div>
              </div>
            </div> 
          </div>


        <?php  }  ?>

        <?php 
        $sentenciaiphone=$pdo->prepare("SELECT * FROM productos WHERE marca= 'huawei'");
        $sentenciaiphone->execute();
        $listaProductosiphone=$sentenciaiphone->fetchAll(PDO::FETCH_ASSOC);
        foreach($listaProductosiphone as $producto){ ?>
          <div class="huawei">
            <div class="tab-content" id="nav-tabContent">
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
                      <?php echo"<a class='btn btn-info btn-sm' href='#' data-toggle='modal' data-target='#exampleModal'> Añadir al Carrito</a>";?>
                    </form>

                  </div>
                </div>
              </div>
            </div> 
          </div>


        <?php  }  ?>
      </div> 
    </div>
  </div>
</div>
<?php

} elseif($_SESSION['user'] != 'admin'){ ?>
  <?php
  include 'navcon.php';
   //echo "Bienvenido " . $_SESSION['user'] . ", eres un usuario normal";
  ?>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Inicio</li>
    </ol>
  </nav>
  <section class="col-12">
    <div id="slider-animation" class="carousel slide" data-ride="carousel">

      <!-- indicadores -->
      <ul class="carousel-indicators">
        <li data-target="#slider-animation" data-slide-to="0" class="active"></li>
        <li data-target="#slider-animation" data-slide-to="1"></li>
        <li data-target="#slider-animation" data-slide-to="2"></li>
      </ul>

      <!-- El slaider -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img id="imagenca1"class="col-12"src="https://cdn.lumingo.com/medias/p30p40-slider-min.jpg?context=bWFzdGVyfGltYWdlc3wzODUxNnxpbWFnZS9qcGVnfGltYWdlcy9oYmQvaDhhLzkzMTIzMDIzMDEyMTQuanBnfDMyN2RjMjgwMjhkOTE1ODc2NWQ5OGU0MzQ4Nzk0YmEwNThjOGY4Y2VkMTFlMDRkMzNmMTNhOTJhMmZjYTE3MTE" alt="Los Angeles">

        </div>
        <div class="carousel-item">
          <img id="imagenca2"class="col-12"src="imagenes/aaa.jpg" alt="Chicago">

        </div>

      </div>

      <!-- los botones del salider y poder ir a delante y atras -->
      <a class="carousel-control-prev" href="#slider-animation" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#slider-animation" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>

    </div>

  </section>
  <div class="container-fluid mt-5">
    <div class="row">
      <!-- menu -->
      <div class="col-lg-2 ">
        <h5 class="mb-4">Marcas</h5>


        <div class="list-group list-group-flush" id="list-tab" role="tablist">
          <a class="list-group-item list-group-item-action  list-group-item-light active" id="list-novedades-list" data-toggle="list" href="#list-novedades" role="tab" aria-controls="novedades">Novedades</a>
          <a class="list-group-item list-group-item-action  list-group-item-light" id="list-iphone-list" data-toggle="list" href="#list-iphone" role="tab" aria-controls="iphone">Iphone</a>
          <a class="list-group-item list-group-item-action list-group-item-light" id="list-samsung-list" data-toggle="list" href="#list-samsung" role="tab" aria-controls="samsung">Samsung</a>
          <a class="list-group-item list-group-item-action list-group-item-light" id="list-huawei-list" data-toggle="list" href="#list-huawei" role="tab" aria-controls="huawei">Huawei</a>
        </div>



      </div>
      <div class="col-10">

        <h2 id="titulomovil" class="ml-5">Últimos artículos</h2>
        <!--<?php if($mensaje!="") {?>-->

      <?php } ?>
      <!--utensilios para vender-->

      <div class="row" id="info" style="margin-left: 5%;">
       <div class="col-12">
         <select class="mr-5">
          <option id="opcion0">Ordenar por: -</option>
          <option id="opcion1">Precios más altos</option>
          <option id="opcion2">Precio más bajos</option>
        </select>
      </div>

      <?php
      $sentencia=$pdo->prepare("SELECT * FROM productos");
      $sentencia->execute();
      $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
      //print_r($listaProductos);
      ?>

      <?php foreach($listaProductos as $producto){ ?>
        <div class="novedades">
          <div class="tab-content" id="nav-tabContent">
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
          </div> 
        </div>


      <?php  }  ?>
      <?php 
      $sentenciaiphone=$pdo->prepare("SELECT * FROM productos WHERE marca= 'iphone'");
      $sentenciaiphone->execute();
      $listaProductosiphone=$sentenciaiphone->fetchAll(PDO::FETCH_ASSOC);
      foreach($listaProductosiphone as $producto){ ?>
        <div class="iphone">
          <div class="tab-content" id="nav-tabContent">
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
          </div> 
        </div>


      <?php  }  ?>

      <?php 
      $sentenciaiphone=$pdo->prepare("SELECT * FROM productos WHERE marca= 'samsung'");
      $sentenciaiphone->execute();
      $listaProductosiphone=$sentenciaiphone->fetchAll(PDO::FETCH_ASSOC);
      foreach($listaProductosiphone as $producto){ ?>
        <div class="samsung">
          <div class="tab-content" id="nav-tabContent">
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
          </div> 
        </div>


      <?php  }  ?>

      <?php 
      $sentenciaiphone=$pdo->prepare("SELECT * FROM productos WHERE marca= 'huawei'");
      $sentenciaiphone->execute();
      $listaProductosiphone=$sentenciaiphone->fetchAll(PDO::FETCH_ASSOC);
      foreach($listaProductosiphone as $producto){ ?>
        <div class="huawei">
          <div class="tab-content" id="nav-tabContent">
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
          </div> 
        </div>


      <?php  }  ?>
      <?php 
      $sentenciaiphone=$pdo->prepare("SELECT * FROM productos ORDER BY Precio DESC");
      $sentenciaiphone->execute();
      $listaProductosiphone=$sentenciaiphone->fetchAll(PDO::FETCH_ASSOC);
      foreach($listaProductosiphone as $producto){ ?>
        <div class="caros">
          <div class="tab-content" id="nav-tabContent">
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
          </div> 
        </div>


      <?php  }  ?>

      <?php 
      $sentenciaiphone=$pdo->prepare("SELECT * FROM productos ORDER BY Precio ASC");

      $sentenciaiphone->execute();
      $listaProductosiphone=$sentenciaiphone->fetchAll(PDO::FETCH_ASSOC);
      foreach($listaProductosiphone as $producto){ ?>
        <div class="baratos">
          <div class="tab-content" id="nav-tabContent">
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
          </div> 
        </div>


      <?php  }  ?>

      <?php 
      $sentenciaiphone=$pdo->prepare("SELECT * FROM productos");

      $sentenciaiphone->execute();
      $listaProductosiphone=$sentenciaiphone->fetchAll(PDO::FETCH_ASSOC);
      foreach($listaProductosiphone as $producto){ ?>
        <div class="normales">
          <div class="tab-content" id="nav-tabContent">
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
          </div> 
        </div>


      <?php  }  ?>
    </div> 
  </div>
</div>
</div>
<!--<a href="desconectarse.php" class="btn btn-danger btn-sm active" role="button" aria-pressed="true">Desconectarse</a>-->
<?php
//usuario admin
} else{
  ?>
  <?php
  include 'navcon.php';
  ?>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Inicio</li>
    </ol>
  </nav>
  <div class="container">
    <div id="notificacion1"></div>
    <div class="jumbotron mt-3">
      <h1 class="display-4">Bienvenido de Nuevo Administrador</h1>
      <p class="lead">En este panel te permitira administrar tanto Usuarios como Productos en el Panel de control de arriba.</p>
    </div>
  </div>

  <!--<button type="button" class="btn btn-info" id="agregarnuevoprodcuto">Agregar un Producto</button>
  <button type="button" class="btn btn-info" id="agregarnuevousuario">Agregar un Usuario</button> 
  <a href="desconectarse.php" class="btn btn-danger btn-sm active" role="button" aria-pressed="true">Desconectarse</a>-->
  <div id="agregarproducto" class="container">
    <h3>Agregar un producto</h3>
    <div class="form-group">
      <form enctype="multipart/form-data" id="nuevoproductoform" method="post">
        <label for="recipient-name" class="col-form-label"><b>Nombre:</b></label>
        <input type="text" class="form-control" id="nombreaa" name="nombreaa">
      </div>
      <div class="form-group">
        <label for="message-text" class="col-form-label"><b>Precio:</b></label>
        <input type="text" class="form-control" id="precioaa" name="precioaa">
      </div>
      <div class="form-group">
        <label for="message-text" class="col-form-label"><b>Descripcion:</b></label>
        <input type="text" class="form-control" id="descripcionaa" name="descripcionaa">
      </div>
      <div class="form-group">
        <label for="message-text" class="col-form-label"><b>Marca:</b></label>
        <!--<input type="text" class="form-control" id="marcaa" name="marcaa">-->
        <select class="custom-select" id="marcaa" name="marcaa">
          <option selected>Selecciona...</option>
          <option value="iphone">Iphone</option>
          <option value="samsung">Samsung</option>
          <option value="huawei">Huawei</option>
        </select>
      </div>
      <b>Subir imagen de producto</b> 

      <input id="file-inputaa" type="file" name="file-inputaa" />
      <div class="col-12 m-3">
        <div id="resultadoa" class=""><img id="imgSalidaa" width="300" /></div>
      </div>

      <b>Subir imagen de producto 2</b> 

      <input id="file-inputaa1" type="file" name="file-inputaa1" />
      <div class="col-12 m-3">
        <div id="resultadoa1" class=""><img id="imgSalidaa" width="300" /></div>
      </div>
      <input type="submit" name="subirproducto" class="btn btn-primary" value="Agregar un nuevo producto">
    </form>
    <div class="container">
      <h3>Mostrar Los Productos</h3>
      <table class="tabla">
        <tr style="background-color: #CD5C5C;">
          <td><div class="col-12 mb-4" style="font-weight:bold">ID</div></td>
          <td><div class="col-12 mb-4" style="font-weight:bold">Nombre</div></td>
          <td><div class="col-12 mb-4" style="font-weight:bold">Precio</div></td>
          <td><div class="col-md-12 mb-4" style="font-weight:bold">Descripcion</div></td>
          <td><div class="col-md-12 mb-4" style="font-weight:bold">Imagen</div></td>
          <td><div class="col-md-12 mb-4" style="font-weight:bold">Imagen2</div></td>


          <td><div class="col-12 mb-4" style="font-weight:bold">Acciones</div></td>
        </tr>
        <?php 
        $mostrarproducto = "SELECT * FROM productos";
        $resultmostrarprodutos = $conn->query($mostrarproducto);
        while($fila=$resultmostrarprodutos->fetch_assoc()){

          echo "<tr class='".$fila['id']."'>";
          echo "<td>".$fila['id']."</td>";
          echo "<td class='usernamee'><a style='text-decoration:none;color:black;'>".$fila['Nombre']."</a></td>";
          echo "<td class='PrecioPrecio'>".$fila['Precio']."</td>";
          echo "<td>".$fila['Descripcion']."</td>";
          echo "<td><img style='width:80%;'src='"."imagenes/".$fila['Imagen']."'></td>";
          echo "<td><img style='width:80%;'src='"."imagenes/".$fila['Imagen2']."'></td>"; 
          ?>
          <td><?php echo"<a href='edit_producto.php?id=".$fila['id']."' class='btn btn-primary btn-sm'> Modificar </a>"; ?>
          <?php echo"<a href='eliminar_producto.php?id=".$fila['id']."' class='btn btn-danger btn-sm'> Eliminar </a>
          </td>
          </tr>";}?>
        </table>
      </div>
    </div>

    <div id="nuevousuario" class="container">
      <h3>Añadir un nuevo usuario</h3>
      <form id='anadirnuevousuarioporadmin' method='post'>
        <div class="form-group">
          <label for="exampleInputPassword1">Usuario</label>
          <input type="input" class="form-control" id="usuario" name="usuario">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Nombre</label>
          <input type="input" class="form-control" id="nombre" name="nombre">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Apellido</label>
          <input type="input" class="form-control" id="apellido" name="apellido">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Dirección de correo electrónico</label>
          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Contraseña</label>
          <input type="password" class="form-control" id="contrasena" name="contrasena">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Telefono</label>
          <input type="input" class="form-control" id="telefono" name="telefono" maxlength="9">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Direccion</label>
          <input type="input" class="form-control" id="direccion" name="direccion">
        </div>
        <input type='submit' class='btn btn-primary' name='loginBtn' id='loginBtn' value='Añadir nuevo usuario' />
      </form>
      <div class="container">
        <h3>Mostrar Los Usuarios</h3>
        <table class="tabla">
          <tr style="background-color: #7FFFD4;">
            <td><div class="col-12 mb-4" style="font-weight:bold">ID</div></td>
            <td><div class="col-12 mb-4" style="font-weight:bold">Usuario</div></td>
            <td><div class="col-12 mb-4" style="font-weight:bold">Email</div></td>
            <td><div class="col-md-12 mb-4" style="font-weight:bold">Telefono</div></td>

            <td><div class="col-12 mb-4" style="font-weight:bold">Acciones</div></td>
          </tr>
          <?php 
          $mostrar = "SELECT * FROM usuario";
          $resultmostrar = $conn->query($mostrar);
          while($fila=$resultmostrar->fetch_assoc()){

            echo "<tr class='".$fila['ID']."'>";
            echo "<td>".$fila['ID']."</td>";
            echo "<td class='usernamee'><a style='text-decoration:none;color:black;'>".$fila['Usuario']."</a></td>";
            echo "<td class='emaill'>".$fila['Email']."</td>";
              echo "<td>".$fila['Telefono']."</td>"; //TR CLASS para que cada fila tenga una clase diferente para cambiarla despues con ajax
              ?>
              <td><?php echo"<a href='edit_user.php?id=".$fila['ID']."' class='btn btn-primary btn-sm'> Modificar </a>"; ?>
              <?php echo"<a href='eliminar_user.php?id=".$fila['ID']."' class='btn btn-danger btn-sm'> Eliminar </a>
              </td>
              </tr>";}?>



            <?php } ?>
          </table>
        </div>
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