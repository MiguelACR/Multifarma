function login(){ 
    var cont = 0; 
    var bloqueo = false;
    $("#login-form").on('submit',function(e){    
        e.preventDefault();
        var datos = $(this).serialize();
        //console.log(datos)
        $.ajax({
            type:"post",
            url:"./Controlador/controladorUsuarios.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
            if(resultado.respuesta == "existe" && resultado.estado == 1){
                var id_rol = resultado.rol;
                $.ajax({
                    type:"post",
                    url:"./Controlador/controladorUsuariosxempleados.php",
                    data: {codigo: resultado.usuario, accion: 'consultar'},
                    dataType:"json"
                  }).done(function( resultado ) {
                     if(resultado.respuesta == 'existe'){
                      var id_empleado = resultado.empleado; 
                      $.ajax({
                        type:"post",
                        url:"./Controlador/controladorEmpleados.php",
                        data: {codigo: id_empleado, accion: 'consultar_datos_empleado_login'},
                        dataType:"json"
                      }).done(function( empleado ) {
                       if(empleado.respuesta == 'existe'){
                        $.ajax({
                            type:"post",
                            url:"./Controlador/controladorRolesxpermisos.php",
                            data: {codigo: id_rol, accion: 'listar_permisos'},
                            dataType:"json"
                          }).done(function( resultado ) {
                            if(resultado.respuesta){
                            location.href ="adminper.php"; 
                            }
                            });    
                       }
                      });
                     }
                  });  
            }
            else {
                if(bloqueo == false){
                cont++;
                console.log(cont);
                swal({
                    position: 'center',
                    type: 'error',
                    title: 'Usuario y/o Password incorrecto',
                    showConfirmButton: false,
                    timer: 1500
                }),
                function() {
                    $("#usuario").focus().select();
                }; 
                var usuario = document.forms['login-form']['usuario'].value;
                $.ajax({
                    type:"post",
                    url:"./Controlador/controladorUsuarios.php",
                    data: {codigo: usuario, accion:'consultar_datos_login'},
                    dataType:"json"
                  }).done(function( resultado ) {
                    if(cont > 2 && resultado.respuesta == 'existe'){
                      this.usuario = new Editar_objeto({
                        id_usuario: resultado.usuario,
                        id_estado: 2,
                        accion: 'editar_estado'        
                      })
                        $.ajax({
                            type:"post",
                            url:"./Controlador/controladorUsuarios.php",
                            data: this.usuario,
                            dataType:"json"
                          }).done(function( resultado ) {
                            swal({
                              position: 'center',
                              type: 'error',
                              title: 'Cuenta bloqueada',
                              showConfirmButton: false,
                              timer: 1500
                          })
                           bloqueo = true;
                            } ); 
                    } 
                  }); 
                }
                else{
                    swal({
                        position: 'center',
                        type: 'error',
                        title: 'Cuenta Bloqueada',
                        showConfirmButton: false,
                        timer: 1500
                    })    
                }             
            }
        });
    })
}
function Editar_objeto(obj){
  this.id_usuario = obj.id_usuario;
  this.id_estado = obj.id_estado;
  this.accion = obj.accion;
}