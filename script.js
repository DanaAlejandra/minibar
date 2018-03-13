$(document).ready(function(){






function nuevoRegistro(){
  
     $.ajax ( {
        url : 'php/registro_stock.php', 
        type: 'POST',
        dataType: 'json',
        data:  $('#FormularioNuevoRegistro').serialize(),  
        beforeSend: function(){
        console.log('Enviando Datos..........'); 
        $('#respuesta' ).html('<img src="img/Loading_icon.gif" width="100px"> Procesando'); 
        },
        success: function(msg) {
          if(msg == '1'){
          $('#respuesta').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Registro Exitoso </div>');
          }
          else{
          $('#respuesta').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong>Error, No se pudo realizar el registro</div>');
          }
        }
      });  //FINAL AJAX 
 }



}); 












