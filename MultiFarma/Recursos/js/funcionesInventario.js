function inventario(){

    var dt = $("#tabla").DataTable({ 
            "ajax": "./Controlador/controladorInventario.php?accion=listar",
            "columns": [
                { "data": "nombre_farmacia"} ,
                { "data": "detalle_producto" },
                { "data": "entradas" },
                { "data": "salidas" },
                { "data": "stock" },
                { "data": "valor_unitario" },
                { "data": "valor_venta" },
                { "data": "fecha_registro" },
                {"defaultContent": "<a href='#' class= 'btn btn-danger btn-sm borrar'> <i class='fa fa-trash'></i></a>"
                +"<a href='#' class='btn btn-info btn-sm editar'> <i class='fa fa-edit'></i></a>"}
            ],
                 "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if ( aData['stock'] > 20 )
                    {
                        $(nRow).css('background-color', 'green');
                     }
                    else if (aData['stock'] <= 20 && aData['stock'] > 10){
                        $(nRow).css('background-color', 'yellow');
                    }
                    else{
                        $(nRow).css('background-color', 'red');
                    }
                 }
    });

  $("#editar").on("click",".btncerrar", function(){
      $(".box-title").html("Listado de Inventarios");
      $("#editar").addClass('hide');
      $("#editar").removeClass('show');
      $("#listado").addClass('show');
      $("#listado").removeClass('hide');  
      $(".box #nuevo").show(); 
  })  

  $(".box").on("click","#nuevo", function(){
    $(this).hide();
    $(".box-title").html("Crear Inventario");
    $("#editar").addClass('show');
    $("#editar").removeClass('hide');
    $("#listado").addClass('hide');
    $("#listado").removeClass('show');
    $("#editar").load('./Vista/Inventario/nuevoInventario.php', function(){
        $.ajax({
           type:"get",
           url:"./Controlador/controladorFarmacia.php",
           data: {accion:'listar'},
           dataType:"json"
        }).done(function( resultado ) {                    
            $.each(resultado.data, function (index, value) { 
              $("#editar #id_farmacia").append("<option value='" + value.id_farmacia + "'>" + value.nombre_farmacia + "</option>")
            });
        });
        $.ajax({
          type:"get",
          url:"./Controlador/controladorProducto.php",
          data: {accion:'listar'},
          dataType:"json"
       }).done(function( resultado ) {                    
           $.each(resultado.data, function (index, value) { 
             $("#editar #id_producto").append("<option value='" + value.id_producto + "'>" + value.nombre_producto +" "+ value.nombre_presentacion +" "+ value.nombre_proveedor + "</option>")
           });
       });
    });
    
})
 
