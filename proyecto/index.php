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
 <style type="text/css">
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


</style>
</style>
</head>
<body>
  <?php
  session_start();
  include 'global/config.php';
  include 'global/conexion.php';
  include 'conexion.php';
  if(!isset($_SESSION['user'])){?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="registro.php">Registro <span class="sr-only">(current)</span></a>
          </li>
          <!-- añadimos un nuevo li -->
          <li class="nav-item active">
            <a class="nav-link" href="login.php">Login <span class="sr-only">(current)</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
-
      </div>
    </nav>
    <?php
    echo "Hola!, no estas registrado";
  } elseif($_SESSION['user'] != 'admin'){ ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <!-- añadimos un nuevo li -->
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="imagenes/user.png" height="26">
              Mi Cuenta
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="configuracion_user.php">Configuración</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <li class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" name="caja_busqueda" id="caja_busqueda" placeholder="Buscar productos">
        </li>
      </div>
    </nav>
    <?php

    echo "Bienvenido " . $_SESSION['user'] . ", eres un usuario normal";
    ?>
    <a href="desconectarse.php" class="btn btn-danger btn-sm active" role="button" aria-pressed="true">Desconectarse</a>

    <div class="container my-5">
      <h1>Tienda</h1>
      <!--<?php if($mensaje!="") {?>-->

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

        <div class="col-xs-12 col-lg-3 mt-5 ml-4">
          <div class="card" style="width: 18rem;">
            <img title="<?php echo $producto['Nombre']; ?>" alt="<?php echo $producto['Nombre']; ?>" src="<?php echo $producto['Imagen'] ?>" class="card-img-top" data-toggle="popover" data-trigger="hover"data-content="<?php echo $producto['Descripcion']; ?>" height="317px">
            <div class="card-body">
              <span><?php echo $producto['Nombre']; ?></span>
              <h5 class="card-title"><?php echo $producto['Precio']; echo "€" ?></h5>

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


      <?php  }  ?>


    </div>
  </div>

  <?php
} else{
  ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="registro.php">Registro <span class="sr-only">(current)</span></a>
        </li>
        <!-- añadimos un nuevo li -->
        <li class="nav-item active">
          <a class="nav-link" href="login.php">Login <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
    </div>
  </nav>
  <?php
  echo"hola admin";
  ?>
  <button type="button" class="btn btn-info" id="agregarnuevoprodcuto">Agregar un Producto</button>
  <button type="button" class="btn btn-info" id="agregarnuevousuario">Agregar un Usuario</button> 
  <a href="desconectarse.php" class="btn btn-danger btn-sm active" role="button" aria-pressed="true">Desconectarse</a>
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
      <b>Subir imagen de producto</b> 

      <input id="file-inputaa" type="file" name="file-inputaa" />
      <div class="col-12 m-3">
        <div id="resultadoa" class=""><img id="imgSalidaa" width="300" /></div>
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
          <label for="exampleInputEmail1">Dirección de correo electrónico</label>
          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
          <small id="emailHelp" class="form-text text-muted">Nunca compartiremos su correo electrónico con nadie más.</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Contraseña</label>
          <input type="password" class="form-control" id="contrasena" name="contrasena">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Telefono</label>
          <input type="input" class="form-control" id="telefono" name="telefono" maxlength="9">
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

      <!-- Optional JavaScript; choose one of the two! -->

      <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
      <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <script src="scripts.js"></script>
    </body>
    </html>