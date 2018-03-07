function newRegistro(){ 

  var idProducto = $('#IdNew').val();
  var estadoProducto = $('#EstadoNew').val();
  
     $.ajax({
        type: 'POST',
        url : 'php/nuevoRegistro.php', 
        data: 'id='+idProducto+'&estado='+estadoProducto, 
        beforeSend: function(){
        console.log('enviando datos......'); 
        $('#msgFormulario' ).html('<img src="img/Loading_icon.gif" "width="100px" height="100px"> Procesando'); 
        }, 

        success:function(msg){
          if(msg == '1'){
          $('#respuesta').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Registro Exitoso </div>');
          }
          else {
          $('#respuesta').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong>Error, Verifique los datos ingresados</div>');
          }
          }, 
      });  //FINAL AJAX 
 } 