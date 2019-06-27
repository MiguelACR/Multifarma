function producto() {

  var dt = $("#tabla").DataTable({
        "ajax":"./Controlador/controladorProducto.php?accion=listar",
        "columns": [
            { "data": "id_producto" },
            { "data": "nombre_producto" },
            { "data": "nombre_presentacion"},
            { "data": "nombre_proveedor"},
            { "data": "id_producto",
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
        $(".box-title").html("Listado de Productos");
        $("#editar").addClass('hide');
        $("#editar").removeClass('show');
        $("#listado").addClass('show');
        $("#listado").removeClass('hide');  
        $(".box #nuevo").show(); 
    })

    $(".box").on("click","#nuevo", function(){
        $(this).hide();
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
                type:"get",
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
       
        if(jQuery("#foto_producto").val() != ''){
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
        else{
            swal({
                position: 'center',
                type: 'error',
                title: 'Seleccione una imagen con formato: jpg, png, gif o jpeg',
                showConfirmButton: false,
                timer: 1200
            })            
        }
      });
  
      $("#editar").on("click","button#actualizar",function(){
           var datos = new FormData($("#fproducto")[0]);

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
      });
  
      $(".box-body").on("click","a.borrar",function(){
          //Recupera datos del formulario
          var codigo = $(this).data("codigo");  
          swal({
                title: '¿Está seguro?',
                text: "¿Realmente desea borrar el producto con codigo : " + codigo + " ?",
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
                          data: {codigo: codigo, accion:'borrar'},
                          dataType: "json"
                      })
                      request.done(function( producto ) {
                          if(producto.respuesta == 'correcto'){
                            swal({
                                position: 'center',
                                type: 'success',
                                title: 'El producto con codigo ' + codigo + ' fue borrado',
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
         
         var codigo = $(this).data("codigo");
         var presentacion, proveedor;

         $(".box-title").html("Actualizar Producto")
         $("#editar").addClass('show');
         $("#editar").removeClass('hide');
         $("#listado").addClass('hide');
         $("#listado").removeClass('show'); 
         $.ajax({
            type:"get",
            url:"./Controlador/controladorProducto.php",
            data: {codigo: codigo, accion:'consultar'},
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
                  type:"get",
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
  }
  