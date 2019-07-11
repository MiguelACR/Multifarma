function empleado(){

    var dt = $("#tabla").DataTable({
            "ajax": {
             "method" : "post",
             "url"     : "./Controlador/controladorEmpleados.php",
             "data"     : {"accion":"listar"},
             "dataType" : "json"   
            },
            "columns": [
                { "data": "id_empleado"} ,
                { "data": "nombre_empleado" },
                { "data": "apellido_empleado" },
                { "data": "cargo_empleado" },
                { "data": "nombre_pais" },
                { "data": "nombre_ciudad" },
                { "data": "direccion_empleado" },
                { "data": "telefono_empleado" },
                { "data": "email_empleado" },
                { "data": "nombre_farmacia" },
                { "defaultContent": '<a href="#" class="btn btn-danger btn-sm borrar" title="Borrar empleado"> <i class="fa fa-trash"></i></a>'},
        
                { "defaultContent": '<a href="#" class="btn btn-info btn-sm editar" title="Editar empleado"> <i class="fa fa-edit"></i></a>'}
            ]
    });

  $("#editar").on("click",".btncerrar", function(){
      $(".box-title").html("Listado de Empleados");
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
      $(".box-title").html("Crear Empleado");
      $("#editar").addClass('show');
      $("#editar").removeClass('hide');
      $("#listado").addClass('hide');
      $("#listado").removeClass('show');
      $("#editar").load('./Vista/Empleados/nuevoEmpleado.php', function(){
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
          $("#id_pais").find('option').remove().end().append(
            '<option value="">Seleccione ...</option>').val("");
          $("#id_farmacia").find('option').remove().end().append(
            '<option value="">Seleccione ...</option>').val("");
          $("#id_pais").change(function(){
            $("#id_pais option:selected").each(function(){
            var id_pais = document.forms['fempleado']['id_pais'].value;
            $("#id_ciudad").find('option').remove().end().append(
            '<option value="">Seleccione ...</option>').val("");
            $.ajax({
                type:"get",
                url:"./Controlador/controladorCiudad.php",
                data: {codigo: id_pais, accion:'listar_ciudades_paises'},
                dataType:"json"
             }).done(function( resultado ) {                    ;
                 $.each(resultado.data, function (index, value) { 
                   $("#editar #id_ciudad").append("<option value='" + value.id_ciudad + "'>" + value.nombre_ciudad + "</option>")
                 });
             });
            });             
            });
            $.ajax({
              type:"post",
              url:"./Controlador/controladorFarmacia.php",
              data: {accion:'listar'},
              dataType:"json"
           }).done(function( resultado ) {                    ;
               $.each(resultado.data, function (index, value) { 
                 $("#editar #id_farmacia").append("<option value='" + value.id_farmacia + "'>" + value.nombre_farmacia + "</option>")
               });
           });
      });
      
  })

  $("#editar").on("click","button#grabar",function(){
    var datos=$("#fempleado").serialize();
    $('.label-danger').text('');
    $.ajax({
      type:"post",
      url:"./Validaciones/validacionEmpleado.php",
      data: datos,
      dataType:"json"
    }).done(function( r ) {
        if(!r.response) {
            for(var k in r.errors){
                $("span[data-key='" + k + "']").text(r.errors[k]);
            }   
        }
    else{    
    var codigo = document.forms["fempleado"]["id_empleado"].value;
    $.ajax({
      type:"post",
      url:"./Controlador/controladorEmpleados.php",
      data: {codigo: codigo, accion:'consultar'},
      dataType:"json"
      }).done(function( empleado ) {        
           if(empleado.respuesta == "no existe"){
            if(document.forms["fempleado"]["nuevo"].value === 'nuevo'){
            $.ajax({
                  type:"post",
                  url:"./Controlador/controladorEmpleados.php",
                  data: datos,
                  dataType:"json"
                }).done(function( resultado ) {
                    if(resultado.respuesta){
                      swal({
                          position: 'center',
                          type: 'success',
                          title: 'El empleado fue grabada con éxito',
                          showConfirmButton: false,
                          timer: 1200
                      })     
                          $(".box-title").html("Listado de Empleados");
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
              text: 'El empleado ya existe!!!!!'                         
            })
          }
        });
      }
    })
  });

  $("#editar").on("click","button#actualizar",function(){
    var datos=$("#fempleado").serialize();
    $('.label-danger').text('');
    $.ajax({
      type:"post",
      url:"./Validaciones/validacionEmpleado.php",
      data: datos,
      dataType:"json"
    }).done(function( r ) {
        if(!r.response) {
            for(var k in r.errors){
                $("span[data-key='" + k + "']").text(r.errors[k]);
            }
        }
      else{
        this.empleado = new Editar_objeto({
          id_empleado: id_empleado,
          nombre_empleado: $("#nombre_empleado").val(),
          apellido_empleado: $("#apellido_empleado").val(),
          cargo_empleado: $("#cargo_empleado").val(),
          id_pais: parseInt($("#id_pais").val()),
          id_ciudad: parseInt($("#id_ciudad").val()),
          direccion_empleado: $("#direccion_empleado").val(),
          telefono_empleado: $("#telefono_empleado").val(),
          email_empleado: $("#email_empleado").val(),
          id_farmacia: parseInt($("#id_farmacia").val()),
          accion: 'editar'        
        })
       $.ajax({
          type:"post",
          url:"./Controlador/controladorEmpleados.php",
          data: this.empleado,
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
              $(".box-title").html("Listado de Empleados");
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
    var id_empleado = data.id_empleado;
      swal({
            title: '¿Está seguro?',
            text: "¿Realmente desea borrar el empleado con codigo : " + id_empleado + " ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrarlo!'
      }).then((decision) => {
              if (decision.value) {
                  var request = $.ajax({
                      method: "post",                  
                      url: "./Controlador/controladorEmpleados.php",
                      data: {codigo: id_empleado, accion:'borrar'},
                      dataType: "json"
                  })
                  request.done(function( resultado ) {
                      if(resultado.respuesta == 'correcto'){
                          swal({
                            position: 'center',
                            type: 'success',
                            title: 'El empleado con codigo ' + id_empleado + ' fue borrado',
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
  
  var id_empleado;

  $(".box-body").on("click","a.editar",function(){
    var data = dt.row($(this).parents("tr")).data();
    id_empleado = data.id_empleado;
     var pais, ciudad, farmacia;
     $(".box-title").html("Actualizar Empleado")
     $("#editar").addClass('show');
     $("#editar").removeClass('hide');
     $("#listado").addClass('hide');
     $("#listado").removeClass('show');
     $("#editar").load("./Vista/Empleados/editarEmpleado.php",function(){
          $.ajax({
              type:"post",
              url:"./Controlador/controladorEmpleados.php",
              data: {codigo: id_empleado, accion:'consultar'},
              dataType:"json"
              }).done(function( empleado ) {        
                  if(empleado.respuesta === "no existe"){
                      swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Empleado no existe!'                         
                      })
                  } else {
                      $("#id_empleado").val(empleado.codigo);                   
                      $("#nombre_empleado").val(empleado.nombre);
                      $("#apellido_empleado").val(empleado.apellido);
                      $("#cargo_empleado").val(empleado.cargo);
                      $("#direccion_empleado").val(empleado.direccion);
                      $("#telefono_empleado").val(empleado.telefono);
                      $("#email_empleado").val(empleado.email);
                      pais = empleado.pais;
                      ciudad = empleado.ciudad;
                      farmacia = empleado.farmacia;
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
                   }).done(function( resultado ) {                    ;
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
                    url:"./Controlador/controladorFarmacia.php",
                    data: {accion:'listar'},
                    dataType:"json"
                }).done(function( resultado ) {                      
                    $.each(resultado.data, function (index, value) { 
                    if(farmacia === value.id_farmacia){
                        $("#editar #id_farmacia").append("<option selected value='" + value.id_farmacia + "'>" + value.nombre_farmacia + "</option>")
                    }else {
                        $("#editar #id_farmacia").append("<option value='" + value.id_farmacia + "'>" + value.nombre_farmacia + "</option>")
                    }
                    });
                });
                  }
                  $("#id_pais").change(function(){
                    $("#id_pais option:selected").each(function(){
                    var id_pais = document.forms['fempleado']['id_pais'].value;
                    $("#id_ciudad").find('option').remove().end().append(
                    '<option value="">Seleccione ...</option>').val("");
                    $.ajax({
                        type:"get",
                        url:"./Controlador/controladorCiudad.php",
                        data: {codigo: id_pais, accion:'listar_ciudades_paises'},
                        dataType:"json"
                     }).done(function( resultado ) {                    ;
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
    window.location.href = 'Reportes/Empleado/xls/empleado_xls.php';
  })

  $("#modal-reportes").on("click","#generar_pdf", function(){
    generarPDF();
  })
}
function Editar_objeto(obj){
  this.id_empleado = obj.id_empleado;
  this.nombre_empleado = obj.nombre_empleado;
  this.apellido_empleado = obj.apellido_empleado;
  this.cargo_empleado = obj.cargo_empleado;
  this.id_pais = obj.id_pais;
  this.id_ciudad = obj.id_ciudad;
  this.direccion_empleado = obj.direccion_empleado;
  this.telefono_empleado = obj.telefono_empleado;
  this.email_empleado = obj.email_empleado;
  this.id_farmacia = obj.id_farmacia;
  this.accion = obj.accion;
}
function generarPDF(){
  var ancho = 1000;
  var alto = 800;
  
  var x = parseInt((window.screen.width / 2) - (ancho / 2));
  var y = parseInt((window.screen.height / 2) - (alto / 2));
  
  $url = 'Reportes/Empleado/pdf/reporteEmpleado.php';
  window.open($url,"Empleado","left="+x+",top="+y+"height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
}