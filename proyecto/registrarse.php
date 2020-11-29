 <?php
 session_start();
if (isset($_POST['captcha']) && $_POST['captcha'] == $_SESSION['digit']){
 if (isset($_POST['email']) && $_POST['email'] && isset($_POST['contrasena']) && $_POST['contrasena']) {

    $user = $_POST['usuario'];
    $email = $_POST['email'];
    $pass = $_POST['contrasena'];
  
   
require "conexion.php";

        $sql = "INSERT INTO usuario (Usuario, Email, Contrasena, tipo,Telefono,Nombre,Apellidos,Dirección) VALUES ('$user','$email','$pass','vacio','vacio','vacio','vacio','vacio')";
        $result = $conn->query($sql);

        if ($result) {
    
   
            $_SESSION['user'] = $user;
            $_SESSION['email'] = $email;
            
            echo json_encode(array('success' => 1));

        } else {
            echo json_encode(array('success' => 0));
        }
    

    $conn->close();

 }
 } 
 else {
    echo json_encode(array('success' => 0));
 }


 ?>