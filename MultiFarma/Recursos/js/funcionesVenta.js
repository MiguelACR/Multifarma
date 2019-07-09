function venta(){

   $("#id_cliente").keyup(function(e){
   e.preventDefault();
   var id_cliente = $(this).val();
   $.ajax({
    type:"post",
    url:"./Controlador/controladorCliente.php",
    data: {codigo: id_cliente,accion:'consultar'},
    dataType:"json"
 }).done(function( cliente ) {                    
    if(cliente.respuesta == 'no existe'){

      $("#nombre_cliente").val('');
      $("#telefono_cliente").val('');
      $("#direccion_cliente").val('');
      $("#apellido_cliente").val('');
      $('#nuevo').show();

      $("#id_pais").find('option').remove().end().append(
        '<option value="">Seleccione ...</option>').val("");

      $("#id_ciudad").find('option').remove().end().append(
        '<option value="">Seleccione ...</option>').val("");
    }
    else{
        $("#nombre_cliente").attr('readonly','true');
        $("#telefono_cliente").attr('readonly','true');
        $("#apellido_cliente").attr('readonly','true');
        $("#direccion_cliente").attr('readonly','true');
    
        $("#id_pais").attr('disabled','true');
        $("#id_ciudad").attr('disabled','true');    
        $('#nuevo').hide();
        var pais, ciudad;
        $("#id_cliente").val(cliente.id_cliente);                   
        $("#nombre_cliente").val(cliente.nombre_cliente);
        $("#apellido_cliente").val(cliente.apellido_cliente);
        $("#direccion_cliente").val(cliente.direccion_cliente);
        $("#telefono_cliente").val(cliente.telefono_cliente);
        pais = cliente.id_pais;
        ciudad = cliente.id_ciudad;
        var id_pais = cliente.id_pais;
        $.ajax({
            type:"get",
            url:"./Controlador/controladorPais.php",
            data: {accion:'listar'},
            dataType:"json"
        }).done(function( resultado ) {                      
            $.each(resultado.data, function (index, value) { 
            if(pais === value.id_pais){
                $("#id_pais").append("<option selected value='" + value.id_pais + "'>" + value.nombre_pais + "</option>")
            }else {
                $("#id_pais").append("<option value='" + value.id_pais + "'>" + value.nombre_pais + "</option>")
            }
            });
        });
        $.ajax({
            type:"get",
            url:"./Controlador/controladorCiudad.php",
            data: {codigo: id_pais, accion:'listar_ciudades_paises'},
            dataType:"json"
         }).done(function( resultado ) {                    
             $.each(resultado.data, function (index, value) { 
                if(ciudad === value.id_ciudad){
                $("#id_ciudad").append("<option selected value='" + value.id_ciudad + "'>" + value.nombre_ciudad + "</option>")
                }
                else{
                $("#id_ciudad").append("<option value='" + value.id_ciudad + "'>" + value.nombre_ciudad + "</option>")
                } 
             });
         });  
    }
 });
 }); 

 $("#box-panel-two").on("click","#nuevo", function(){

  if($("#id_cliente").val() != ''){
    $("#cancelarCliente").show();
    $("#nuevo").hide();
    $("#id_cliente").attr('readonly','true');
    $("#nombre_cliente").removeAttr('readonly');
    $("#telefono_cliente").removeAttr('readonly');
    $("#apellido_cliente").removeAttr('readonly');
    $("#direccion_cliente").removeAttr('readonly');

    $("#id_pais").removeAttr('disabled');
   
    $.ajax({
        type:"get",
        url:"./Controlador/controladorPais.php",
        data: {accion:'listar'},
        dataType:"json"
     }).done(function( resultado ) {                    
         $.each(resultado.data, function (index, value) { 
           $("#id_pais").append("<option value='" + value.id_pais + "'>" + value.nombre_pais + "</option>")
         });
     });

     $("#id_pais").change(function(){
        $("#id_pais option:selected").each(function(){
        var id_pais = document.forms['fventa']['id_pais'].value;
        $("#id_ciudad").removeAttr('disabled');
        $("#id_ciudad").find('option').remove().end().append(
        '<option value="">Seleccione ...</option>').val("");
        $.ajax({
            type:"get",
            url:"./Controlador/controladorCiudad.php",
            data: {codigo: id_pais, accion:'listar_ciudades_paises'},
            dataType:"json"
         }).done(function( resultado ) {                    
             $.each(resultado.data, function (index, value) { 
               $("#id_ciudad").append("<option value='" + value.id_ciudad + "'>" + value.nombre_ciudad + "</option>")
             });
             $('#grabar').show();
         });
        });             
        });
    }
    else{
        swal({
            position: 'center',
            type: 'error',
            title: 'El campo identificación esta vacio',
            showConfirmButton: false,
            timer: 1200
        }) 
    }
 })

$("#box-panel-two").on('click', "#cancelarCliente", function(){

  $("#id_cliente").val('');
  $("#id_cliente").removeAttr('readonly');
  $("#nombre_cliente").val('');
  $("#telefono_cliente").val('');
  $("#direccion_cliente").val('');
  $("#apellido_cliente").val('');
  $("#nombre_cliente").attr('readonly','true');
  $("#telefono_cliente").attr('readonly','true');
  $("#apellido_cliente").attr('readonly','true');
  $("#direccion_cliente").attr('readonly','true');

  $('#nuevo').show();
  $('#grabar').hide();

  $("#id_pais").find('option').remove().end().append(
    '<option value="">Seleccione ...</option>').val("");

  $("#id_ciudad").find('option').remove().end().append(
    '<option value="">Seleccione ...</option>').val("");

  $("#id_pais").attr('disabled','true');
  $("#id_ciudad").attr('disabled','true'); 

  $("#cancelarCliente").hide();  

})

 $("#box-panel-two").on("click","#grabar", function(){
    var datos=$("#fventa").serialize();
    $.ajax({
        type:"post",
        url:"./Controlador/controladorCliente.php",
        data: datos,
        dataType:"json"
      }).done(function( resultado ) {
          if(resultado.respuesta){
            $("#id_cliente").attr('readonly','true');  
            $("#nombre_cliente").attr('readonly','true');
            $("#telefono_cliente").attr('readonly','true');
            $("#apellido_cliente").attr('readonly','true');
            $("#direccion_cliente").attr('readonly','true');
        
            $("#id_pais").attr('disabled','true');
            $("#id_ciudad").attr('disabled','true');
            
            $('#nuevo').hide();
            $('#grabar').hide();                  
         } 
    });

 })

 $("#id_producto").keyup(function(e){
    e.preventDefault();
    
    var id_producto = $(this).val();
    $.ajax({
        type:"get",
        url:"./Controlador/controladorProducto.php",
        data: {codigo: id_producto, accion:"consultar_prod_venta"},
        dataType:"json"
      }).done(function( producto ) {
    if(producto.respuesta == 'existe'){
      $("#nombre_producto").html(producto.detalle_producto);
      $("#stock").html(producto.stock);
      $("#cantidad_producto").val('1');
      $("#valor_venta").html(producto.valor_venta);
      $("#valor_venta_total").html(producto.valor_venta);
    
      $("#cantidad_producto").removeAttr('disabled');
    
      $('#add_producto_venta').slideDown();
    }
    else{
      $("#nombre_producto").html('-');
      $("#stock").html('-');
      $("#cantidad_producto").val('0');
      $("#valor_venta").html('0.00');
      $("#valor_venta_total").html('0.00');
    
      $("#cantidad_producto").attr('disabled','true');
    
      $('#add_producto_venta').slideUp();  
    }
      }); 
    });

    $("#cantidad_producto").keyup(function(e){
    e.preventDefault();
    var valor_venta_total = $(this).val() * $("#valor_venta").html();
    $("#valor_venta_total").html(valor_venta_total);  
    
    if($(this).val() < 1 || isNaN($(this).val())||$(this).val() > parseInt($("#stock").html())){
      $("#add_producto_venta").slideUp();
    }
    else{
      $("#add_producto_venta").slideDown();
    }

    });

    
    var posicion = 0, subTotal, iva, total_venta, cantidad;
    var movimiento_factura;
    var self = this;
    self.model = new Comprobante();
    self.producto = null;

function Comprobante() {
    this.detalle = [];
}

function Calcular_totales(obj){

this.total = obj.total;

 subTotal = subTotal + this.total;
 iva = subTotal*0.19;
 total_venta = subTotal+iva;

var totales = '<tr>'+
'<td>'+subTotal+'</td>'+
'<td>'+iva+'</td>'+
'<td>'+total_venta+'</td>'+'</tr>'; 

$("#tablaT").html(totales);

}

function Cargar_detalle(){
  subTotal = 0, iva = 0, total_venta = 0;

  $.each(self.model.detalle, function (index, value) { 

    movimiento_factura = movimiento_factura + '<tr>'+
    '<td>'+value.id_producto+'</td>'+
    '<td>'+value.nombre+'</td>'+
    '<td>'+value.cantidad+'</td>'+
    '<td>'+value.precio+'</td>'+
    '<td>'+value.total+'</td>'+ 
    '<td>'+'<a href="#" data-codigo="'+ posicion + 
    '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'+'</td>'+'</tr>';  
  
    self.calcular_totales = new Calcular_totales({
    total: value.total 
    });    
    posicion++; 
  });
  posicion = 0;

  $("#tablaD").html(movimiento_factura);
}

  $("#box-panel-three").on("click","#add_producto_venta", function(){
  
  cantidad = self.model.detalle.length;

  if(cantidad == 0){
  $("#procesar").removeAttr('disabled');
  }

  movimiento_factura = '';   
      self.producto = new Producto({
      id_producto: parseInt($("#id_producto").val()),
      nombre: $("#nombre_producto").html(),
      cantidad: parseInt($("#cantidad_producto").val()),
      precio: parseInt($("#valor_venta").html()),
      total: parseInt($("#valor_venta_total").html())
  });
          
     self.model.detalle.push(self.producto);
     console.log(self.model.detalle);  
     self.cargar_detalle = new Cargar_detalle();

      $("#id_producto").val('');
      $("#nombre_producto").html('-');
      $("#stock").html('-');
      $("#cantidad_producto").val('0');
      $("#cantidad_producto").attr('disabled','true');
      $("#valor_venta").html('0.00');
      $("#valor_venta_total").html('0.00');
      $('#add_producto_venta').slideUp();

      
  })

  $("#box-panel-four").on("click","a.borrar", function(){
   
    cantidad = self.model.detalle.length;

    if(cantidad == 1){
    $("#procesar").attr('disabled','true');
    $("#tablaT").html('');
    }
           var item = $(this).data("codigo");

            index = self.model.detalle.indexOf(item);

            self.model.detalle.splice(index, 1);
            
            movimiento_factura = '';
            self.cargar_detalle = new Cargar_detalle();

  })

  $("#box-panel-one").on("click","#cancelar", function(){

    if(cantidad > 1){

    $("#id_cliente").val('');
    $("#nombre_cliente").val('');
    $("#telefono_cliente").val('');
    $("#direccion_cliente").val('');
    $("#apellido_cliente").val('');
    
    $("#id_pais").find('option').remove().end().append(
      '<option value="">Seleccione ...</option>').val("");

    $("#id_ciudad").find('option').remove().end().append(
      '<option value="">Seleccione ...</option>').val("");
    }

    $("#id_producto").val('');
    $("#nombre_producto").html('-');
    $("#stock").html('-');
    $("#cantidad_producto").val('0');
    $("#cantidad_producto").attr('disabled','true');
    $("#valor_venta").html('0.00');
    $("#valor_venta_total").html('0.00');
    $('#add_producto_venta').slideUp();

    self.model.detalle = [];

    $("#tablaD").html('');
    $("#tablaT").html('');
    $("#procesar").attr('disabled','true');

  })

  $("#box-panel-one").on("click","#procesar", function(){
   var id_cliente = document.forms['fventa']['id_cliente'].value;
   if(id_cliente != ''){
    self.venta = new registrarVenta({
      id_cliente: id_cliente,
      subTotal: subTotal,
      iva: iva,
      total_venta: total_venta,
      accion: 'nuevo',
      tipoAccion: 'factura'
  });  
   $.ajax({
    type:"post",
    url:"./Controlador/controladorVenta.php",
    data: self.venta,
    dataType:"json"
   }).done(function(resultado){
     if(resultado.respuesta){
      $.ajax({
        type:"post",
        url:"./Controlador/controladorVenta.php",
        data: {accion:"identificarM"},
        dataType:"json"
       }).done(function(resultado){
         if(resultado.respuesta == 'existe'){
          var id_factura = resultado.id_factura;
          $.each(self.model.detalle, function(index,value){
          self.detalle = new Editar_objeto({
            id_producto: value.id_producto,
            nombre: value.nombre,
            cantidad: value.cantidad,
            precio: value.precio,
            total: value.total,
            id_factura: id_factura,
            accion: 'nuevo',
            tipoAccion: 'detalle'                
          })
          $.ajax({
            type:"post",
            url:"./Controlador/controladorVenta.php",
            data: self.detalle,
            dataType:"json"
           }).done(function(resultado){
             if(resultado.respuesta){
              self.inventario = new Editar_objeto({
                id_producto: value.id_producto,
                cantidad: value.cantidad,
                accion: 'editar_autonomo',
                tipoAccion: 'factura'                
              })
               $.ajax({
                 type:"post",
                 url:"./Controlador/controladorInventario.php",
                 data: self.inventario,
                 dataType:"json"
                })
             }
           })
        }); 
          generarPDF(id_cliente,id_factura);
          location.reload();
         }
        })
     }
   })
  }
  else{
    swal({
      position: 'center',
      type: 'error',
      title: 'El cliente no esta definido',
      showConfirmButton: false,
      timer: 1200
  }) 
  }
  })  
}
function registrarVenta(obj){
  this.id_cliente = obj.id_cliente;
  this.subTotal = obj.subTotal;
  this.iva = obj.iva;
  this.total_venta = obj.total_venta;
  this.accion = obj.accion;
  this.tipoAccion = obj.tipoAccion;
}
function Editar_objeto(obj){
  this.id_producto = obj.id_producto;
  this.nombre = obj.nombre;
  this.cantidad = obj.cantidad;
  this.precio = obj.precio;
  this.total = obj.total;
  this.id_factura = obj.id_factura;
  this.accion = obj.accion;
  this.tipoAccion = obj.tipoAccion;
}
function Producto(obj){
  this.id_producto = obj.id_producto;
  this.nombre = obj.nombre;
  this.cantidad = obj.cantidad;
  this.precio = obj.precio;
  this.total = obj.total;
}
function generarPDF(cliente,factura){
var ancho = 1000;
var alto = 800;

var x = parseInt((window.screen.width / 2) - (ancho / 2));
var y = parseInt((window.screen.height / 2) - (alto / 2));

$url = 'Reportes/Factura/pdf/reporteFactura.php?cl='+cliente+'&f='+factura;
window.open($url,"Factura","left="+x+",top="+y+"height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
}
    
