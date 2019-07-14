function farmacia(){

    var dt = $("#tabla").DataTable({
            "ajax": {
                      "method"   : "post",
                      "url"      : "./Controlador/controladorFarmacia.php",
                      "data"     : {"accion":"listar"},
                      "dataType" : "json"
            },
            "columns": [
                { "data": "id_farmacia"} ,
                { "data": "nombre_farmacia" },
                { "data": "direccion_farmacia" },
                { "data": "telefono_farmacia" },
                { "data": "nombre_pais" },
                { "data": "nombre_ciudad" },
                { "data": "nombre_propietario"},
                { "data": "nickname_usuario"},
                { "defaultContent": '<a href="#" class="btn btn-danger btn-sm borrar" title="Borrar farmacia"> <i class="fa fa-trash"></i></a>'},
        
                { "defaultContent": '<a href="#" class="btn btn-info btn-sm editar" title="Editar farmacia"> <i class="fa fa-edit"></i></a>'}
            ]
    });

  $("#editar").on("click",".btncerrar", function(){
      $(".box-title").html("Listado de Farmacias");
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
      $(".box-title").html("Crear Farmacia");
      $("#editar").addClass('show');
      $("#editar").removeClass('hide');
      $("#listado").addClass('hide');
      $("#listado").removeClass('show');
      $("#editar").load('./Vista/Farmacia/nuevaFarmacia.php', function(){
        $("#id_ciudad_group").hide();
        $("#id_usuario_group").hide();
        $("#id_farmacia_group").hide();
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
          $.ajax({
            type:"post",
            url:"./Controlador/controladorPropietario.php",
            data: {accion:'listar'},
            dataType:"json"
         }).done(function( resultado ) {                    
             $.each(resultado.data, function (index, value) { 
               $("#editar #id_propietario").append("<option value='" + value.id_propietario + "'>" + value.nombre_propietario +' '+ value.apellido_propietario + "</option>")
             });
         });
          $.ajax({
            type:"get",
            url:"./Controlador/controladorRoles.php",
            data: {accion:'listar'},
            dataType:"json"
         }).done(function( resultado ) {                    
             $.each(resultado.data, function (index, value) { 
               $("#editar #id_rol").append("<option value='" + value.id_rol + "'>" + value.nombre_rol + "</option>")
             });
         });
          $("#id_pais").change(function(){
            $("#id_pais option:selected").each(function(){
            $("#id_ciudad_group").show();  
            var id_pais = document.forms['ffarmacia']['id_pais'].value;
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
            $("#id_rol").change(function(){
              $("#id_rol option:selected").each(function(){
              $("#id_usuario_group").show();  
              var id_rol = document.forms['ffarmacia']['id_rol'].value;
              $("#id_usuario").find('option').remove().end().append(
              '<option value="">Seleccione ...</option>').val("");
              $.ajax({
                  type:"post",
                  url:"./Controlador/controladorUsuarios.php",
                  data: {codigo: id_rol, accion:'listar_usuarios_roles'},
                  dataType:"json"
               }).done(function( resultado ) {                    
                   $.each(resultado.data, function (index, value) { 
                     $("#editar #id_usuario").append("<option value='" + value.id_usuario + "'>" + value.nickname_usuario + "</option>")
                   });
               });
              });             
              });
      });
      
  })

  $("#editar").on("click","button#grabar",function(){
    var datos=$("#ffarmacia").serialize();
    $('.label-danger').text('');
    $.ajax({
      type:"post",
      url:"./Validaciones/validacionFarmacia.php",
      data: datos,
      dataType:"json"
    }).done(function( r ) {
        if(!r.response) {
            for(var k in r.errors){
                $("span[data-key='" + k + "']").text(r.errors[k]);
            }   
        }
    else{       
            if(document.forms["ffarmacia"]["nuevo"].value === 'nuevo'){
            $.ajax({
                  type:"post",
                  url:"./Controlador/controladorFarmacia.php",
                  data: datos,
                  dataType:"json"
                }).done(function( resultado ) {
                    if(resultado.respuesta){
                      swal({
                          position: 'center',
                          type: 'success',
                          title: 'La farmacia fue grabada con éxito',
                          showConfirmButton: false,
                          timer: 1200
                      })     
                          $(".box-title").html("Listado de Farmacias");
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
    })
  });

  $("#editar").on("click","button#actualizar",function(){
    var datos=$("#ffarmacia").serialize();
    $('.label-danger').text('');
    $.ajax({
      type:"post",
      url:"./Validaciones/validacionFarmacia.php",
      data: datos,
      dataType:"json"
    }).done(function( r ) {
        if(!r.response) {
            for(var k in r.errors){
                $("span[data-key='" + k + "']").text(r.errors[k]);
            }
        }
       else{
        this.farmacia = new Editar_objeto({
          id_farmacia: id_farmacia,
          nombre_farmacia: $("#nombre_farmacia").val(),
          direccion_farmacia: $("#direccion_farmacia").val(),
          telefono_farmacia: $("#telefono_farmacia").val(),
          id_pais: parseInt($("#id_pais").val()),
          id_ciudad: parseInt($("#id_ciudad").val()),
          id_propietario: $("#id_propietario").val(),
          id_usuario: $("#id_usuario").val(),
          accion: 'editar'        
        })
       $.ajax({
          type:"post",
          url:"./Controlador/controladorFarmacia.php",
          data: this.farmacia,
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
              $(".box-title").html("Listado de Farmacias");
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
    var id_farmacia = data.id_farmacia;
      swal({
            title: '¿Está seguro?',
            text: "¿Realmente desea borrar la farmacia con codigo : " + id_farmacia + " ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrarlo!'
      }).then((decision) => {
              if (decision.value) {
                  var request = $.ajax({
                      method: "post",                  
                      url: "./Controlador/controladorFarmacia.php",
                      data: {codigo: id_farmacia, accion:'borrar'},
                      dataType: "json"
                  })
                  request.done(function( resultado ) {
                      if(resultado.respuesta == 'correcto'){
                          swal({
                            position: 'center',
                            type: 'success',
                            title: 'La farmacia con codigo ' + id_farmacia + ' fue borrada',
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
  
  var id_farmacia;

  $(".box-body").on("click","a.editar",function(){
    var data = dt.row($(this).parents("tr")).data();
    id_farmacia = data.id_farmacia;
     var pais, ciudad, propietario, rol,usuario;
     $(".box-title").html("Actualizar Farmacia");
     $(".box #nuevo").hide();
     $(".box #reportes").hide();
     $("#editar").addClass('show');
     $("#editar").removeClass('hide');
     $("#listado").addClass('hide');
     $("#listado").removeClass('show');
     $("#editar").load("./Vista/Farmacia/editarFarmacia.php",function(){
          $.ajax({
              type:"post",
              url:"./Controlador/controladorFarmacia.php",
              data: {codigo: id_farmacia, accion:'consultar'},
              dataType:"json"
              }).done(function( farmacia ) {        
                  if(farmacia.respuesta === "no existe"){
                      swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Farmacia no existe!'                         
                      })
                  } else {               
                      $("#nombre_farmacia").val(farmacia.farmacia);
                      $("#direccion_farmacia").val(farmacia.direccion);
                      $("#telefono_farmacia").val(farmacia.telefono);
                      pais = farmacia.pais;
                      ciudad = farmacia.ciudad;
                      propietario = farmacia.propietario;
                      rol = farmacia.rol;
                      usuario = farmacia.administrador;
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
                    $.ajax({
                      type:"post",
                      url:"./Controlador/controladorPropietario.php",
                      data: {accion:'listar'},
                      dataType:"json"
                   }).done(function( resultado ) {                      
                       $.each(resultado.data, function (index, value) { 
                          if(propietario === value.id_propietario){
                          $("#editar #id_propietario").append("<option selected value='" + value.id_propietario + "'>" + value.nombre_propietario +' '+ value.apellido_propietario + "</option>")
                          }else {
                          $("#editar #id_propietario").append("<option value='" + value.id_propietario + "'>" + value.nombre_propietario +' '+ value.apellido_propietario + "</option>")
                          }
                       });
                   });
                    $.ajax({
                      type:"get",
                      url:"./Controlador/controladorRoles.php",
                      data: {accion:'listar'},
                      dataType:"json"
                   }).done(function( resultado ) {                      
                      $.each(resultado.data, function (index, value) { 
                         if(rol === value.id_rol){
                         $("#editar #id_rol").append("<option selected value='" + value.id_rol + "'>" + value.nombre_rol + "</option>")
                         }else {
                         $("#editar #id_rol").append("<option value='" + value.id_rol + "'>" + value.nombre_rol + "</option>")
                         }
                     });
                   });
                   $.ajax({
                    type:"post",
                    url:"./Controlador/controladorUsuarios.php",
                    data: {codigo: rol, accion:'listar_usuarios_roles'},
                    dataType:"json"
                 }).done(function( resultado ) {                    
                     $.each(resultado.data, function (index, value) { 
                        if(usuario === value.id_usuario){
                        $("#editar #id_usuario").append("<option selected value='" + value.id_usuario + "'>" + value.nickname_usuario + "</option>")
                        }
                        else{
                        $("#editar #id_usuario").append("<option value='" + value.id_usuario + "'>" + value.nickname_usuario + "</option>")
                        } 
                     });
                 });

                   }
                  $("#id_pais").change(function(){
                    $("#id_pais option:selected").each(function(){
                    var id_pais = document.forms['ffarmacia']['id_pais'].value;
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
                  $("#id_rol").change(function(){
                      $("#id_rol option:selected").each(function(){
                      var id_rol = document.forms['ffarmacia']['id_rol'].value;
                      $("#id_usuario").find('option').remove().end().append(
                      '<option value="">Seleccione ...</option>').val("");
                    $.ajax({
                        type:"post",
                        url:"./Controlador/controladorUsuarios.php",
                        data: {codigo: id_rol, accion:'listar_usuarios_roles'},
                        dataType:"json"
                     }).done(function( resultado ) {                    
                        $.each(resultado.data, function (index, value) {           
                           $("#editar #id_usuario").append("<option value='" + value.id_usuario + "'>" + value.nickname_usuario + "</option>") 
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
    window.location.href = 'Reportes/Farmacia/xls/farmacia_xls.php';
  })

  $("#modal-reportes").on("click","#generar_pdf", function(){
    generarPDF();
  })
}
function Editar_objeto(obj){
  this.id_farmacia = obj.id_farmacia;
  this.nombre_farmacia = obj.nombre_farmacia;
  this.direccion_farmacia = obj.direccion_farmacia;
  this.telefono_farmacia = obj.telefono_farmacia;
  this.id_pais = obj.id_pais;
  this.id_ciudad = obj.id_ciudad;
  this.id_propietario = obj.id_propietario;
  this.id_usuario = obj.id_usuario;
  this.accion = obj.accion;
}
function generarPDF(){
  var ancho = 1000;
  var alto = 800;
  
  var x = parseInt((window.screen.width / 2) - (ancho / 2));
  var y = parseInt((window.screen.height / 2) - (alto / 2));
  
  $url = 'Reportes/Farmacia/pdf/reporteFarmacia.php';
  window.open($url,"Farmacia","left="+x+",top="+y+"height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
}