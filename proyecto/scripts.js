function darOpcion1(){
  $("#opcion1").click(function(){
    $('.caros').show();
    $('.baratos').hide();
    $('.novedades').hide();
  $('.iphone').hide();
  $('.samsung').hide();
  $('.huawei').hide();
  });

}
function darOpcion2(){
  $("#opcion2").click(function(){
    $('.caros').hide();
    $('.baratos').show();
    $('.novedades').hide();
  $('.iphone').hide();
  $('.samsung').hide();
  $('.huawei').hide();
  });

}
function darOpcionNormal(){
   $("#opcion0").click(function(){
    $('.normales').show();
    $('.caros').hide();
    $('.baratos').hide();
    $('.novedades').hide();
  $('.iphone').hide();
  $('.samsung').hide();
  $('.huawei').hide();
  });
}

function darNovedades(){
  $("#list-novedades-list").click(function(){
    $('.novedades').show();
    $('.iphone').hide();
    $('.samsung').hide();
    $('.huawei').hide();

    $('#titulomovil').html("Últimos artículos");
  });
  
}
function darIphone(){
  $("#list-iphone-list").click(function(){
    $('.iphone').show();
    $('.novedades').hide();
    $('.samsung').hide();
    $('.huawei').hide();

    $('#titulomovil').html("Iphone");
  });
  
}
function darSamsung(){
  $("#list-samsung-list").click(function(){
    $('.samsung').show();
    $('.novedades').hide();
    $('.iphone').hide();
    $('.huawei').hide();
    $('#titulomovil').html("Samsung");
  });
  
}
function darHuawei(){
  $("#list-huawei-list").click(function(){
    $('.huawei').show();
    $('.novedades').hide();
    $('.iphone').hide();
    $('.samsung').hide();
    $('#titulomovil').html("Huawei");
  });
  
}
function baratos(){

 $('.baratos').hide();

}
function normales(){

 $('.normales').hide();

}
function caros(){

 $('.caros').hide();

}

function ocultarIphone(){

 $('.iphone').hide();

}
function ocultarSamsung(){

 $('.samsung').hide();

}
function ocultarHuawei(){

 $('.huawei').hide();

}
function ocultarInfousuario(){

 $('#nuevousuario').hide();

}

function ocultarInfoproducto(){

 $('#agregarproducto').hide();

}

function darclickProductos(){ 

  $("#agregarnuevoprodcuto").click(function(){
    $('#agregarproducto').toggle();


  });
}

function darclickUsuario(){ 

  $("#agregarnuevousuario").click(function(){
    $('#nuevousuario').toggle();


  });
}
function ocultarContra(){

 $('#contradiv').hide();

}
function darclickContra(){ 

  $("#contraboton").click(function(){
    $('#contradiv').toggle();


  });
}

$(document).ready(function () {
//ocultar formulario de produictos
ocultarInfoproducto();
darclickProductos();
//ocultar formulario de usuario
ocultarInfousuario();
darclickUsuario();
//ocultar formulario de contraseña
ocultarContra();
darclickContra();
// funciones para el mini menu del index
darNovedades();
darIphone();
ocultarIphone();
darSamsung();
ocultarSamsung();
darHuawei();
ocultarHuawei();
//oculta por defecto el div caros

//cuando le des a la opcion del selec del mas caro aparezca los articulos ordenados por precioy desaparece la otros articulos mal ordenados 
darOpcion1();
darOpcion2();
darOpcionNormal();
normales();

caros();
baratos();
//registro

$('#registroform').submit(function(e) {
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: 'registrarse.php',
    data: $(this).serialize(),
    success: function(response)
    {
      var jsonData = JSON.parse(response);

                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1")
                {

                  location.href = "index.php";
                }
                else
                {
                  $('#erroreguistro').html("<div class='mt-3 alert alert-danger' role='alert'>No te has Podido Registrar</div>");
                  //
                 //alert("no te has podido registrar");
                 setTimeout(function() {
                       //$(".content").fadeOut(1500);
                       $('#erroreguistro').hide();
                     },3000);
               }
             }
           });

});

