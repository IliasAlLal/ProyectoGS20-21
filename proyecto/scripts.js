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
                 alert("no te has podido registrar");
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

                  location.href = "index.php";
                }
                else
                {
                  alert("No se ha añadido un nuevo producto");
                  location.href = "index.php";
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

                  location.href = "index.php";
                }
                else
                {
                 alert("no has podido anadir un nuevo usuario");
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
      alert('Debes añadir un comentario');
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
});
