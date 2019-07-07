function factura (){

 var dt = $("#tabla").DataTable({
    "ajax": "./Controlador/controladorFactura.php?accion=listar",
    "columns": [
        { "data": "id_factura"} ,
        { "data": "nombre_completo_cliente" },
        { "data": "nombre_completo_empleado" },
        { "data": "fecha_factura" },
        { "data": "valor_factura" },
        { "data": "iva_factura" },
        { "data": "neto_factura" },
        { "data": "estado_factura",
        render: function (data) {
           if(data == 1){
               return "Vigente"
           } 
           else{
               return "Anulada"
           }
        }
        },
        { "data": "estado_factura",
          render: function (data) {
           var boton_generarPDF =  "<a href='#' class= 'btn btn-danger btn-sm generarF'> <i class='fa fa-file-pdf-o'></i></a>"; 
           if(data == 1){
            return boton_generarPDF
            +"<a href='#' class='btn btn-info btn-sm anular'> <i class='fa fa-ban'></i></a>"   
           }
           else{
            return boton_generarPDF
            +"<a href='#' class='btn btn-info btn-sm anular' disabled='true'> <i class='fa fa-ban'></i></a>"   
           }   
         }
          }
    ] 
 });

 $(".box-body").on('click','a.generarF', function(){
    var data = dt.row($(this).parents("tr")).data();
    var id_factura = data.id_factura,
        id_cliente = data.id_cliente;

  generarPDF(id_cliente, id_factura);   
 })

 $(".box-body").on('click','a.anular',function(){
  var data = dt.row($(this).parents("tr")).data();
  var estado_factura = data.estado_factura;
  var id_factura = data.id_factura;
  if(estado_factura == 1){
    swal({
      title: '¿Está seguro?',
      text: "¿Realmente desea anular la factura con codigo : " + id_factura + " ?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, anularla!'
}).then((decision) => {
        if (decision.value) {  
          var request =  $.ajax({
            type:"post",
            url:"./Controlador/controladorFactura.php",
            data: {codigo: id_factura, accion:'anular'},
            dataType:"json"
            })
           request.done(function( resultado ) {  
           if(resultado.respuesta === 'correcto'){
           $.ajax({
           type:"get",
           url:"./Controlador/controladorVenta.php",
           data:{codigoF: id_factura, accion:'listar_detalle'},
          dataType:"json"
          }).done(function(resultado){
          $.each(resultado.data, function(index,value){
          $.ajax({
          type:"post",
          url:"./Controlador/controladorInventario.php",
          data:{codigoP: value.id_producto, codigoC: value.cantidad, accion:'editar_inven_anular'},
          dataType:"json"  
          })
          })
          dt.ajax.reload(null, false); 
          })
          }
          else {
            swal({
              type: 'error',
              title: 'Oops...',
              text: 'Something went wrong!'                         
            })
        }
          })
        }
      })
  }
  else{
    swal({
      position: 'center',
      type: 'warning',
      title: 'La factura ya esta anulada',
      showConfirmButton: false,
      timer: 1200
  }) 
  }
 })
}
function generarPDF(cliente,factura){
  var ancho = 1000;
  var alto = 800;
  
  var x = parseInt((window.screen.width / 2) - (ancho / 2));
  var y = parseInt((window.screen.height / 2) - (alto / 2));
  
  $url = 'Reportes/Factura/reporteFactura.php?cl='+cliente+'&f='+factura;
  window.open($url,"Factura","left="+x+",top="+y+"height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
  }