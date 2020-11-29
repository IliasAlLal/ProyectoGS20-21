<?php
session_start();
$user = $_SESSION['user'];
include 'global/config.php';
include 'global/conexion.php';
include 'conexion.php';
  if(!empty($_POST)){ //si le damos al boton aceptar
    $alert='';
    if(empty($_POST['usuario']) || empty($_POST['email']) || empty($_POST['telefono'])  ) {
      echo "pon todos los campos";
      $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else{ 
      $user = $_SESSION['user'];
      $email = $_POST['email'];
      $usuario = $_POST['usuario'];
      $contraActual = $_POST['contraActual']; 
      $contra1 = $_POST['contra1']; 
      $contra2 = $_POST['contra2'];
      $telefono = $_POST['telefono']; 

      //recogemos el valor del formulario...metodo rapido para recoger el id del usuario
      $sqlA = $conn->query("SELECT * FROM usuario WHERE Usuario = '". $_SESSION['user']."'");//selecciona todos los datos del usuario actual 
      $rowA = $sqlA->fetch_array(); //convertir los datos obtenidos de la base de datos en un array
      $sqlpass = $conn->query("SELECT Contrasena FROM usuario WHERE Usuario = '".$_SESSION['user']."'");//selecciona la contraseña del usuario actual
      $pass = $sqlpass->fetch_array(); //convertir los datos obtenidos de la base de datos en un array
      if (empty($contra2)){ //comprueba si el campo repetir contraseña esta vacio que se entiende que el usuario decidio no cambiar la contraseña
      //si esta vascio vamos a rellenar de nuevo los campos con los datos ya existentes  
        $contra2 = $rowA['Contrasena'];

        $sql = "UPDATE usuario SET Usuario='$usuario', Email='$email', Contrasena='$contra2', Telefono='$telefono',Nombre='nombre1', Apellidos='apellido'WHERE Usuario= '".$_SESSION['user']."'";
        $sql1 =$conn->query("SELECT * FROM usuario WHERE Usuario= '".$_SESSION['user']."'");
        $result1=$sql1->fetch_array();
        $result = $conn->query($sql);
        if($result){
         $_SESSION['user'] = $usuario;   
         $_SESSION['id'] = $result1["ID"];  
         //$correcto="<p style='color:green'><i>Se han modificado tus datos</i></p>";
       }  
     } else { 
                  //verificamos si la contrasena coincide con la contrasena de la bd
      if($rowA['Contrasena'] == $contraActual){//si la contraseña guarda en la base de datos y la contraseña introducida en el campo del usuario hace el if
        if($contra1 == $contra2){//si los campos nueva contraseña y respetir contraseña son iguales se hace el siguiente if
          $actualizar = $conn->query("UPDATE Usuario SET Contrasena = '$contra1' WHERE Usuario= '".$_SESSION['user']."'");
          if($actualizar){
            $bien ="<p style='color:green;'>Se ha actualizado tu contraseña</p>";
            $sql = "UPDATE usuario SET Usuario='$usuario', Email='$email', Contrasena='$contra2', Telefono='$telefono',Nombre='nombre1', Apellidos='apellido'WHERE Usuario= '".$_SESSION['user']."'";
            $sql1 =$conn->query("SELECT * FROM usuario WHERE Usuario= '".$_SESSION['user']."'");
            $result1=$sql1->fetch_array();
            $result = $conn->query($sql);
            if($result){
             $_SESSION['user'] = $usuario;   
             $_SESSION['id'] = $result1["ID"];  
             $correcto="<p style='color:green'><i>Se han modificado tus datos</i></p>";
                //echo"<script>location = 'index.php';</script>";
                //echo"<script>location = 'configuracion.php';</script>";
           } else{
            echo"Error al eliminar";
          }
        }
      } 
      else {
        $no1= "<p style='color:red;'>Las contraseñas no coinciden. Vuelve a intentarlo</p>";
      }
    }
    else{
      $no2="<p style='color:red;'>Tu contraseña actual no coincide.Vuelve a intentarlo</p>";
    }
  }
} 
}
?>  
<!doctype html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <title>Configuracion</title>
  <style type="text/css">
    body{
      margin:0 auto;
    }
  </style>
</head>
<body>
  <div class="container mt-5 ">
    <div>
      <img src="imagenes/user1.png" height="700" class="rounded float-left">
    </div>
    <div>
      <h3 class="text-left"><?php echo $_SESSION['user'];?></h3>
    </div>
    <?php if(isset($correcto)) { echo $correcto; } ?>
    <?php
    $sentencia=$pdo->prepare("SELECT * FROM usuario WHERE Usuario= '".$_SESSION['user']."'");
    $sentencia->execute();
    $usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);
      //print_r($listaProductos);
    ?>
    <?php foreach($usuarios as $usuario){ ?>
      <form action="" method="post">
        Nombre: <?php echo $usuario['Usuario']; ?> <br>
        <input type="text"  name="usuario" placeholder="Nuevo usuario"value="<?php echo $usuario['Usuario']; ?>"><br>
        Email: <?php echo $usuario['Email']; ?><br>
        <input type="text"  name="email" placeholder="Nuevo email" value="<?php echo $usuario['Email']; ?>"><br>
        
        Telefono: <?php echo $usuario['Telefono']; ?><br>
        <input type="text"  name="telefono" placeholder="Nuevo telefono" value="<?php echo $usuario['Telefono']; ?>"><br>
        Nombre: <?php echo $usuario['Nombre']; ?><br>
        <input type="text"  name="nombre" placeholder="Nuevo nombre"value="<?php echo $usuario['Nombre']; ?>"><br>
        Apellidos: <?php echo $usuario['Apellidos']; ?><br>
        <input type="text"  name="apellido" placeholder="Nuevo apellido"value="<?php echo $usuario['Apellidos']; ?>"><br>
        Direccion: <?php echo $usuario['Dirección']; ?> <br>
        <input type="text"  name="direccion" placeholder="Nueva direccion" value="<?php echo $usuario['Dirección']; ?>"><br>
        <button type="button" id="contraboton" class="btn btn-link">Cambiar contraseña</button><br>
        <div id="contradiv">
          Contraseña actual: <br>
          <input type="text"  name="contraActual" placeholder="Contraseña actual"value=""><br>
          Contraseña nueva: <br>
          <input type="text"  name="contra1" placeholder="Nueva contrasena"value=""><br>
          Repite contraseña: <br>
          <input type="text"  name="contra2" placeholder="Repite nueva contrasena"value=""><br><br>
        </div>
        <input type="submit" name="Aceptar" class="btn btn-primary" value="Modificar cambios">
        <a href="index.php">Volver atras</a>
      </form>
      <?php if(isset($bien)) { echo $bien; } ?>
        <?php if(isset($no1)) { echo $no1; } ?>
        <?php if(isset($no2)) { echo $no2; } ?>
    <?php  }  ?>
  </div>




  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="scripts.js"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
  -->
</body>
</html>