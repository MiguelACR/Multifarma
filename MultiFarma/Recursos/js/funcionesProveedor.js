function proveedor(){

    var dt = $("#tabla").DataTable({
            "ajax": {
             "method" : "post",
             "url"     : "./Controlador/controladorProveedor.php",
             "data"     : {"accion":"listar"},
             "dataType" : "json"   
            },
            "columns": [
                { "data": "id_proveedor"} ,
                { "data": "nombre_proveedor" },
                { "data": "nombre_pais" },
                { "data": "nombre_ciudad" },
                { "data": "direccion_proveedor" },
                { "data": "telefono_proveedor" },
                { "data": "email_proveedor" },
                { "defaultContent": '<a href="#" class="btn btn-danger btn-sm borrar" title="Borrar proveedor"> <i class="fa fa-trash"></i></a>'},
        
                { "defaultContent": '<a href="#" class="btn btn-info btn-sm editar" title="Editar proveedor"> <i class="fa fa-edit"></i></a>'}
            ]
    });

  $("#editar").on("click",".btncerrar", function(){
      $(".box-title").html("Listado de Proveedores");
      $("#editar").addClass('hide');
      $("#editar").removeClass('show');
      $("#listado").addClass('show');
      $("#listado").removeClass('hide');  
      $(".box #nuevo").show(); 
      $(".box #reportes").show();
  })  

  $(".box").on("click","#nuevo", function(){
      $(this).hide();
      $(".box #reportes").hide();
      $(".box-title").html("Crear Proveedor");
      $("#editar").addClass('show');
      $("#editar").removeClass('hide');
      $("#listado").addClass('hide');
      $("#listado").removeClass('show');
      $("#editar").load('./Vista/Proveedor/nuevoProveedor.php', function(){
      $("#id_ciudad_group").hide();
          $.ajax({
             type:"get",
             url:"./Controlador/controladorPais.php",
             data: {accion:'listar'},
             dataType:"json"
          }).done(function( resultado ) {                    ;
              $.each(resultado.data, function (index, value) { 
                $("#editar #id_pais").append("<option value='" + value.id_pais + "'>" + value.nombre_pais + "</option>")
              });
          });
          $("#id_pais").change(function(){
            $("#id_pais option:selected").each(function(){
            $("#id_ciudad_group").show();  
            var id_pais = document.forms['fproveedor']['id_pais'].value;
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
    var datos=$("#fproveedor").serialize();
    $('.label-danger').text('');
    $.ajax({
      type:"post",
      url:"./Validaciones/validacionProveedor.php",
      data: datos,
      dataType:"json"
    }).done(function( r ) {
        if(!r.response) {
            for(var k in r.errors){
                $("span[data-key='" + k + "']").text(r.errors[k]);
            }   
        }
    else{    
    var codigo = document.forms["fproveedor"]["id_proveedor"].value;
    $.ajax({
      type:"post",
      url:"./Controlador/controladorProveedor.php",
      data: {codigo: codigo, accion:'consultar'},
      dataType:"json"
      }).done(function( proveedor ) {        
           if(proveedor.respuesta == "no existe"){
            $.ajax({
                  type:"post",
                  url:"./Controlador/controladorProveedor.php",
                  data: datos,
                  dataType:"json"
                }).done(function( resultado ) {
                    if(resultado.respuesta){
                      swal({
                          position: 'center',
                          type: 'success',
                          title: 'El proveedor fue grabado con éxito',
                          showConfirmButton: false,
                          timer: 1200
                      })     
                          $(".box-title").html("Listado de Proveedores");
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
           else {
            swal({
              type: 'error',
              title: 'Oops...',
              text: 'El proveedor ya existe!!!!!'                         
            })
          }
        });
      }
    })
  });

  $("#editar").on("click","button#actualizar",function(){
    var datos = $("#fproveedor").serialize();
    $('.label-danger').text('');
      $.ajax({
        type:"post",
        url:"./Validaciones/validacionProveedor.php",
        data: datos,
        dataType:"json"
      }).done(function( r ) {
        if(!r.response) {
          for(var k in r.errors){
            $("span[data-key='" + k + "']").text(r.errors[k]);
          }
        }
        else{
          if(typeof document.forms['fproveedor']['id_proveedor'] != "undefined"){      
            if(id_proveedor == document.forms['fproveedor']['id_proveedor'].value){
              $.ajax({
                type:"post",
                url:"./Controlador/controladorProveedor.php",
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
                $(".box-title").html("Listado de Proveedor");
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
              else{
              swal({
                type: 'error',
                title: 'Oops...',
                text: 'Por favor no modificar el html!'                         
              })
            }
          }
          else{
            swal({
              type: 'error',
              title: 'Oops...',
              text: 'Por favor no borrar el html!'                         
            })
          }
            }
        })
    });

  $(".box-body").on("click","a.borrar",function(){
    var data = dt.row($(this).parents("tr")).data();
    var id_proveedor = data.id_proveedor;
      swal({
            title: '¿Está seguro?',
            text: "¿Realmente desea borrar el proveedor con codigo : " + id_proveedor + " ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrarlo!'
      }).then((decision) => {
              if (decision.value) {
                  var request = $.ajax({
                      method: "post",                  
                      url: "./Controlador/controladorProveedor.php",
                      data: {codigo: id_proveedor, accion:'borrar'},
                      dataType: "json"
                  })
                  request.done(function( resultado ) {
                      if(resultado.respuesta == 'correcto'){
                          swal({
                            position: 'center',
                            type: 'success',
                            title: 'El proveedor con codigo ' + id_proveedor + ' fue borrado',
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
  
  var id_proveedor;

  $(".box-body").on("click","a.editar",function(){
    var data = dt.row($(this).parents("tr")).data();
    id_proveedor = data.id_proveedor;
     var pais, ciudad;
     $(".box-title").html("Actualizar Proveedor");
     $(".box #nuevo").hide();
     $(".box #reportes").hide();
     $("#editar").addClass('show');
     $("#editar").removeClass('hide');
     $("#listado").addClass('hide');
     $("#listado").removeClass('show');
     $("#editar").load("./Vista/Proveedor/editarProveedor.php",function(){
          $.ajax({
              type:"post",
              url:"./Controlador/controladorProveedor.php",
              data: {codigo: id_proveedor, accion:'consultar'},
              dataType:"json"
              }).done(function( proveedor ) {        
                  if(proveedor.respuesta === "no existe"){
                      swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Proveedor no existe!'                         
                      })
                  } else {     
                      $("#id_proveedor").val(proveedor.codigo);          
                      $("#nombre_proveedor").val(proveedor.proveedor);
                      $("#direccion_proveedor").val(proveedor.direccion);
                      $("#telefono_proveedor").val(proveedor.telefono);
                      $("#email_proveedor").val(proveedor.email);
                      pais = proveedor.pais;
                      ciudad = proveedor.ciudad;
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
                    var id_pais = document.forms['fproveedor']['id_pais'].value;
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
    window.location.href = 'Reportes/Proveedor/xls/proveedor_xls.php';
  })

  $("#modal-reportes").on("click","#generar_pdf", function(){
    generarPDF();
  })
}
function generarPDF(){
  var ancho = 1000;
  var alto = 800;
  
  var x = parseInt((window.screen.width / 2) - (ancho / 2));
  var y = parseInt((window.screen.height / 2) - (alto / 2));
  
  $url = 'Reportes/Proveedor/pdf/reporteProveedor.php';
  window.open($url,"Proveedor","left="+x+",top="+y+"height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
}