$("#editar").on("click","button#grabar",function(){
  var id_farmacia = document.forms["finventario"]["id_farmacia"].value;
  var id_producto = document.forms["finventario"]["id_producto"].value;
  $.ajax({
    type:"get",
    url:"./Controlador/controladorInventario.php",
    data: {codigo: id_farmacia, codigoP: id_producto, accion:'consultar'},
    dataType:"json"
    }).done(function( inventario ) {        
         if(inventario.respuesta == "no existe"){
          var datos=$("#finventario").serialize();
          //console.log(datos);
          if(document.forms['finventario']['valor_unitario'].value < document.forms['finventario']['valor_venta'].value){
          $.ajax({
                type:"post",
                url:"./Controlador/controladorInventario.php",
                data: datos,
                dataType:"json"
              }).done(function( resultado ) {
                  if(resultado.respuesta){
                    swal({
                        position: 'center',
                        type: 'success',
                        title: 'El inventario fue grabado con éxito',
                        showConfirmButton: false,
                        timer: 1200
                    })     
                        $(".box-title").html("Listado de Clientes");
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
          else{
            swal({
              position: 'center',
              type: 'error',
              title: 'El valor de venta debe ser mayor que el unitario',
              showConfirmButton: false,
              timer: 1500
          })     
          }
         }
         else {
          swal({
            type: 'error',
            title: 'Oops...',
            text: 'El inventario ya existe!!!!!'                         
          })
        }
      });
 
});

  $("#editar").on("click","button#actualizar",function(){
    $("#id_farmacia").removeAttr('disabled');
    $("#id_producto").removeAttr('disabled');
    var datos=$("#finventario").serialize();

    if(document.forms['finventario']['valor_unitario'].value < document.forms['finventario']['valor_venta'].value){
        $.ajax({
          type:"post",
          url:"./Controlador/controladorInventario.php",
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
              $(".box-title").html("Listado de Inventarios");
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
        position: 'center',
        type: 'error',
        title: 'El valor de venta debe ser mayor que el unitario',
        showConfirmButton: false,
        timer: 1500
    })   
    }

  })

  $(".box-body").on("click","a.borrar",function(){
    var data = dt.row($(this).parents("tr")).data();
    var id_farmacia = data.id_farmacia;
    var id_producto = data.id_producto;

    swal({
          title: '¿Está seguro?',
          text: "¿Realmente desea borrar el inventario con el codigo de farmacia : " + id_farmacia + 
          " y codigo de producto: "+id_producto+" ?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, Borrarlo!'
    }).then((decision) => {
            if (decision.value) {
                var request = $.ajax({
                    method: "post",                  
                    url: "./Controlador/controladorInventario.php",
                    data: {codigo: id_farmacia,codigoP: id_producto, accion:'borrar'},
                    dataType: "json"
                })
                request.done(function( resultado ) {
                    if(resultado.respuesta == 'correcto'){
                        swal({
                          position: 'center',
                          type: 'success',
                          title: 'El inventario con codigo de farmacia: ' + id_farmacia +
                          " y codigo de producto: "+ id_producto+ ' fue borrado',
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
     var data = dt.row($(this).parents("tr")).data();
     var id_farmacia = data.id_farmacia;
     var id_producto = data.id_producto;
     var farmacia, producto;
     $(".box-title").html("Actualizar Inventario")
     $("#editar").addClass('show');
     $("#editar").removeClass('hide');
     $("#listado").addClass('hide');
     $("#listado").removeClass('show');
     $("#editar").load("./Vista/Inventario/editarInventario.php",function(){
      $("#id_farmacia").attr('disabled','true');
      $("#id_producto").attr('disabled','true');
          $.ajax({
              type:"get",
              url:"./Controlador/controladorInventario.php",
              data: {codigo: id_farmacia, codigoP: id_producto, accion:'consultar'},
              dataType:"json"
              }).done(function( inventario ) {        
                  if(inventario.respuesta === "no existe"){
                      swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Inventario no existe!'                         
                      })
                  } else {                 
                      $("#entradas").val(inventario.entradas);
                      $("#salidas").val(inventario.salidas);
                      $("#stock").val(inventario.stock);
                      $("#valor_unitario").val(inventario.valor_unitario);
                      $("#valor_venta").val(inventario.valor_venta);
                      $("#fecha_registro").val(inventario.fecha_registro);
                      farmacia = inventario.id_farmacia;
                      producto = inventario.id_producto;

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

                        $.ajax({
                          type:"get",
                          url:"./Controlador/controladorProducto.php",
                          data: {accion:'listar'},
                          dataType:"json"
                          }).done(function( resultado ) {                      
                          $.each(resultado.data, function (index, value) { 
                          if(producto === value.id_producto){
                          $("#editar #id_producto").append("<option selected value='" + value.id_producto + "'>" + value.nombre_producto +" "+ value.nombre_presentacion +" "+ value.nombre_proveedor + "</option>")
                          }else {
                          $("#editar #id_producto").append("<option value='" + value.id_producto + "'>" + value.nombre_producto +" "+ value.nombre_presentacion +" "+ value.nombre_proveedor + "</option>")
                          }
                          });
                          }); 
                  }
          });
      });
  })
}