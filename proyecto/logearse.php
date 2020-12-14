 <?php
 //inicia la anterior sesion
 session_start();
//comprueba si los campos existen
 if (isset($_POST['user2']) && $_POST['user2'] && isset($_POST['contrasena']) && $_POST['contrasena']) {
    //inserta en una barriable los datos anteriores añadido 
    $user = $_POST['user2'];
    $pass = $_POST['contrasena'];
  
   //conecta la base de datos
require "conexion.php";
        //se realiza el selec para ver si existe el usuario en la base de datos
        $sql = "SELECT * FROM usuario WHERE Usuario='$user' AND Contrasena='$pass'";
        $result = $conn->query($sql);

       if ($result->num_rows > 0) {    
            $_SESSION['user'] = $user;           
            echo json_encode(array('success' => 1));
        } else {
            echo json_encode(array('success' => 0));
        }
    

    $conn->close();

 } 
 else {
    echo json_encode(array('success' => 0));
 }


 ?>