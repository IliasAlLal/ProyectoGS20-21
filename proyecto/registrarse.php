 <?php
 require "conexion.php";
 session_start();
 if (isset($_POST['captcha']) && $_POST['captcha'] == $_SESSION['digit']){
   if (isset($_POST['email']) && $_POST['email'] && isset($_POST['contrasena']) && $_POST['contrasena']) {

    $user = $_POST['usuario'];
    $email = $_POST['email'];
    $pass = $_POST['contrasena'];
    $telefono = $_POST['telefono'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $pass1 = $_POST['contrasenarep'];
    
    $consultausuario = "SELECT Usuario FROM usuario WHERE Usuario='$user'";
    $consultaemail = "SELECT Usuario FROM usuario WHERE Email='$email'";
    if($resultadousuario = $conn->query($consultausuario));
    $numerousuario = $resultadousuario->num_rows;
    if($resultadoemail = $conn->query($consultaemail));
    $numeroemail = $resultadoemail->num_rows;

    $sql = "INSERT INTO usuario (Usuario, Email, Contrasena, tipo,Telefono,Nombre,Apellidos,Dirección) VALUES ('$user','$email','$pass','usuario','$telefono','$nombre','$apellido','$direccion')";
    $result = $conn->query($sql);
    if($pass != $pass1){
        echo"Debe repetir las contraseñas";
    }
    elseif($numerousuario >0){
        echo"Este nombre de usuario ya esta en uso, intente con otro";

    }elseif($numeroemail>0){
        echo"Este correo electronico ya esta en uso";
    }else{

    if ($result) {


        $_SESSION['user'] = $user;
        $_SESSION['email'] = $email;

        echo json_encode(array('success' => 1));

    } else {
        echo json_encode(array('success' => 0));
    }
    }

    $conn->close();

}
} 
else {
    echo json_encode(array('success' => 0));
}


?>