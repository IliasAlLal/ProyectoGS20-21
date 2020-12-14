 <?php
 //iniciamos sesion para conservar los datos
 session_start();
 //comprobamos si los campos obligatorios estan rellenados 
if (isset($_POST['nombreaa']) && $_POST['nombreaa'] && isset($_POST['precioaa']) && $_POST['precioaa']) {
	//coger los campos mediante post para poder usarlo  
	$nombre = $_POST['nombreaa'];
	$precio = $_POST['precioaa'];
	$descripcion = $_POST['descripcionaa'];
	$marcaa = $_POST['marcaa'];
	$imagen = $_FILES['file-inputaa']['tmp_name'];
	$ruta = $_FILES['file-inputaa']['name'];

	$upload_dir="imagenes/";
	//indicamos donde cogemos la imagen y donde la queremos dejar 
	move_uploaded_file($imagen,$upload_dir.$ruta);
	$imagen2 = $_FILES['file-inputaa1']['tmp_name'];
	$ruta2 = $_FILES['file-inputaa1']['name'];
	move_uploaded_file($imagen2,$upload_dir.$ruta2);
	//mos conectamos a la base de datos
	require "conexion.php";


	//hacemos la consulta con su posterior ejecucion para hacerla base de datos 
	$sql = "INSERT INTO productos (Nombre, Precio, Descripcion, marca, Imagen,	Imagen2 , likes, comentarios) VALUES ('$nombre','$precio','$descripcion', '$marcaa', '$ruta','$ruta2' , '0', '0')";
	$result = $conn->query($sql);
	//realiza la comprobacion de si los datos se an podido guardar correctamente 
	if ($result) {
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
 