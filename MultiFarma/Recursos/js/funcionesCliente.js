function cliente(){

    var dt = $("#tabla").DataTable({
            "ajax": "./Controlador/controladorCliente.php?accion=listar",
            "columns": [
                { "data": "id_cliente"} ,
                { "data": "nombre_cliente" },
                { "data": "apellido_cliente" },
                { "data": "direccion_cliente" },
                { "data": "telefono_cliente" },
                { "data": "nombre_pais" },
                { "data": "nombre_ciudad" },
              { "data": "id_cliente",
                  render: function (data) {
                            return '<a href="#" data-codigo="'+ data + 
                                   '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                            +      '<a href="#" data-codigo="'+ data + 
                                   '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>'
                  }
              }
            ]
    });

  $("#editar").on("click",".btncerrar", function(){
      $(".box-title").html("Listado de Clientes");
      $("#editar").addClass('hide');
      $("#editar").removeClass('show');
      $("#listado").addClass('show');
      $("#listado").removeClass('hide');  
      $(".box #nuevo").show(); 
  })  

//$("#editar").on("click", function(){



//});

  $(".box").on("click","#nuevo", function(){
      $(this).hide();
      $(".box-title").html("Crear Cliente");
      $("#editar").addClass('show');
      $("#editar").removeClass('hide');
      $("#listado").addClass('hide');
      $("#listado").removeClass('show');
      $("#editar").load('./Vista/Clientes/nuevoCliente.php', function(){
          $.ajax({
             type:"get",
             url:"./Controlador/controladorPais.php",
             data: {accion:'listar'},
             dataType:"json"
          }).done(function( resultado ) {                    
              $.each(resultado.data, function (index, value) { 
                $("#editar #id_pais").append("<option value='" + value.id_pais + "'>" + value.nombre_pais + "</option>")
              });
          });
          $("#id_pais").change(function(){
            $("#id_pais option:selected").each(function(){
            var id_pais = document.forms['fcliente']['id_pais'].value;
            $("#id_ciudad").find('option').remove().end().append(
            '<option value="whatever">Seleccione ...</option>').val("whatever");
            $.ajax({
                type:"get",
                url:"./Controlador/controladorCiudad.php",
                data: {codigo: id_pais, accion:'listarC'},
                dataType:"json"
             }).done(function( resultado ) {                    
                 $.each(resultado.data, function (index, value) { 
                   $("#editar #id_ciudad").append("<option value='" + value.id_ciudad + "'>" + value.nombre_ciudad + "</option>")
                 });
             });
            });             
            });
      });
      
  })

  $("#editar").on("click","button#grabar",function(){
    var codigo = document.forms["fcliente"]["id_cliente"].value;
    $.ajax({
      type:"get",
      url:"./Controlador/controladorCliente.php",
      data: {codigo: codigo, accion:'consultar'},
      dataType:"json"
      }).done(function( cliente ) {        
           if(cliente.respuesta == "no existe"){
            var datos=$("#fcliente").serialize();
            //console.log(datos);
            $.ajax({
                  type:"post",
                  url:"./Controlador/controladorCliente.php",
                  data: datos,
                  dataType:"json"
                }).done(function( resultado ) {
                    if(resultado.respuesta){
                      swal({
                          position: 'center',
                          type: 'success',
                          title: 'El cliente fue grabada con éxito',
                          showConfirmButton: false,
                          timer: 1200
                      })     
                          $(".box-title").html("Listado de Clientes");
                          $(".box #nuevo").show();
                          $("#editar").html('');
                          $("#editar").addClass('hide');
                          $("#editar").removeClass('show');
                          $("#listado").addClass('show');
                          $("#listado").removeClass('hide');
                          dt.page( 'last' ).draw( 'page' );
                          dt.ajax.reload(null, false);                   
                   } else {
                      swal({
                          position: 'center',
                          type: 'error',
                          title: 'Ocurrió un erro al grabar',
                          showConfirmButton: false,
                          timer: 1500
                      });
                     
                  }
              });
           }
           else {
            swal({
              type: 'error',
              title: 'Oops...',
              text: 'El cliente ya existe!!!!!'                         
            })
          }
        });
   
  });

  $("#editar").on("click","button#actualizar",function(){
       var datos=$("#fcliente").serialize();
      // console.log(datos);
       $.ajax({
          type:"post",
          url:"./Controlador/controladorCliente.php",
          data: datos,
          dataType:"json"
        }).done(function( resultado ) {
 
            if(resultado.respuesta){    
              swal({
                  position: 'center',
                  type: 'success',
                  title: 'Se actualizaron los datos correctamente',
                  showConfirmButton: false,
                  timer: 1500
              }) 
              $(".box-title").html("Listado de Clientes");
              $("#editar").html('');
              $("#editar").addClass('hide');
              $("#editar").removeClass('show');
              $("#listado").addClass('show');
              $("#listado").removeClass('hide');
              dt.ajax.reload(null, false);       
           } else {
              swal({
                type: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'                         
              })
          }
      });
  })

  $(".box-body").on("click","a.borrar",function(){
      //Recupera datos del formulario
      var codigo = $(this).data("codigo");
      
      swal({
            title: '¿Está seguro?',
            text: "¿Realmente desea borrar el cliente con codigo : " + codigo + " ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrarlo!'
      }).then((decision) => {
              if (decision.value) {
                  var request = $.ajax({
                      method: "post",                  
                      url: "./Controlador/controladorCliente.php",
                      data: {codigo: codigo, accion:'borrar'},
                      dataType: "json"
                  })
                  request.done(function( resultado ) {
                      if(resultado.respuesta == 'correcto'){
                          swal({
                            position: 'center',
                            type: 'success',
                            title: 'El cliente con codigo ' + codigo + ' fue borrado',
                            showConfirmButton: false,
                            timer: 1500
                          })       
                          var info = dt.page.info();   
                          if((info.end-1) == info.length)
                              dt.page( info.page-1 ).draw( 'page' );
                          dt.ajax.reload(null, false);
                          
                      } else {
                          swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'                         
                          })
                      }
                  });
                   
                  request.fail(function( jqXHR, textStatus ) {
                      swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!' + textStatus                          
                      })
                  });
              }
      })

  });
  
  $(".box-body").on("click","a.editar",function(){
     //$("#titulo").html("Editar Comuna");
     //Recupera datos del fromulario
     var codigo = $(this).data("codigo");
     var pais, ciudad;
     $(".box-title").html("Actualizar Cliente")
     $("#editar").addClass('show');
     $("#editar").removeClass('hide');
     $("#listado").addClass('hide');
     $("#listado").removeClass('show');
     $("#editar").load("./Vista/Clientes/editarCliente.php",function(){
          $.ajax({
              type:"get",
              url:"./Controlador/controladorCliente.php",
              data: {codigo: codigo, accion:'consultar'},
              dataType:"json"
              }).done(function( cliente ) {        
                  if(cliente.respuesta === "no existe"){
                      swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Cliente no existe!'                         
                      })
                  } else {
                      $("#id_cliente").val(cliente.id_cliente);                   
                      $("#nombre_cliente").val(cliente.nombre_cliente);
                      $("#apellido_cliente").val(cliente.apellido_cliente);
                      $("#direccion_cliente").val(cliente.direccion_cliente);
                      $("#telefono_cliente").val(cliente.telefono_cliente);
                      pais = cliente.id_pais;
                      ciudad = cliente.id_ciudad;
                      var id_pais = cliente.id_pais;
                      $.ajax({
                        type:"get",
                        url:"./Controlador/controladorPais.php",
                        data: {accion:'listar'},
                        dataType:"json"
                    }).done(function( resultado ) {                      
                        $.each(resultado.data, function (index, value) { 
                        if(pais === value.id_pais){
                            $("#editar #id_pais").append("<option selected value='" + value.id_pais + "'>" + value.nombre_pais + "</option>")
                        }else {
                            $("#editar #id_pais").append("<option value='" + value.id_pais + "'>" + value.nombre_pais + "</option>")
                        }
                        });
                    });
                    $.ajax({
                      type:"get",
                      url:"./Controlador/controladorCiudad.php",
                      data: {codigo: id_pais, accion:'listarC'},
                      dataType:"json"
                   }).done(function( resultado ) {                    
                       $.each(resultado.data, function (index, value) { 
                          if(ciudad === value.id_ciudad){
                          $("#editar #id_ciudad").append("<option selected value='" + value.id_ciudad + "'>" + value.nombre_ciudad + "</option>")
                          }
                          else{
                          $("#editar #id_ciudad").append("<option value='" + value.id_ciudad + "'>" + value.nombre_ciudad + "</option>")
                          } 
                       });
                   });
                  }
                  $("#id_pais").change(function(){
                    $("#id_pais option:selected").each(function(){
                    var id_pais = document.forms['fcliente']['id_pais'].value;
                    $("#id_ciudad").find('option').remove().end().append(
                    '<option value="whatever">Seleccione ...</option>').val("whatever");
                    $.ajax({
                        type:"get",
                        url:"./Controlador/controladorCiudad.php",
                        data: {codigo: id_pais, accion:'listarC'},
                        dataType:"json"
                     }).done(function( resultado ) {                    
                         $.each(resultado.data, function (index, value) {           
                           $("#editar #id_ciudad").append("<option value='" + value.id_ciudad + "'>" + value.nombre_ciudad + "</option>") 
                         });
                     });
                    });             
                    });
          });
      });
  })
}
