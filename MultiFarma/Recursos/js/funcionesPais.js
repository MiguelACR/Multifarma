function pais(){

    var dt = $("#tabla").DataTable({
            "ajax": {
                      "method"   : "get",
                      "url"      : "./Controlador/controladorPais.php",
                      "data"     : {"accion":"listar"},
                      "dataType" : "json"
            },
            "columns": [
                { "data": "id_pais"} ,
                { "data": "abreviatura_pais" },
                { "data": "nombre_pais" },
                { "defaultContent": '<a href="#" class="btn btn-danger btn-sm borrar" title="Borrar pais"> <i class="fa fa-trash"></i></a>'},
        
                { "defaultContent": '<a href="#" class="btn btn-info btn-sm editar" title="Editar pais"> <i class="fa fa-edit"></i></a>'}
            ]
    });

  $("#editar").on("click",".btncerrar", function(){
      $(".box-title").html("Listado de Paises");
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
      $(".box-title").html("Crear Pais");
      $("#editar").addClass('show');
      $("#editar").removeClass('hide');
      $("#listado").addClass('hide');
      $("#listado").removeClass('show');
      $("#editar").load('./Vista/Paises/nuevoPais.php', function(){
      })
  })

  $("#editar").on("click","button#grabar",function(){
    var datos=$("#fpais").serialize();
    $('.label-danger').text('');
    $.ajax({
      type:"post",
      url:"./Validaciones/validacionPais.php",
      data: datos,
      dataType:"json"
    }).done(function( r ) {
        if(!r.response) {
            for(var k in r.errors){
                $("span[data-key='" + k + "']").text(r.errors[k]);
            }   
        }
    else{     
      var codigo = document.forms["fpais"]["id_pais"].value;
      $.ajax({
        type:"get",
        url:"./Controlador/controladorPais.php",
        data: {codigo: codigo, accion:'consultar'},
        dataType:"json"
        }).done(function( pais ) {        
          if(pais.respuesta == "no existe"){  
            if(document.forms["fpais"]["nuevo"].value === 'nuevo'){
            $.ajax({
                  type:"post",
                  url:"./Controlador/controladorPais.php",
                  data: datos,
                  dataType:"json"
                }).done(function( resultado ) {
                    if(resultado.respuesta){
                      swal({
                          position: 'center',
                          type: 'success',
                          title: 'el pais fue grabada con éxito',
                          showConfirmButton: false,
                          timer: 1200
                      })     
                          $(".box-title").html("Listado de Paises");
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
            else{
              swal({
                type: 'error',
                title: 'Oops...',
                text: 'El pais ya existe!!!!!'                         
              })
            }
          })
      }
    })
  });

  $("#editar").on("click","button#actualizar",function(){
    var datos=$("#fpais").serialize();
    $('.label-danger').text('');
    $.ajax({
      type:"post",
      url:"./Validaciones/validacionPais.php",
      data: datos,
      dataType:"json"
    }).done(function( r ) {
        if(!r.response) {
            for(var k in r.errors){
                $("span[data-key='" + k + "']").text(r.errors[k]);
            }
        }
       else{
        this.pais = new Editar_objeto({
          id_pais: id_pais,
          abreviatura_pais: $("#abreviatura_pais").val(),
          nombre_pais: $("#nombre_pais").val(),
          accion: 'editar'        
        })
       $.ajax({
          type:"post",
          url:"./Controlador/controladorPais.php",
          data: this.pais,
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
              $(".box-title").html("Listado de Paises");
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
    var id_pais = data.id_pais;
      swal({
            title: '¿Está seguro?',
            text: "¿Realmente desea borrar el pais con codigo : " + id_pais + " ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrarlo!'
      }).then((decision) => {
              if (decision.value) {
                  var request = $.ajax({
                      method: "post",                  
                      url: "./Controlador/controladorPais.php",
                      data: {codigo: id_pais, accion:'borrar'},
                      dataType: "json"
                  })
                  request.done(function( resultado ) {
                      if(resultado.respuesta == 'correcto'){
                          swal({
                            position: 'center',
                            type: 'success',
                            title: 'El pais con codigo ' + id_pais + ' fue borrada',
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
  
  var id_pais;

  $(".box-body").on("click","a.editar",function(){
    var data = dt.row($(this).parents("tr")).data();
    id_pais = data.id_pais;
     $(".box-title").html("Actualizar Pais");
     $(".box #nuevo").hide();
     $(".box #reportes").hide();
     $("#editar").addClass('show');
     $("#editar").removeClass('hide');
     $("#listado").addClass('hide');
     $("#listado").removeClass('show');
     $("#editar").load("./Vista/Paises/editarPais.php",function(){
          $.ajax({
              type:"get",
              url:"./Controlador/controladorPais.php",
              data: {codigo: id_pais, accion:'consultar'},
              dataType:"json"
              }).done(function( pais ) {        
                  if(pais.respuesta === "no existe"){
                      swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Pais no existe!'                         
                      })
                  } else {               
                      $("#id_pais").val(pais.codigo);
                      $("#abreviatura_pais").val(pais.abreviatura);
                      $("#nombre_pais").val(pais.pais);
                   }  
          });
      });
  })

  $(".box").on("click","#reportes", function(){
    $("#modal-reportes").removeClass('modal fade show');
    $("#modal-reportes").addClass('modal fade in');
  })
   
  $("#modal-reportes").on("click","#generar_xls", function(){
    window.location.href = 'Reportes/Pais/xls/pais_xls.php';
  })

  $("#modal-reportes").on("click","#generar_pdf", function(){
    generarPDF();
  })
}
function Editar_objeto(obj){
  this.id_pais = obj.id_pais;
  this.abreviatura_pais = obj.abreviatura_pais;
  this.nombre_pais = obj.nombre_pais;
  this.accion = obj.accion;
}
function generarPDF(){
  var ancho = 1000;
  var alto = 800;
  
  var x = parseInt((window.screen.width / 2) - (ancho / 2));
  var y = parseInt((window.screen.height / 2) - (alto / 2));
  
  $url = 'Reportes/Pais/pdf/reportePais.php';
  window.open($url,"Pais","left="+x+",top="+y+"height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
}