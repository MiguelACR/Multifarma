function login(){ 
    var cont = 0; 
    var bloqueo = false;
    $("#login-form").on('submit',function(e){    
        e.preventDefault();
        var datos = $(this).serialize();
        //console.log(datos)
        $.ajax({
            type:"post",
            url:"./Controlador/controladorLogin.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
            if(resultado.respuesta == "existe" && resultado.estado == 1){
                var id_rol = resultado.rol;
                $.ajax({
                    type:"post",
                    url:"./Controlador/controladorLogin.php",
                    data: {codigoU: resultado.usuario, accion: 'consultarIE'},
                    dataType:"json"
                  }).done(function( resultado ) {
                     if(resultado.respuesta == 'existe'){
                      var id_empleado = resultado.empleado; 
                      $.ajax({
                        type:"post",
                        url:"./Controlador/controladorLogin.php",
                        data: {codigoE: id_empleado, accion: 'consultarNE'},
                        dataType:"json"
                      }).done(function( empleado ) {
                       if(empleado.respuesta == 'existe'){
                        $.ajax({
                            type:"post",
                            url:"./Controlador/controladorLogin.php",
                            data: {codigoL: id_rol, accion: 'listar'},
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
                    url:"./Controlador/controladorLogin.php",
                    data: {codigoA: usuario, accion:'bloqueo'},
                    dataType:"json"
                  }).done(function( resultado ) {
                    if(cont > 2 && resultado.respuesta == 'existe'){
                        $.ajax({
                            type:"post",
                            url:"./Controlador/controladorLogin.php",
                            data: {codigoIU: resultado.usuario, codigoE: 2 ,accion: 'editar'},
                            dataType:"json"
                          }).done(function( resultado ) {
                           console.log('Bloqueado');
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
