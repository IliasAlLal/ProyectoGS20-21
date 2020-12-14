    <!--<style type="text/css">
              li a:hover{
          color:black;
          font-weight: 700;

          margin-top:-1px;
          -webkit-transition: .5s all ease;
          -moz-transition: .5s all ease;
          transition: .5s all ease;
        }
    </style>-->
    <link href="css/cssnav.css" rel="stylesheet" >
    <?php
    if(!isset($_SESSION['user'])){?>
       <nav class="navbar navbar-expand-lg navbar-light bg-light shadow ">
      <a class="navbar-brand" href="index.php">
        <img class="mt-1 mb-1 col-11" width="440" height="200" src="imagenes/kingphone2.png">

      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav ml-auto">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" data-toggle="modal" data-target="#exampleModal2">Registro <span class="sr-only">(current)</span></a>
            </li>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reguistro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                   <form id='registroform' method='post'>
                    <div class="form-group">
                       <div id="erroreguistro"></div>
                      <label for="exampleInputEmail1">Dirección de correo electrónico</label>
                      <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                      <small id="emailHelp" class="form-text text-muted">Nunca compartiremos su correo electrónico con nadie más.</small>
                      <div id="emailnoti"></div>

                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Contraseña</label>
                      <input type="password" class="form-control" id="contrasena" name="contrasena">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Repite la Contraseña</label>
                      <input type="password" class="form-control" id="contrasenarep" name="contrasenarep">
                      <div id="contrausu"></div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Usuario</label>
                      <input type="input" class="form-control" id="usuario" name="usuario">
                      <div id="result-username"></div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Telefono</label>
                      <input type="input" class="form-control" id="telefono" name="telefono" maxlength="9">
                      <div id="telenoti"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nombre</label>
                      <input type="input" class="form-control" id="nombre" name="nombre">
                      <div id="nombrenoti"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Apellido</label>
                      <input type="input" class="form-control" id="apellido" name="apellido">
                      <div id="apellidonoti"></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Direccion</label>
                      <input type="input" class="form-control" id="direccion" name="direccion">

                    </div>

                    <p><img src='image.php' width='120' height='30' border='1' alt='CAPTCHA'></p>
                    <p><input type='text' size='6' maxlength='5' name='captcha' id='captcha' value=''><br>
                      <small>Copia los digitos que ves en la imagen</small></p>
                      <div id='result-captcha'></div>


                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type='submit' class='btn btn-primary' name='loginBtn' id='loginBtn' value='Registrarse' />
                      </div>
                    </form>


                  </div>

                </div>
              </div>
            </div>





            <!-- añadimos un nuevo li -->
            <li class="nav-item active">
              <a class="nav-link" data-toggle="modal" data-target="#exampleModal">Entrar <span class="sr-only">(current)</span></a>
            </li>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Iniciar sesion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">


                    <form id='loginform' method='post'>

                     <div class="form-group">
                      <label for="exampleInputPassword1">Usuario</label>
                      <input type="input" class="form-control" id="user2" name="user2">
                    </div> 

                    <div class="form-group">
                      <label for="exampleInputPassword1">Contraseña</label>
                      <input type="password" class="form-control" id="contrasena" name="contrasena">
                    </div>

                    <div class="form-group">
                      <?php echo"<a class='btn btn-info btn-sm' href='#' data-toggle='modal' data-target='#exampleModal2' data-dismiss='modal' > Crear Una Nueva Cuenta</a>";?>
                    </div>
                    <div id="notificacion"><small></small></div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <input type='submit' class='btn btn-primary' name='loginBtn' id='loginBtn' value='Logearse' />
                    </div>
                  </form>
                  <script>
                  // Verifique el soporte del navegador
                  $('#loginform').submit(function(e) {
                  if (typeof(Storage) !== "undefined") {
                    // Tienda
                    var nombreusu = $("input#user2").val();

                    localStorage.setItem("user2", nombreusu);
                    
                    // Recuperar
                    document.getElementById("user2").html = localStorage.getItem("user2");
                  } else {
                    document.getElementById("user2").innerHTML = "Lo sentimos tu navegador no es compatible...";
                  }
                  });
                  function hola(){
                  document.getElementById("user2").value = localStorage.getItem("user2");
                  }
                  hola();
                  </script>

                </div>

              </div>
            </div>
          </div>
        </ul>
        <li class=" ml-4 mr-5 nav-item">
          <a class="nav-link" href="contactanos.php" tabindex="-1" aria-disabled="true"><img class="mr-2"src="imagenes/question.png" height="26">Contáctanos</a>
        </li>
      </ul>
      <li class="form-inline my-2 my-lg-0 mr-5">
        <input class="form-control mr-sm-2" name="caja_busqueda" id="caja_busqueda" placeholder="Buscar productos">
      </li>
    </div>
  </nav>
<?php
} elseif($_SESSION['user'] != 'admin'){ ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow ">
    <a class="navbar-brand" href="index.php">
       <img class="mt-1 mb-1 col-11" width="440" height="200" src="imagenes/kingphone2.png">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">

        <li class="nav-item  ml-4 mr-4 dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="mr-1" src="imagenes/user.png" height="26">Mi cuenta
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="configuracion_user.php">Configuración</a>
            
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="desconectarse.php">Desconectarse</a>
          </div>
        </li>
        <li class=" ml-4 mr-4 nav-item">
          <a class="nav-link" href="mostrarCarrito.php" tabindex="-1" aria-disabled="true" ><img class="mr-2"src="imagenes/carrito.png" height="26">(<?php echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']);?>)Tu carrito</a>
        </li>
        <li class=" ml-4 mr-5 nav-item">
          <a class="nav-link" href="contactanos.php" tabindex="-1" aria-disabled="true"><img class="mr-2"src="imagenes/question.png" height="26">Contáctanos</a>
        </li>
      </ul>
      <li class="form-inline my-2 my-lg-0 mr-5">
        <input class="form-control mr-sm-2" name="caja_busqueda" id="caja_busqueda" placeholder="Buscar productos">
      </li>
    </div>
  </nav>

  <?php
} else{
  ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow ">
    <a class="navbar-brand" href="index.php">
      <img class="mt-1 mb-1 col-11" width="440" height="200" src="imagenes/kingphone2.png">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
         <li class="nav-item  ml-4 mr-4 dropdown">
           <button type="button" class="btn btn-outline-info" id="agregarnuevoprodcuto">Agregar un Producto</button>
           <button type="button" class="btn btn-outline-info" id="agregarnuevousuario">Agregar un Usuario</button> 
        </li>

        <li class="nav-item  ml-4 mr-4 dropdown">
          <a href="desconectarse.php" class="btn btn-outline-danger " role="button" aria-pressed="true">Desconectarse</a>
          <!-- btn btn-outline-danger <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="mr-1" src="imagenes/user.png" height="26">Mi cuenta
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="desconectarse.php">Desconectarse</a>
          </div>-->

        </li>
      </ul>
      <!--<li class="form-inline my-2 my-lg-0 mr-5">
        <input class="form-control mr-sm-2" name="caja_busqueda" id="caja_busqueda" placeholder="Buscar productos">
      </li>-->
    </div>
  </nav>
      <?php } ?>