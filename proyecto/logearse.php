 <?php
 session_start();

 if (isset($_POST['usuario']) && $_POST['usuario'] && isset($_POST['contrasena']) && $_POST['contrasena']) {

    $user = $_POST['usuario'];
    $pass = $_POST['contrasena'];
  
   
require "conexion.php";
        
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