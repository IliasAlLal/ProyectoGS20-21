<!doctype html>
<html lang="en">
<head>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

 <title>reguistro</title>
</head>

<body>
  <form id='registroform' method='post'>
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
      <label for="exampleInputPassword1">Usuario</label>
      <input type="input" class="form-control" id="usuario" name="usuario">
    </div>

    <div class="form-group form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Me echa un vistazo</label>
    </div>
    <p><img src='image.php' width='120' height='30' border='1' alt='CAPTCHA'></p>
    <p><input type='text' size='6' maxlength='5' name='captcha' id='captcha' value=''><br>
      <small>Copia los digitos que ves en la imagen</small></p>
      <div id='result-captcha'></div>
      <input type='submit' class='btn btn-primary' name='loginBtn' id='loginBtn' value='Registrarse' />
    </form>

    <!-- Optional JavaScript; choose one of the two! -->

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="scripts.js"></script>
  </body>
  </html>