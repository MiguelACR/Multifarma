function inventario(){

    var dt = $("#tabla").DataTable({ 
            "ajax": {
                       "method"   : "post",
                       "url"      : "./Controlador/controladorInventario.php",
                       "data"     : {"accion":"listar"},
                       "dataType" : "json"
                    },
                "columns": [
                { "data": "nombre_farmacia"} ,
                { "data": "detalle_producto" },
                { "data": "entradas" },
                { "data": "salidas" },
                { "data": "stock" },
                { "data": "valor_unitario" },
                { "data": "valor_venta" },
                { "data": "fecha_registro" },
                {"defaultContent": "<a href='#' class= 'btn btn-danger btn-sm borrar' title='Borrar inventario'> <i class='fa fa-trash'></i></a>"},

                {"defaultContent":"<a href='#' class='btn btn-info btn-sm editar' title='Editar inventario'> <i class='fa fa-edit'></i></a>"}
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
      $(".box #reportes").show();
  })   

  $(".box").on("click","#nuevo", function(){
    $(this).hide();
    $(".box #reportes").hide();
    $(".box-title").html("Crear Inventario");
    $("#editar").addClass('show');
    $("#editar").removeClass('hide');
    $("#listado").addClass('hide');
    $("#listado").removeClass('show');
    $("#editar").load('./Vista/Inventario/nuevoInventario.php', function(){
        $.ajax({
           type:"post",
           url:"./Controlador/controladorFarmacia.php",
           data: {accion:'listar'},
           dataType:"json"
        }).done(function( resultado ) {                    
            $.each(resultado.data, function (index, value) { 
              $("#editar #id_farmacia").append("<option value='" + value.id_farmacia + "'>" + value.nombre_farmacia + "</option>")
            });
        });
        $.ajax({
          type:"post",
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
  var datos=$("#finventario").serialize();
    $('.label-danger').text('');
    $.ajax({
      type:"post",
      url:"./Validaciones/validacionInventario.php",
      data: datos,
      dataType:"json"
    }).done(function( r ) {
        if(!r.response) {
            for(var k in r.errors){
                $("span[data-key='" + k + "']").text(r.errors[k]);
            }   
        }
    else{       
  var id_farmacia = document.forms["finventario"]["id_farmacia"].value;
  var id_producto = document.forms["finventario"]["id_producto"].value;
  $.ajax({
    type:"post",
    url:"./Controlador/controladorInventario.php",
    data: {codigo: id_farmacia, codigoP: id_producto, accion:'consultar'},
    dataType:"json"
    }).done(function( inventario ) {        
     if(inventario.respuesta == "no existe"){
      if(document.forms['finventario']['valor_unitario'].value < document.forms['finventario']['valor_venta'].value){
          if(document.forms["finventario"]["nuevo"].value === 'nuevo'){
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
                        $(".box-title").html("Listado de Inventarios");
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
    }
  })
});

  $("#editar").on("click","button#actualizar",function(){
    var datos=$("#finventario").serialize();
    $('.label-danger').text('');
    $.ajax({
      type:"post",
      url:"./Validaciones/validacionInventario.php",
      data: datos,
      dataType:"json"
    }).done(function( r ) {
        if(!r.response) {
            for(var k in r.errors){
                $("span[data-key='" + k + "']").text(r.errors[k]);
            }
        }
       else{
    if(document.forms['finventario']['valor_unitario'].value < document.forms['finventario']['valor_venta'].value){
      this.inventario = new Editar_objeto({
        id_farmacia: id_farmacia,
        id_producto: id_producto,
        entradas: $("#entradas").val(),
        stock: stock,
        valor_unitario: $("#valor_unitario").val(),
        valor_venta: $("#valor_venta").val(),
        accion: 'editar'        
      })
        $.ajax({
          type:"post",
          url:"./Controlador/controladorInventario.php",
          data: this.inventario,
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
        position: 'center',
        type: 'error',
        title: 'El valor de venta debe ser mayor que el unitario',
        showConfirmButton: false,
        timer: 1500
    })   
    }
  }
  })
  })

  $(".box-body").on("click","a.borrar",function(){
    var data = dt.row($(this).parents("tr")).data();
    var id_farmacia = data.id_farmacia;
    var id_producto = data.id_producto;

    swal({
          title: '¿Está seguro?',
          text: "¿Realmente desea borrar el registro seleccionado del inventario ?",
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
                          title: 'El registro del intentario que usted selecciono fue borrado',
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
  var id_farmacia, 
      id_producto, 
      stock; 

  $(".box-body").on("click","a.editar",function(){
     var data = dt.row($(this).parents("tr")).data();
     id_farmacia = data.id_farmacia;
     id_producto = data.id_producto;
     var farmacia, producto;
     $(".box-title").html("Actualizar Inventario");
     $(".box #nuevo").hide();
     $(".box #reportes").hide();
     $("#editar").addClass('show');
     $("#editar").removeClass('hide');
     $("#listado").addClass('hide');
     $("#listado").removeClass('show');
     $("#editar").load("./Vista/Inventario/editarInventario.php",function(){
      $("#id_farmacia").attr('disabled','true');
      $("#id_producto").attr('disabled','true');
      $("#fecha_registro").attr('disabled','true');
          $.ajax({
              type:"post",
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
                      $("#entradas").val('');
                      $("#salidas").val(inventario.salidas);
                      $("#stock").val(inventario.stock);
                      stock = inventario.stock;
                      $("#valor_unitario").val(inventario.valor_unitario);
                      $("#valor_venta").val(inventario.valor_venta);
                      $("#fecha_registro").val(inventario.fecha_registro);
                      farmacia = inventario.id_farmacia;
                      producto = inventario.id_producto;

                      $.ajax({
                        type:"post",
                        url:"./Controlador/controladorFarmacia.php",
                        data: {accion:'listar'},
                        dataType:"json"
                        }).done(function( resultado ) {                      
                          $.each(resultado.data, function (index, value) { 
                          if(farmacia === value.id_farmacia){
                          $("#editar #id_farmacia").append("<option selected value='" + value.id_farmacia + "'>" + value.nombre_farmacia + "</option>")
                          }
                          });
                          });

                        $.ajax({
                          type:"post",
                          url:"./Controlador/controladorProducto.php",
                          data: {accion:'listar'},
                          dataType:"json"
                          }).done(function( resultado ) {                      
                          $.each(resultado.data, function (index, value) { 
                          if(producto === value.id_producto){
                          $("#editar #id_producto").append("<option selected value='" + value.id_producto + "'>" + value.nombre_producto +" "+ value.nombre_presentacion +" "+ value.nombre_proveedor + "</option>")
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
    window.location.href = 'Reportes/Inventario/xls/inventario_xls.php';
  })

  $("#modal-reportes").on("click","#generar_pdf", function(){
    generarPDF();
  })
}
function Editar_objeto(obj){
  this.id_farmacia = obj.id_farmacia;
  this.id_producto = obj.id_producto;
  this.entradas = obj.entradas;
  this.stock = obj.stock;
  this.valor_unitario = obj.valor_unitario;
  this.valor_venta = obj.valor_venta;
  this.accion = obj.accion;
}
function generarPDF(){
  var ancho = 1000;
  var alto = 800;
  
  var x = parseInt((window.screen.width / 2) - (ancho / 2));
  var y = parseInt((window.screen.height / 2) - (alto / 2));
  
  $url = 'Reportes/Inventario/pdf/reporteInventario.php';
  window.open($url,"Inventario","left="+x+",top="+y+"height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
}