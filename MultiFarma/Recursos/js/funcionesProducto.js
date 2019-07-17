function producto() {

  var dt = $("#tabla").DataTable({
        "ajax":{
            "method"   : "post",
            "url"      : "./Controlador/controladorProducto.php",
            "data"     : {"accion":"listar"},
            "dataType" : "json"
        },
        "columns": [
            { "data": "id_producto" },
            { "data": "nombre_producto" },
            { "data": "nombre_presentacion"},
            { "data": "nombre_proveedor"},
            { "data": "foto_producto",
            render: function (data) {
                return '<img src="Recursos/img/Productos/'+data+ '" width="50" height="50" class="user-image" alt="User Image"> '
                       
            }
            },
            { "defaultContent": '<a href="#" class="btn btn-danger btn-sm borrar" title="Borrar producto"> <i class="fa fa-trash"></i></a>'},
        
            { "defaultContent": '<a href="#" class="btn btn-info btn-sm editar" title="Editar producto"> <i class="fa fa-edit"></i></a>'}
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
        $(".box-title").html("Crear Producto");
        $("#editar").addClass('show');
        $("#editar").removeClass('hide');
        $("#listado").addClass('hide');
        $("#listado").removeClass('show');
        $("#editar").load('./Vista/Producto/nuevoProducto.php', function(){
            $.ajax({
               type:"get",
               url:"./Controlador/controladorPresentacion.php",
               data: {accion:'listar'},
               dataType:"json"
            }).done(function( resultado ) {                    ;
                $.each(resultado.data, function (index, value) { 
                  $("#editar #id_presentacion").append("<option value='" + value.id_presentacion + "'>" + value.nombre_presentacion + "</option>")
                });
            });
             $.ajax({
                type:"post",
                url:"./Controlador/controladorProveedor.php",
                data: {accion:'listar'},
                dataType:"json"
             }).done(function( resultado ) {                    ;
                 $.each(resultado.data, function (index, value) { 
                   $("#editar #id_proveedor").append("<option value='" + value.id_proveedor + "'>" + value.nombre_proveedor + "</option>")
                 });
             });
        });
        
    })

    $("#editar").on("click","button#grabar",function(){
    var datos = new FormData($("#fproducto")[0]);
    $('.label-danger').text('');
    $.ajax({
      type:"post",
      url:"./Validaciones/validacionProducto.php",
      data: datos,
      dataType:"json",
      contentType: false,
      processData: false
    }).done(function( r ) {
        if(!r.response) {
            for(var k in r.errors){
                $("span[data-key='" + k + "']").text(r.errors[k]);
            }   
        }
    else{       
                $.ajax({
                  type:"post",
                  url:"./Controlador/controladorProducto.php",
                  data: datos,
                  dataType:"json",
                  contentType: false,
                  processData: false
                }).done(function( resultado ) {
                  if(resultado.respuesta){
                    swal({
                        position: 'center',
                        type: 'success',
                        title: 'El producto fue grabado con éxito',
                        showConfirmButton: false,
                        timer: 1200
                    })     
                        $(".box-title").html("Listado de Productos");
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
           var datos = new FormData($("#fproducto")[0]);
           $('.label-danger').text('');
           $.ajax({
             type:"post",
             url:"./Validaciones/validacionProducto.php",
             data: datos,
             dataType:"json",
             contentType: false,
             processData: false
           }).done(function( r ) {
               if(!r.response) {
                   for(var k in r.errors){
                       $("span[data-key='" + k + "']").text(r.errors[k]);
                   }
               }
              else{
          if(typeof document.forms['fproducto']['id_producto'] != "undefined"){      
           if(id_producto == document.forms['fproducto']['id_producto'].value){
           $.ajax({
              type:"post",
              url:"./Controlador/controladorProducto.php",
              data: datos,
              dataType:"json",
              contentType: false,
              processData: false
            }).done(function( resultado ) {
                if(resultado.respuesta){    
                    swal({
                        position: 'center',
                        type: 'success',
                        title: 'Se actualizaron los datos correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    }) 
                    $(".box-title").html("Listado de Productos");
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
        var id_producto = data.id_producto; 
          swal({
                title: '¿Está seguro?',
                text: "¿Realmente desea borrar el producto con codigo : " + id_producto + " ?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Borrarlo!'
          }).then((decision) => {
                  if (decision.value) {
                      var request = $.ajax({
                          method: "post",                  
                          url: "./Controlador/controladorProducto.php",
                          data: {codigo: id_producto, accion:'borrar'},
                          dataType: "json"
                      })
                      request.done(function( producto ) {
                          if(producto.respuesta == 'correcto'){
                            swal({
                                position: 'center',
                                type: 'success',
                                title: 'El producto con codigo ' + id_producto + ' fue borrado',
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
      var id_producto;
      $(".box-body").on("click","a.editar",function(){
        var data = dt.row($(this).parents("tr")).data();
        id_producto = data.id_producto;
         $(".box-title").html("Actualizar Producto");
         $(".box #nuevo").hide();
         $(".box #reportes").hide();
         $("#editar").addClass('show');
         $("#editar").removeClass('hide');
         $("#listado").addClass('hide');
         $("#listado").removeClass('show'); 
         $.ajax({
            type:"post",
            url:"./Controlador/controladorProducto.php",
            data: {codigo: id_producto, accion:'consultar'},
            dataType:"json"
            }).done(function( producto ) {        
         if(producto.respuesta === "existe"){
         $("#editar").load("./Vista/Producto/editarProducto.php",function(){  
            $("#id_producto").val(producto.id_producto);                    
            $("#nombre_producto").val(producto.nombre_producto);
            presentacion = producto.id_presentacion;
            proveedor = producto.id_proveedor;
                $.ajax({
                type:"get",
                url:"./Controlador/controladorPresentacion.php",
                data: {accion:'listar'},
                dataType:"json"
                }).done(function( resultado ) {                      
                  $.each(resultado.data, function (index, value) { 
                  if(presentacion === value.id_presentacion){
                  $("#editar #id_presentacion").append("<option selected value='" + value.id_presentacion + "'>" + value.nombre_presentacion + "</option>")
                  }else {
                  $("#editar #id_presentacion").append("<option value='" + value.id_presentacion + "'>" + value.nombre_presentacion + "</option>")
                  }
                  });
                  });
                  $.ajax({
                  type:"post",
                  url:"./Controlador/controladorProveedor.php",
                  data: {accion:'listar'},
                  dataType:"json"
                  }).done(function( resultado ) {                      
                  $.each(resultado.data, function (index, value) { 
                  if(proveedor === value.id_proveedor){
                  $("#editar #id_proveedor").append("<option selected value='" + value.id_proveedor + "'>" + value.nombre_proveedor + "</option>")
                  }else {
                  $("#editar #id_proveedor").append("<option value='" + value.id_proveedor + "'>" + value.nombre_proveedor + "</option>")
                  }
                  });
                  });      
          });
        }
        else{
            swal({
                type: 'error',
                title: 'Oops...',
                text: 'Producto no existe!'                         
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