//login
$('#loginform').submit(function(e) {
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: 'logearse.php',
    data: $(this).serialize(),
    success: function(response)
    {
      var jsonData = JSON.parse(response);

                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1")
                {

                  location.href = "index.php";
                }
                else
                {
                 $('#notificacion').html("<p style='color:red;'>Credenciales de acceso no válidas</p>");
               }
             }
           });

});

//anadir nuevo producto
$('#nuevoproductoform').submit(function(e) {
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: 'anadirnuevoproducto.php',
    data:  new FormData(this),
    contentType: false,
    cache: false,
    processData:false,
    success: function(response)
    {
      var jsonData = JSON.parse(response);

                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1")
                {

                  $('#notificacion1').html("<div class='mt-3 alert alert-success' role='alert'>producto añadido</div>");
                  setTimeout(location.href = "index.php", 5000);
                }
                else
                {
                  $('#notificacion1').html("<div class='mt-3 alert alert-danger' role='alert'>El Producto no se a Podido Añadido</div>");
                  //alert("No se ha añadido un nuevo producto");
                  //location.href = "index.php";
                  exit;
                }
              }
            });
});
//FUNCION PARA SUBIR UNA IMAGEN EN HTML producto
$(function() {
  $('#imag_file').change(function(e) {
    addImage(e); 
  });

  function addImage(e){
    var file = e.target.files[0],
    imageType = /image.*/;

    if (!file.type.match(imageType))
     return;

   var reader = new FileReader();
   reader.onload = fileOnload;
   reader.readAsDataURL(file);
 }

 function fileOnload(e) {
  var result=e.target.result;
  $('#imgSalida').attr("src",result);
}
});
//FUNCION PARA SUBIR UNA IMAGEN 2 EN HTML producto
$(function() {
  $('#imag_file2').change(function(e) {
    addImage(e); 
  });

  function addImage(e){
    var file = e.target.files[0],
    imageType = /image.*/;

    if (!file.type.match(imageType))
     return;

   var reader = new FileReader();
   reader.onload = fileOnload;
   reader.readAsDataURL(file);
 }

 function fileOnload(e) {
  var result=e.target.result;
  $('#imgSalida3').attr("src",result);
}
});

// añadir nuevo usuario desde admin
$('#anadirnuevousuarioporadmin').submit(function(e) {
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: 'anadirnuevousuario.php',
    data: $(this).serialize(),
    success: function(response)
    {
      var jsonData = JSON.parse(response);

                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1")
                {
                  $('#notificacion1').html("<div class='mt-3 alert alert-success' role='alert'>Usuario añadido Correctamente</div>");
                  setTimeout(location.href = "index.php",3000);//location.href = "index.php";
                }
                else
                {
                 $('#notificacion1').html("<div class='mt-3 alert alert-danger' role='alert'>No se a Podido Añadido un Nuevo Usuario</div>");
               }
             }
           });

});

//comentarios
$(".enviar-btn").keypress(function(event) {

  if ( event.which == 13 ) {

    var getpID =  $(this).parent().attr('id').replace('record-','');

    var usuario = $("input#usuario").val();
    var comentario = $("#comentario-"+getpID).val();
    var publicacion = getpID;
    var now = new Date();
    var date_show = now.getDate() + '-' + now.getMonth() + '-' + now.getFullYear() + ' ' + now.getHours() + ':' + + now.getMinutes() + ':' + + now.getSeconds();

    if (comentario == '') {
      return false;
    }

    var dataString = 'usuario=' + usuario + '&comentario=' + comentario + '&publicacion=' + publicacion;

    $.ajax({
      type: "POST",
      url: "agregarcomentarios.php",
      data: dataString,
      success: function(response) {

        $('#nuevocomentario'+getpID).append("<div class='col-12'><hr style='width:75%;'><div class='row'><div class='col-12'><div class='row'><div class='col-12' style='text-align:left;'><small><i><b>"+usuario+"</b></i></small></div><div class='col-12' style='text-align:left;'><small style='color:#A9A9A9;'>"+date_show+"</small></div><div class='col-12' style='text-align:left;'><small>"+comentario+"</small><hr style='width:75%;'></div></div></div></div>");
      }
    });
    return false;
  }

});
//buscador
function buscar_datos(consulta){
  $.ajax({
    type: "POST",
    url: 'buscar.php',
    dataType: 'html',
    data: {consulta: consulta},
  })
  .done(function(respuesta){
    $("#info").html(respuesta);
  })
  .fail(function() {
    alert("error");
  })

}

