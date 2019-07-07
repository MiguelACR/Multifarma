function ciudad (){

    var dt = $("#tabla").DataTable({
        "ajax": "./Controlador/controladorCiudad.php?accion=listar",
        "columns": [
            { "data": "id_ciudad" },
            { "data": "nombre_ciudad" },
            { "data": "nombre_pais" },

            { "defaultContent": '<a href="#" class="btn btn-danger btn-sm borrar" title="Borrar ciudad"> <i class="fa fa-trash"></i></a>'},
        
            { "defaultContent": '<a href="#" class="btn btn-info btn-sm editar" title="Editar ciudad"> <i class="fa fa-edit"></i></a>'}
        ]
    });

    $("#editar").on("click",".btncerrar", function(){
        $(".box-title").html("Listado de Ciudades");
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
        $(".box-title").html("Crear Ciudad");
        $("#editar").addClass('show');
        $("#editar").removeClass('hide');
        $("#listado").addClass('hide');
        $("#listado").removeClass('show');
        $("#editar").load('./Vista/Ciudades/nuevaCiudad.php', function(){
            $.ajax({
               type:"get",
               url:"./Controlador/controladorPais.php",
               data: {accion:'listar'},
               dataType:"json"
            }).done(function( resultado ) {                    
                $.each(resultado.data, function (index, value) { 
                  $("#editar #id_pais").append("<option value='" + value.id_pais + "'>" + value.nombre_pais + "</option>")
                });
            });
        });
        
    })

    $("#editar").on("click","button#grabar", function(){
        var datos=$("#fciudad").serialize();
        $('.label-danger').text('');
        $.ajax({
          type:"post",
          url:"./Validaciones/validacionCiudad.php",
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
                    type:"get",
                    url:"./Controlador/controladorCiudad.php",
                    data: {codigo: document.forms["fciudad"]["id_ciudad"].value, accion:'consultar'},
                    dataType:"json"
                    }).done(function( ciudad ) {        
                         if(ciudad.respuesta == "no existe"){
                          if(document.forms["fciudad"]["nuevo"].value === 'nuevo'){
                          $.ajax({
                          type:"post",
                          url:"./Controlador/controladorCiudad.php",
                          data: datos,
                          dataType:"json" 
                          }).done(function(resultado){
                          if(resultado.respuesta){
                            swal({
                                position: 'center',
                                type: 'success',
                                title: 'La ciudad fue grabada con éxito',
                                showConfirmButton: false,
                                timer: 1200
                            })     
                                $(".box-title").html("Listado de Ciudades");
                                $(".box #nuevo").show();
                                $(".box #reportes").show();
                                $("#editar").html('');
                                $("#editar").addClass('hide');
                                $("#editar").removeClass('show');
                                $("#listado").addClass('show');
                                $("#listado").removeClass('hide');
                                dt.page( 'last' ).draw( 'page' );
                                dt.ajax.reload(null, false);  
                          }
                          else {
                            swal({
                                position: 'center',
                                type: 'error',
                                title: 'Ocurrió un erro al grabar',
                                showConfirmButton: false,
                                timer: 1500
                            });
                           
                        }
                          })
                        }
                        else{
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Accion invalida!!!!!'                         
                              })    
                        }
                         }
                         else{
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: 'La ciudad ya existe!!!!!'                         
                              })    
                         }
                        })
            }
        })
    })

    var id_ciudad;

    $(".box-body").on("click","a.editar",function(){
        var data = dt.row($(this).parents("tr")).data();
        id_ciudad = data.id_ciudad;
        var pais;
        $(".box-title").html("Actualizar Ciudad");
        $(".box #nuevo").hide();
        $(".box #reportes").hide();
        $("#editar").addClass('show');
        $("#editar").removeClass('hide');
        $("#listado").addClass('hide');
        $("#listado").removeClass('show');
        $("#editar").load("./Vista/Ciudades/editarCiudad.php",function(){
             $.ajax({
                 type:"get",
                 url:"./Controlador/controladorCiudad.php",
                 data: {codigo: id_ciudad, accion:'consultar'},
                 dataType:"json"
                 }).done(function( ciudad ) {        
                     if(ciudad.respuesta === "no existe"){
                         swal({
                         type: 'error',
                         title: 'Oops...',
                         text: 'Ciudad no existe!'                         
                         })
                     } else {
                         $("#id_ciudad").val(ciudad.codigo);                   
                         $("#nombre_ciudad").val(ciudad.ciudad);
                         $("#id_ciudad").attr('readonly','true');
                         pais = ciudad.pais;
 ;
                         $.ajax({
                           type:"get",
                           url:"./Controlador/controladorPais.php",
                           data: {accion:'listar'},
                           dataType:"json"
                       }).done(function( resultado ) {                      
                           $.each(resultado.data, function (index, value) { 
                           if(pais === value.id_pais){
                               $("#editar #id_pais").append("<option selected value='" + value.id_pais + "'>" + value.nombre_pais + "</option>")
                           }else {
                               $("#editar #id_pais").append("<option value='" + value.id_pais + "'>" + value.nombre_pais + "</option>")
                           }
                           });
                       });
                     }
             });
         });
     })

     $("#editar").on("click","button#actualizar", function(){
        var datos=$("#fciudad").serialize();
        $('.label-danger').text('');
        $.ajax({
          type:"post",
          url:"./Validaciones/validacionCiudad.php",
          data: datos,
          dataType:"json"
        }).done(function( r ) {
            if(!r.response) {
                for(var k in r.errors){
                    $("span[data-key='" + k + "']").text(r.errors[k]);
                }
            }
            else{
                this.ciudad = new Editar_objeto({
                    id_ciudad: id_ciudad,
                    nombre_ciudad: $("#nombre_ciudad").val(),
                    id_pais: parseInt($("#id_pais").val()),
                    accion: 'editar'        
                  })
                $.ajax({
                type:"post",
                url:"./Controlador/controladorCiudad.php",
                data: this.ciudad,
                dataType: "json"
                }).done(function(resultado){
                 if(resultado.respuesta){
                    swal({
                        position: 'center',
                        type: 'success',
                        title: 'Se actualizaron los datos correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    }) 
                    $(".box-title").html("Listado de Ciudades");
                    $(".box #nuevo").show(); 
                    $(".box #reportes").show();
                    $("#editar").html('');
                    $("#editar").addClass('hide');
                    $("#editar").removeClass('show');
                    $("#listado").addClass('show');
                    $("#listado").removeClass('hide');
                    dt.ajax.reload(null, false); 
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
     
     })

     $(".box-body").on("click","a.borrar",function(){
     var data = dt.row($(this).parents("tr")).data();
     var id_ciudad = data.id_ciudad;
     swal({
        title: '¿Está seguro?',
        text: "¿Realmente desea borrar la ciudad con codigo : " + id_ciudad + " ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Borrarlo!'
     }).then((decision) => {
          if (decision.value) {
              var request = $.ajax({
                  method: "post",                  
                  url: "./Controlador/controladorCiudad.php",
                  data: {codigo: id_ciudad, accion:'borrar'},
                  dataType: "json"
              })
              request.done(function( resultado ) {
                  if(resultado.respuesta == 'correcto'){
                      swal({
                        position: 'center',
                        type: 'success',
                        title: 'La ciudad con codigo ' + id_ciudad + ' fue borrada',
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
  })

  
  $(".box").on("click","#reportes", function(){
    $("#modal-reportes").removeClass('modal fade show');
    $("#modal-reportes").addClass('modal fade in');
  })
   
  $("#modal-reportes").on("click","#generar_xls", function(){
    window.location.href = 'Reportes/Ciudad/xls/ciudad_xls.php';
  })

  $("#modal-reportes").on("click","#generar_pdf", function(){
    generarPDF();
  })
}
function Editar_objeto(obj){
    this.id_ciudad = obj.id_ciudad;
    this.nombre_ciudad = obj.nombre_ciudad;
    this.id_pais = obj.id_pais;
    this.accion = obj.accion;
}
function generarPDF(){
    var ancho = 1000;
    var alto = 800;
    
    var x = parseInt((window.screen.width / 2) - (ancho / 2));
    var y = parseInt((window.screen.height / 2) - (alto / 2));
    
    $url = 'Reportes/Ciudad/pdf/reporteCiudad.php';
    window.open($url,"Ciudad","left="+x+",top="+y+"height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
}