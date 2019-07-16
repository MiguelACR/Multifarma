function presentacion() {

    var dt = $("#tabla").DataTable({
          "ajax":{
              "method"   : "get",
              "url"      : "./Controlador/controladorPresentacion.php",
              "data"     : {"accion":"listar"},
              "dataType" : "json"
          },
          "columns": [
              { "data": "id_presentacion" },
              { "data": "nombre_presentacion"},
              { "defaultContent": '<a href="#" class="btn btn-danger btn-sm borrar" title="Borrar presentacion"> <i class="fa fa-trash"></i></a>'},
          
              { "defaultContent": '<a href="#" class="btn btn-info btn-sm editar" title="Editar presentacion"> <i class="fa fa-edit"></i></a>'}
          ]
      });
  
     
    $("#editar").on("click",".btncerrar", function(){
      $(".box-title").html("Listado de Productos");
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
          $(".box-title").html("Crear Presentacion");
          $("#editar").addClass('show');
          $("#editar").removeClass('hide');
          $("#listado").addClass('hide');
          $("#listado").removeClass('show');
          $("#editar").load('./Vista/Presentacion/nuevaPresentacion.php', function(){
             
          });
          
      })
  
      $("#editar").on("click","button#grabar",function(){
      var datos = $("#fpresentacion").serialize();
      $('.label-danger').text('');
      $.ajax({
        type:"post",
        url:"./Validaciones/validacionPresentacion.php",
        data: datos,
        dataType:"json"
      }).done(function( r ) {
          if(!r.response) {
              for(var k in r.errors){
                  $("span[data-key='" + k + "']").text(r.errors[k]);
              }   
          }
      else{       
                  $.ajax({
                    type:"post",
                    url:"./Controlador/controladorPresentacion.php",
                    data: datos,
                    dataType:"json"
                  }).done(function( resultado ) {
                    if(resultado.respuesta){
                      swal({
                          position: 'center',
                          type: 'success',
                          title: 'La presentacion fue grabada con éxito',
                          showConfirmButton: false,
                          timer: 1200
                      })     
                          $(".box-title").html("Listado de Presentaciones");
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
                          title: 'Ocurrió un error al grabar',
                          showConfirmButton: false,
                          timer: 1500
                      });
                     
                  }
              });    
      }
      })
      });
    
        $("#editar").on("click","button#actualizar",function(){
            var datos = $("#fpresentacion").serialize();
             $('.label-danger').text('');
             $.ajax({
               type:"post",
               url:"./Validaciones/validacionPresentacion.php",
               data: datos,
               dataType:"json"
             }).done(function( r ) {
                 if(!r.response) {
                     for(var k in r.errors){
                         $("span[data-key='" + k + "']").text(r.errors[k]);
                     }
                 }
                else{
            if(typeof document.forms['fpresentacion']['id_presentacion'] != "undefined"){      
             if(id_presentacion == document.forms['fpresentacion']['id_presentacion'].value){
             $.ajax({
                type:"post",
                url:"./Controlador/controladorPresentacion.php",
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
                      $(".box-title").html("Listado de Presentaciones");
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
          var id_presentacion = data.id_presentacion; 
            swal({
                  title: '¿Está seguro?',
                  text: "¿Realmente desea borrar la presentacion con codigo : " + id_presentacion + " ?",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, Borrarlo!'
            }).then((decision) => {
                    if (decision.value) {
                        var request = $.ajax({
                            method: "post",                  
                            url: "./Controlador/controladorPresentacion.php",
                            data: {codigo: id_presentacion, accion:'borrar'},
                            dataType: "json"
                        })
                        request.done(function( producto ) {
                            if(producto.respuesta == 'correcto'){
                              swal({
                                  position: 'center',
                                  type: 'success',
                                  title: 'La presentacion con codigo ' + id_presentacion + ' fue borrado',
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

        var id_presentacion;

        $(".box-body").on("click","a.editar",function(){
          var data = dt.row($(this).parents("tr")).data();
          id_presentacion = data.id_presentacion;
           $(".box-title").html("Actualizar Presentacion");
           $(".box #nuevo").hide();
           $(".box #reportes").hide();
           $("#editar").addClass('show');
           $("#editar").removeClass('hide');
           $("#listado").addClass('hide');
           $("#listado").removeClass('show'); 
           $.ajax({
              type:"get",
              url:"./Controlador/controladorPresentacion.php",
              data: {codigo: id_presentacion, accion:'consultar'},
              dataType:"json"
              }).done(function( presentacion ) {        
           if(presentacion.respuesta === "existe"){
           $("#editar").load("./Vista/Presentacion/editarPresentacion.php",function(){ 
              $("#id_presentacion").val(presentacion.codigo);  
              $("#nombre_presentacion").val(presentacion.presentacion);
            });
          }
          else{
              swal({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Presentacion no existe!'                         
                  })
          }
       });
        })
        $(".box").on("click","#reportes", function(){
          $("#modal-reportes").removeClass('modal fade show');
          $("#modal-reportes").addClass('modal fade in');
        })
         
        $("#modal-reportes").on("click","#generar_xls", function(){
          window.location.href = 'Reportes/Producto/xls/producto_xls.php';
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
      
      $url = 'Reportes/Producto/pdf/reporteProducto.php';
      window.open($url,"Producto","left="+x+",top="+y+"height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
    }