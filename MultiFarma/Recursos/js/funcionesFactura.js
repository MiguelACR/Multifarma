function factura (){

 var dt = $("#tabla").DataTable({
  "ajax": {
    "method"   : "post",
    "url"      : "./Controlador/controladorFactura.php",
    "data"     : {"accion":"listar"},
    "dataType" : "json"
    },
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
           type:"post",
           url:"./Controlador/controladorFactura.php",
           data:{codigo: id_factura, accion:'consultar_detalle'},
          dataType:"json"
          }).done(function(resultado){
          $.each(resultado.data, function(index,value){
            this.factura = new Editar_objeto({
              id_producto: value.id_producto,
              cantidad: value.cantidad,
              accion: 'editar_autonomo',
              tipoAccion: 'devolucion'        
            })
          $.ajax({
          type:"post",
          url:"./Controlador/controladorInventario.php",
          data: this.factura,
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
function Editar_objeto(obj){
  this.id_producto = obj.id_producto;
  this.cantidad = obj.cantidad;
  this.accion = obj.accion;
  this.tipoAccion = obj.tipoAccion;
}
function generarPDF(cliente,factura){
  var ancho = 1000;
  var alto = 800;
  
  var x = parseInt((window.screen.width / 2) - (ancho / 2));
  var y = parseInt((window.screen.height / 2) - (alto / 2));
  
  $url = 'Reportes/Factura/reporteFactura.php?cl='+cliente+'&f='+factura;
  window.open($url,"Factura","left="+x+",top="+y+"height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
  }