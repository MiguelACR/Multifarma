function nomina(){

    var dt = $("#tabla").DataTable({
        "ajax": "./Controlador/controladorNomina.php?accion=listar",
        "columns": [
            { "data": "id_nomina"} ,
            { "data": "nombre" },
            { "data": "fecha" },
            { "data": "salario_basico"} ,
            { "data": "hextrasd" },
            { "data": "hextrasn" },
            { "data": "auxilio_transporte"} ,
            { "data": "valor_hextrad" },
            { "data": "valor_hextran" },
            { "data": "dias_laborados"} ,
            { "data": "salario_devengado" },
            { "data": "pension" },
            { "data": "salud" },
            { "data": "salario_neto" },
            { "data": "id_nomina",
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
      $(".box-title").html("Listado de Nominas");
      $("#editar").addClass('hide');
      $("#editar").removeClass('show');
      $("#listado").addClass('show');
      $("#listado").removeClass('hide');  
      $(".box #nuevo").show(); 
  })  

  $(".box").on("click","#nuevo", function(){
      $(this).hide();
      $(".box-title").html("Crear Nomina");
      $("#editar").addClass('show');
      $("#editar").removeClass('hide');
      $("#listado").addClass('hide');
      $("#listado").removeClass('show');
      $("#editar").load('./Vista/Nomina/nuevoNomina.php', function(){
          $.ajax({
             type:"get",
             url:"./Controlador/controladorEmpleados.php",
             data: {accion:'listar'},
             dataType:"json"
          }).done(function( resultado ) {                    ;
              $.each(resultado.data, function (index, value) { 
                $("#editar #id_empleado").append("<option value='" + value.id_empleado + "'>" + value.nombre_empleado +" "+value.apellido_empleado + "</option>")
              });
          });
      });
      
  })

  $("#editar").on("click","button#grabar",function(){
    var datos=$("#fnomina").serialize();
    //console.log(datos);
    $.ajax({
          type:"get",
          url:"./Controlador/controladorNomina.php",
          data: datos,
          dataType:"json"
        }).done(function( resultado ) {
            if(resultado.respuesta){
              swal({
                  position: 'center',
                  type: 'success',
                  title: 'La Nomina fue grabada con éxito',
                  showConfirmButton: false,
                  timer: 1200
              })     
                  $(".box-title").html("Listado de Nomina");
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
  });

  $("#editar").on("click","button#actualizar",function(){
       var datos=$("#fnomina").serialize();
       console.log(datos);
       $.ajax({
          type:"get",
          url:"./Controlador/controladorNomina.php",
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
              $(".box-title").html("Listado Nominas");
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
            text: "¿Realmente desea borrar la nomina con codigo : " + codigo + " ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrarlo!'
      }).then((decision) => {
              if (decision.value) {
                  var request = $.ajax({
                      method: "get",                  
                      url: "./Controlador/controladorNomina.php",
                      data: {codigo: codigo, accion:'borrar'},
                      dataType: "json"
                  })
                  request.done(function( resultado ) {
                      if(resultado.respuesta == 'correcto'){
                          swal({
                            position: 'center',
                            type: 'success',
                            title: 'La nomina con codigo ' + codigo + ' fue borrada',
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
  // ESTE TOCA ACOMODARLO CASI TODO 
  $(".box-body").on("click","a.editar",function(){
     //$("#titulo").html("Editar Nomina");
     //Recupera datos del fromulario
     var codigo = $(this).data("codigo");
     var empleado;
     $(".box-title").html("Actualizar Nomina")
     $("#editar").addClass('show');
     $("#editar").removeClass('hide');
     $("#listado").addClass('hide');
     $("#listado").removeClass('show');
     $("#editar").load("./Vista/Nomina/editarNomina.php",function(){
          $.ajax({
              type:"get",
              url:"./Controlador/controladorNomina.php",
              data: {codigo: codigo, accion:'consultar'},
              dataType:"json"
              }).done(function( nomina ) {        
                  if(nomina.respuesta === "no existe"){
                      swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Nomina no existe!'                         
                      })
                  } else {
                      $("#id_nomina").val(nomina.codigo);                   
                      $("#fecha").val(nomina.fecha);
                      $("#salario_basico").val(nomina.salarioB);                   
                      $("#hextrasd").val(nomina.hextrasd);
                      $("#hextrasn").val(nomina.hextrasn);                   
                      $("#auxilio_transporte").val(nomina.auxilio);
                      $("#valor_hextrad").val(nomina.val_hextrad);                   
                      $("#valor_hextran").val(nomina.val_hextran);
                      $("#dias_laborados").val(nomina.laborados);
                      $("#salario_devengado").val(nomina.salarioD);
                      $("#pension").val(nomina.pension);
                      $("#salud").val(nomina.salud);
                      $("#salario_neto").val(nomina.salarioN);
                      empleado = nomina.empleado;
                  }
          });

          $.ajax({
              type:"get",
              url:"./Controlador/controladorEmpleados.php",
              data: {accion:'listar'},
              dataType:"json"
          }).done(function( resultado ) {                      
              $.each(resultado.data, function (index, value) { 
              if(empleado === value.id_empleado){
                  $("#editar #id_empleado").append("<option selected value='" + value.id_empleado + "'>" + value.nombre_empleado + " " + value.apellido_empleado + "</option>")
              }else {
                  $("#editar #id_empleado").append("<option value='" + value.id_empleado + "'>"  + value.nombre_empleado + " " + value.apellido_empleado + "</option>")
              }
              });
          });
      });
  })

 
}