$(document).on('keyup', '#caja_busqueda', function(){
  var valor = $(this).val();
  if(valor!= ""){
    buscar_datos(valor);
  } else{
    buscar_datos();
  }
});
//captcha
$('#captcha').on('blur', function() {
  var captcha = $(this).val();
  var dataStringg = 'captcha='+captcha;
  $.ajax({
   type: "POST",
   url: 'check_captcha.php',
   data: dataStringg,
   success: function(data) {
    $('#result-captcha').fadeIn(1000).html(data);
  }
});
});
    //estrellas 
    $(function () {
      $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
        var rating = data.rating;
        $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
        $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
          });
    });
//realizar la votacion de estrellas 
$('#evaluarr').submit(function(e) {
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: 'evaluarproducto.php',
    data: $(this).serialize(),
    success: function(response)
    {
      var jsonData = JSON.parse(response);

                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1")
                {

                  $('#noti').html("<div class='mt-3 alert alert-success' role='alert'>Votación enviada!</div>");
                }
                else
                {
                  $('#noti').html("<div class='mt-3 alert alert-success' role='alert'>No se ha podido Votación enviada!</div>");
                }
              }
            });

});
//compara el email y lo escribe
    $('#email').on('blur', function() {
      var email = $("#email").val();

      var dataString = 'email=' + email;
      $.ajax({
        type: "POST",
        url: "check_email.php",
        data: dataString,
        success: function(data) {
          $('#emailnoti').fadeIn(1000).html(data);
        }
      });
    });
//compara el nombre y lo escribe
$('#usuario').on('blur', function() {
      var usuario = $(this).val();
      var dataString = 'usuario='+usuario;
      $.ajax({
        type: "POST",
        url: "checkearUsuario.php",
        data: dataString,
        success: function(data) {
          $('#result-username').fadeIn(1000).html(data);
        }
      });
    });

    //compara las contraseñas y lo escribe
    $('#contrasenarep').on('blur', function() {
      var contra1 = $("#contrasena").val();
      var contra2 = $("#contrasenarep").val();
      var dataString = 'contrasena=' + contra1 + '&contrasenarep=' + contra2;
      $.ajax({
        type: "POST",
        url: "check_contrasena.php",
        data: dataString,
        success: function(data) {
          $('#contrausu').fadeIn(1000).html(data);
        }
      });
    });
    //compara el telefono y lo escribe
    $('#telefono').on('blur', function() {
      var telefono = $("#telefono").val();

      var dataString = 'telefono=' + telefono;
      $.ajax({
        type: "POST",
        url: "check_telefono.php",
        data: dataString,
        success: function(data) {
          $('#telenoti').fadeIn(1000).html(data);
        }
      });
    });
    //compara el telefono y lo escribe
    $('#nombre').on('blur', function() {
      var nombre = $("#nombre").val();

      var dataString = 'nombre=' + nombre;
      $.ajax({
        type: "POST",
        url: "check_nombre.php",
        data: dataString,
        success: function(data) {
          $('#nombrenoti').fadeIn(1000).html(data);
        }
      });
    });

      $('#apellido').on('blur', function() {
      var apellido = $("#apellido").val();

      var dataString = 'apellido=' + apellido;
      $.ajax({
        type: "POST",
        url: "check_apellido.php",
        data: dataString,
        success: function(data) {
          $('#nombrenoti').fadeIn(1000).html(data);
        }
      });
    });
});