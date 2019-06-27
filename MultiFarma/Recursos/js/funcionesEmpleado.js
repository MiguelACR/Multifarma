function empleado(){

    var dt = $("#tabla").DataTable({
            "ajax": "./Controlador/controladorEmpleados.php?accion=listar",
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
                { "data": "id_empleado",
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
      $(".box-title").html("Listado de Empleados");
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
            '<option value="whatever">Seleccione ...</option>').val("whatever");
          $("#id_farmacia").find('option').remove().end().append(
            '<option value="whatever">Seleccione ...</option>').val("whatever");
          $("#id_pais").change(function(){
            $("#id_pais option:selected").each(function(){
            var id_pais = document.forms['fempleado']['id_pais'].value;
            $("#id_ciudad").find('option').remove().end().append(
            '<option value="whatever">Seleccione ...</option>').val("whatever");
            $.ajax({
                type:"get",
                url:"./Controlador/controladorCiudad.php",
                data: {codigo: id_pais, accion:'listarC'},
                dataType:"json"
             }).done(function( resultado ) {                    ;
                 $.each(resultado.data, function (index, value) { 
                   $("#editar #id_ciudad").append("<option value='" + value.id_ciudad + "'>" + value.nombre_ciudad + "</option>")
                 });
             });
            });             
            });
            $.ajax({
              type:"get",
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
    var codigo = document.forms["fempleado"]["id_empleado"].value;
    $.ajax({
      type:"get",
      url:"./Controlador/controladorEmpleados.php",
      data: {codigo: codigo, accion:'consultar'},
      dataType:"json"
      }).done(function( empleado ) {        
           if(empleado.respuesta == "no existe"){
            var datos=$("#fempleado").serialize();
            //console.log(datos);
            $.ajax({
                  type:"get",
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
              text: 'El empleado ya existe!!!!!'                         
            })
          }
        });
   
  });

  $("#editar").on("click","button#actualizar",function(){
       var datos=$("#fempleado").serialize();
      // console.log(datos);
       $.ajax({
          type:"get",
          url:"./Controlador/controladorEmpleados.php",
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
              $(".box-title").html("Listado de Empleados");
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
            text: "¿Realmente desea borrar el empleado con codigo : " + codigo + " ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrarlo!'
      }).then((decision) => {
              if (decision.value) {
                  var request = $.ajax({
                      method: "get",                  
                      url: "./Controlador/controladorEmpleados.php",
                      data: {codigo: codigo, accion:'borrar'},
                      dataType: "json"
                  })
                  request.done(function( resultado ) {
                      if(resultado.respuesta == 'correcto'){
                          swal({
                            position: 'center',
                            type: 'success',
                            title: 'El empleado con codigo ' + codigo + ' fue borrado',
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
     var pais, ciudad, farmacia;
     $(".box-title").html("Actualizar Empleado")
     $("#editar").addClass('show');
     $("#editar").removeClass('hide');
     $("#listado").addClass('hide');
     $("#listado").removeClass('show');
     $("#editar").load("./Vista/Empleados/editarEmpleado.php",function(){
          $.ajax({
              type:"get",
              url:"./Controlador/controladorEmpleados.php",
              data: {codigo: codigo, accion:'consultar'},
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
                      var id_pais = empleado.pais;
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
                    type:"get",
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
                    '<option value="whatever">Seleccione ...</option>').val("whatever");
                    $.ajax({
                        type:"get",
                        url:"./Controlador/controladorCiudad.php",
                        data: {codigo: id_pais, accion:'listarC'},
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
}
