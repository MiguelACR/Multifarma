function cliente(){

    var dt = $("#tabla").DataTable({
            "ajax": {
                  "method"   : "post",
                  "url"      : "./Controlador/controladorCliente.php",
                  "data"     : {"accion":"listar"},
                  "dataType" : "json"
            },
            "columns": [
                { "data": "id_cliente"} ,
                { "data": "nombre_cliente" },
                { "data": "apellido_cliente" },
                { "data": "direccion_cliente" },
                { "data": "telefono_cliente" },
                { "data": "nombre_pais" },
                { "data": "nombre_ciudad" },
                { "data": "email_cliente"},
                { "defaultContent": '<a href="#" class="btn btn-danger btn-sm borrar" title="Borrar cliente"> <i class="fa fa-trash"></i></a>'},
        
                { "defaultContent": '<a href="#" class="btn btn-info btn-sm editar" title="Editar cliente"> <i class="fa fa-edit"></i></a>'}
            ]
    });

  $("#editar").on("click",".btncerrar", function(){
      $(".box-title").html("Listado de Clientes");
      $("#editar").addClass('hide');
      $("#editar").removeClass('show');
      $("#listado").addClass('show');
      $("#listado").removeClass('hide');  
      $(".box #nuevo").show(); 
      $(".box #reportes").show();
  })  

//$("#editar").on("click", function(){



//});

  $(".box").on("click","#nuevo", function(){
      $(this).hide();
      $(".box #reportes").hide();
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
            '<option value="">Seleccione ...</option>').val("");
            $.ajax({
                type:"get",
                url:"./Controlador/controladorCiudad.php",
                data: {codigo: id_pais, accion:'listar_ciudades_paises'},
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
    var datos=$("#fcliente").serialize();
    $('.label-danger').text('');
    $.ajax({
      type:"post",
      url:"./Validaciones/validacionCliente.php",
      data: datos,
      dataType:"json"
    }).done(function( r ) {
        if(!r.response) {
            for(var k in r.errors){
                $("span[data-key='" + k + "']").text(r.errors[k]);
            }   
        }
    else{
    var codigo = document.forms["fcliente"]["id_cliente"].value;
    $.ajax({
      type:"post",
      url:"./Controlador/controladorCliente.php",
      data: {codigo: codigo, accion:'consultar'},
      dataType:"json"
      }).done(function( cliente ) {        
           if(cliente.respuesta == "no existe"){
            if(document.forms["fcliente"]["nuevo"].value === 'nuevo'){
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
                          title: 'El cliente fue grabado con éxito',
                          showConfirmButton: false,
                          timer: 1200
                      })     
                          $(".box-title").html("Listado de Clientes");
                          $(".box #nuevo").show();
                          $(".box #reportes").show();
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
           }
           else {
            swal({
              type: 'error',
              title: 'Oops...',
              text: 'El cliente ya existe!!!!!'                         
            })
          }
        });
      }
    })
  });

  $("#editar").on("click","button#actualizar",function(){
    var datos=$("#fcliente").serialize();
    $('.label-danger').text('');
    $.ajax({
      type:"post",
      url:"./Validaciones/validacionCliente.php",
      data: datos,
      dataType:"json"
    }).done(function( r ) {
        if(!r.response) {
            for(var k in r.errors){
                $("span[data-key='" + k + "']").text(r.errors[k]);
            }
        }
       else{
        this.cliente = new Editar_objeto({
          id_cliente: id_cliente,
          nombre_cliente: $("#nombre_cliente").val(),
          apellido_cliente: $("#apellido_cliente").val(),
          direccion_cliente: $("#direccion_cliente").val(),
          telefono_cliente: $("#telefono_cliente").val(),
          id_pais: parseInt($("#id_pais").val()),
          id_ciudad: parseInt($("#id_ciudad").val()),
          email_cliente: $("#email_cliente").val(),
          accion: 'editar'        
        })
       $.ajax({
          type:"post",
          url:"./Controlador/controladorCliente.php",
          data: this.cliente,
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
              $(".box #nuevo").show(); 
              $(".box #reportes").show();
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
    }
  })
  })

  $(".box-body").on("click","a.borrar",function(){
    var data = dt.row($(this).parents("tr")).data();
    var id_cliente = data.id_cliente;
      swal({
            title: '¿Está seguro?',
            text: "¿Realmente desea borrar el cliente con codigo : " + id_cliente + " ?",
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
                      data: {codigo: id_cliente, accion:'borrar'},
                      dataType: "json"
                  })
                  request.done(function( resultado ) {
                      if(resultado.respuesta == 'correcto'){
                          swal({
                            position: 'center',
                            type: 'success',
                            title: 'El cliente con codigo ' + id_cliente + ' fue borrado',
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
  
  var id_cliente;

  $(".box-body").on("click","a.editar",function(){
    var data = dt.row($(this).parents("tr")).data();
    id_cliente = data.id_cliente;
     var pais, ciudad;
     $(".box-title").html("Actualizar Cliente");
     $(".box #nuevo").hide();
     $(".box #reportes").hide();
     $("#editar").addClass('show');
     $("#editar").removeClass('hide');
     $("#listado").addClass('hide');
     $("#listado").removeClass('show');
     $("#editar").load("./Vista/Clientes/editarCliente.php",function(){
          $.ajax({
              type:"post",
              url:"./Controlador/controladorCliente.php",
              data: {codigo: id_cliente, accion:'consultar'},
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
                      $("#email_cliente").val(cliente.email_cliente);
                      pais = cliente.id_pais;
                      ciudad = cliente.id_ciudad;
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
                      data: {codigo: pais, accion:'listar_ciudades_paises'},
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
                    '<option value="">Seleccione ...</option>').val("");
                    $.ajax({
                        type:"get",
                        url:"./Controlador/controladorCiudad.php",
                        data: {codigo: id_pais, accion:'listar_ciudades_paises'},
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

  $(".box").on("click","#reportes", function(){
    $("#modal-reportes").removeClass('modal fade show');
    $("#modal-reportes").addClass('modal fade in');
  })
   
  $("#modal-reportes").on("click","#generar_xls", function(){
    window.location.href = 'Reportes/Cliente/xls/cliente_xls.php';
  })

  $("#modal-reportes").on("click","#generar_pdf", function(){
    generarPDF();
  })
}
function Editar_objeto(obj){
  this.id_cliente = obj.id_cliente;
  this.nombre_cliente = obj.nombre_cliente;
  this.apellido_cliente = obj.apellido_cliente;
  this.direccion_cliente = obj.direccion_cliente;
  this.telefono_cliente = obj.telefono_cliente;
  this.id_pais = obj.id_pais;
  this.id_ciudad = obj.id_ciudad;
  this.email_cliente = obj.email_cliente;
  this.accion = obj.accion;
}
function generarPDF(){
  var ancho = 1000;
  var alto = 800;
  
  var x = parseInt((window.screen.width / 2) - (ancho / 2));
  var y = parseInt((window.screen.height / 2) - (alto / 2));
  
  $url = 'Reportes/Cliente/pdf/reporteCliente.php';
  window.open($url,"Cliente","left="+x+",top="+y+"height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
}