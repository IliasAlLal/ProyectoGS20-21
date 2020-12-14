<?php


  // inicializamos la imagen con dimensiones de 120 x 30 píxeles
  $image = @imagecreatetruecolor(120, 30) or die("Cannot Initialize new GD image stream");

  // establece el fondo en blanco y asigna colores de dibujo
  $background = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
  imagefill($image, 0, 0, $background);
  $linecolor = imagecolorallocate($image, 0xCC, 0xCC, 0xCC);
  $textcolor = imagecolorallocate($image, 0x33, 0x33, 0x33);

  // dibujar líneas aleatorias sobre la imagen
  for($i=0; $i < 6; $i++) {
    imagesetthickness($image, rand(1,3));
    imageline($image, 0, rand(0,30), 120, rand(0,30), $linecolor);
  }

  session_start();

  // añade numeros aleatorios sobre la imagen
  $digit = '';
  for($x = 15; $x <= 95; $x += 20) {
    $digit .= ($num = rand(0, 9));
    imagechar($image, rand(3, 5), $x, rand(2, 14), $num, $textcolor);
  }

  // guarda los digitos 
  $_SESSION['digit'] = $digit;

  // mostrar imagen y limpiar
  header('Content-type: image/png');
  imagepng($image);
  imagedestroy($image);
?>
