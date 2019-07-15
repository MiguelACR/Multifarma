function nomina(){

    var dt = $("#tabla").DataTable({
        "ajax": {
                  "method"   : "post",
                  "url"      : "./Controlador/controladorNomina.php",
                  "data"     : {"accion":"listar"},
                  "dataType" : "json"
        },
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
            {"defaultContent": "<a href='#' class= 'btn btn-danger btn-sm borrar' title='Borrar nomina'> <i class='fa fa-trash'></i></a>"},

            {"defaultContent":"<a href='#' class='btn btn-info btn-sm editar' title='Editar nomina'> <i class='fa fa-edit'></i></a>"}            
        ]
    });

    $("#editar").on("click",".btncerrar", function(){
        $(".box-title").html("Listado de Nominas");
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
      $(".box-title").html("Crear Nomina");
      $("#editar").addClass('show');
      $("#editar").removeClass('hide');
      $("#listado").addClass('hide');
      $("#listado").removeClass('show');
      $("#editar").load('./Vista/Nomina/nuevaNomina.php', function(){
          $.ajax({
             type:"post",
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
    $('.label-danger').text('');
    $.ajax({
      type:"post",
      url:"./Validaciones/validacionNomina.php",
      data: datos,
      dataType:"json"
    }).done(function( r ) {
        if(!r.response) {
            for(var k in r.errors){
                $("span[data-key='" + k + "']").text(r.errors[k]);
            }   
        }
    else{
    if(document.forms["fnomina"]["nuevo"].value === 'nuevo'){     
    $.ajax({
          type:"post",
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
                  $(".box-title").html("Listado de Nominas");
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
    var datos=$("#fnomina").serialize();
    $('.label-danger').text('');
    $.ajax({
      type:"post",
      url:"./Validaciones/validacionNomina.php",
      data: datos,
      dataType:"json"
    }).done(function( r ) {
        if(!r.response) {
            for(var k in r.errors){
                $("span[data-key='" + k + "']").text(r.errors[k]);
            }
        }
       else{
       this.nomina = new Editar_objeto({
            id_nomina: id_nomina,
            id_empleado: $("#id_empleado").val(),
            salario_basico: $("#salario_basico").val(),
            hextrasd: $("#hextrasd").val(),
            hextrasn: $("#hextrasn").val(),
            auxilio_transporte: $("#auxilio_transporte").val(),
            valor_hextrad: $("#valor_hextrad").val(),
            valor_hextran: $("#valor_hextran").val(),
            dias_laborados: $("#dias_laborados").val(),
            accion: 'editar'        
          })
       $.ajax({
          type:"post",
          url:"./Controlador/controladorNomina.php",
          data: this.nomina,
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
    var id_nomina = data.id_nomina;
      swal({
            title: '¿Está seguro?',
            text: "¿Realmente desea borrar la nomina con codigo : " + id_nomina + " ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrarlo!'
      }).then((decision) => {
              if (decision.value) {
                  var request = $.ajax({
                      method: "post",                  
                      url: "./Controlador/controladorNomina.php",
                      data: {codigo: id_nomina, accion:'borrar'},
                      dataType: "json"
                  })
                  request.done(function( resultado ) {
                      if(resultado.respuesta == 'correcto'){
                          swal({
                            position: 'center',
                            type: 'success',
                            title: 'La nomina con codigo ' + id_nomina + ' fue borrada',
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
  
  var id_nomina;

  $(".box-body").on("click","a.editar",function(){
     var data = dt.row($(this).parents("tr")).data();
     id_nomina = data.id_nomina;
     var empleado;
     $(".box-title").html("Actualizar Nomina");
     $(".box #nuevo").hide();
     $(".box #reportes").hide();
     $("#editar").addClass('show');
     $("#editar").removeClass('hide');
     $("#listado").addClass('hide');
     $("#listado").removeClass('show');
     $("#editar").load("./Vista/Nomina/editarNomina.php",function(){
          $.ajax({
              type:"post",
              url:"./Controlador/controladorNomina.php",
              data: {codigo: id_nomina, accion:'consultar'},
              dataType:"json"
              }).done(function( nomina ) {        
                  if(nomina.respuesta === "no existe"){
                      swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Nomina no existe!'                         
                      })
                  } else {                 
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
                      $.ajax({
                        type:"post",
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
                  }
          });    
      });
  })

  $(".box").on("click","#reportes", function(){
    $("#modal-reportes").removeClass('modal fade show');
    $("#modal-reportes").addClass('modal fade in');
  })
   
  $("#modal-reportes").on("click","#generar_xls", function(){
    window.location.href = 'Reportes/Nomina/xls/nomina_xls.php';
  })

  $("#modal-reportes").on("click","#generar_pdf", function(){
    generarPDF();
  })
}
function Editar_objeto(obj){
    this.id_nomina = obj.id_nomina;
    this.id_empleado = obj.id_empleado;
    this.salario_basico = obj.salario_basico;
    this.hextrasd = obj.hextrasd;
    this.hextrasn = obj.hextrasn;
    this.auxilio_transporte = obj.auxilio_transporte;
    this.valor_hextrad = obj.valor_hextrad;
    this.valor_hextran = obj.valor_hextran;
    this.dias_laborados = obj.dias_laborados;
    this.accion = obj.accion;
  }
  function generarPDF(){
    var ancho = 1000;
    var alto = 800;
    
    var x = parseInt((window.screen.width / 2) - (ancho / 2));
    var y = parseInt((window.screen.height / 2) - (alto / 2));
    
    $url = 'Reportes/Nomina/pdf/reporteNomina.php';
    window.open($url,"Nomina","left="+x+",top="+y+"height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
  }
