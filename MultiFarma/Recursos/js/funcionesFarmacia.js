var dt;

function farmacia() {
    $(".content-header").on("click", "button#actualizar", function() {
        var datos = $("#ffarmacia").serialize();
        $.ajax({
            type: "post",
            url: "./Controlador/controladorFarmacia.php",
            data: datos,
            dataType: "json"
        }).done(function(resultado) {
            if (resultado.respuesta) {
                swal(
                    'Actualizado!',
                    'Se actualizaron los datos correctamente',
                    'success'
                )
                dt.ajax.reload();
                $("#titulo").html("Listado Farmacias");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#farmacia").removeClass("hide");
                $("#farmacia").addClass("show")
            } else {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'
                })
            }
        });
    })

    $(".content-header").on("click", "a.borrar", function() {
        //Recupera datos del formulario
        var codigo = $(this).data("codigo");

        swal({
            title: '¿Está seguro?',
            text: "¿Realmente desea borrar la Farmacia con codigo : " + codigo + " ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
            if (decision.value) {

                var request = $.ajax({
                    method: "post",
                    url: "./Controlador/controladorFarmacia.php",
                    data: { codigo: codigo, accion: 'borrar' },
                    dataType: "json"
                })

                request.done(function(resultado) {
                    if (resultado.respuesta == 'correcto') {
                        swal(
                            'Borrado!',
                            'Farmacia con codigo : ' + codigo + ' fue borrada',
                            'success'
                        )
                        dt.ajax.reload();
                    } else {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        })
                    }
                });

                request.fail(function(jqXHR, textStatus) {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!' + textStatus
                    })
                });
            }
        })

    });

    $(".content-header").on("click", "button.btncerrar2", function() {
        $("#titulo").html("Listado de Farmacias");
        $("#nuevo-editar").html("");
        $("#nuevo-editar").removeClass("show");
        $("#nuevo-editar").addClass("hide");
        $("#farmacia").removeClass("hide");
        $("#farmacia").addClass("show");

    })

    $(".content-header").on("click", "button.btncerrar", function() {
        $("#contenedor").removeClass("show");
        $("#contenedor").addClass("hide");
        $(".content-header").html('')
    })

    $(".content-header").on("click", "button#nuevo", function() {

        $("#titulo").html("Crear Farmacia");
        $("#nuevo-editar").load('./Vista/Farmacia/nuevoFarmacia.php', function() {
            $("#id_farmacia").attr('readonly','true');
            $("#nuevo-editar").removeClass('hide');
            $("#nuevo-editar").addClass('show');
            $("#farmacia").removeClass('show');
            $("#farmacia").addClass('hide');

            $.ajax({
                type: "get",
                url: "./Controlador/controladorPais.php",
                data: { accion: 'listar' },
                dataType: "json"
            }).done(function(resultado) {;
                $("#id_pais option").remove()
                $("#id_pais").append("<option selecte value=''>Seleccione un pais</option>")
                $("#id_ciudad").append("<option selecte value=''>Seleccione primero un pais</option>")
                $.each(resultado.data, function(index, value) {
                    $("#id_pais").append("<option value='" + value.id_pais + "'>" + value.nombre_pais + "</option>")
                });
            });
            $("#id_pais").change(function() {
                $("#id_pais option:selected").each(function() {
                    var id_pais = document.forms['ffarmacia']['id_pais'].value;
                    $.ajax({
                        type: "get",
                        url: "./Controlador/controladorCiudad.php",
                        data: { codigo: id_pais, accion: 'listarC' },
                        dataType: "json"
                    }).done(function(resultado) {;
                        $("#id_ciudad option").remove()
                        if (id_pais === "") {
                            $("#id_ciudad").append("<option selecte value=''>Seleccione primero un pais</option>")
                        } else {
                            $("#id_ciudad").append("<option selecte value=''>Seleccione una ciudad</option>")
                            $.each(resultado.data, function(index, value) {
                                $("#id_ciudad").append("<option value='" + value.id_ciudad + "'>" + value.nombre_ciudad + "</option>")
                            });
                        }
                    });
                });
            });

            $.ajax({
                type: "get",
                url: "./Controlador/controladorPropietario.php",
                data: { accion: 'listar' },
                dataType: "json"
            }).done(function(resultado) {;
                $("#id_propietario option").remove()
                $("#id_propietario").append("<option selecte value=''>Seleccione un propietario</option>")
                $.each(resultado.data, function(index, value) {
                    $("#id_propietario").append("<option value='" + value.id_propietario + "'>" + value.nombre_propietario + " " + value.apellido_propietario + "</option>")
                });
            });

            $.ajax({
                type: "get",
                url: "./Controlador/controladorUsuarios.php",
                data: { accion: 'listar' },
                dataType: "json"
            }).done(function(resultado) {;
                $("#id_usuario option").remove()
                $("#id_usuario").append("<option selecte value=''>Seleccione un administrador de sistema</option>")
                $.each(resultado.data, function(index, value) {
                    $("#id_usuario").append("<option value='" + value.id_usuario + "'>" + value.nickname_usuario + "</option>")
                });
            });




        });
    })

    $(".content-header").on("click", "button#grabar", function() {

                var datos = $("#ffarmacia").serialize();

                $.ajax({
                    type: "post",
                    url: "./Controlador/controladorFarmacia.php",
                    data: datos,
                    dataType: "json"
                }).done(function(resultado) {
                    if (resultado.respuesta) {
                        swal(
                            'Grabado!!',
                            'El registro se grabó correctamente',
                            'success'
                        )
                        dt.ajax.reload();
                        $("#titulo").html("Listado Farmacias");
                        $("#nuevo-editar").html("");
                        $("#nuevo-editar").removeClass("show");
                        $("#nuevo-editar").addClass("hide");
                        $("#farmacia").removeClass("hide");
                        $("#farmacia").addClass("show")
                    } else {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        })
                    }
                });  
    });

    $(".content-header").on("click", "a.editar", function() {
        $("#titulo").html("Editar Farmacia");
        //Recupera datos del formulario
        var codigo = $(this).data("codigo");
        var pais;
        var ciudad;
        var propietario;
        var administrador;

        $("#nuevo-editar").load("./Vista/Farmacia/editarfarmacia.php", function() {
            $("#id_farmacia").attr('readonly','true');
            $("#nuevo-editar").removeClass("hide");
            $("#nuevo-editar").addClass("show");
            $("#farmacia").removeClass("show");
            $("#farmacia").addClass("hide");
            $.ajax({
                type: "get",
                url: "./Controlador/controladorFarmacia.php",
                data: { codigo: codigo, accion: 'consultar' },
                dataType: "json"
            }).done(function(farmacia) {
                if (farmacia.respuesta === "no existe") {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Farmacia no existe!'
                    })
                } else {
                    $("#id_farmacia").val(farmacia.codigo);
                    $("#nombre_farmacia").val(farmacia.farmacia);
                    $("#direccion_farmacia").val(farmacia.direccion);
                    $("#telefono_farmacia").val(farmacia.telefono);
                    propietario = farmacia.propietario;
                    administrador = farmacia.administrador;
                    ciudad = farmacia.ciudad;
                    pais = farmacia.pais;

                    var id_pais = farmacia.pais;
                    $.ajax({
                        type: "get",
                        url: "./Controlador/controladorPais.php",
                        data: { accion: 'listar' },
                        dataType: "json"
                    }).done(function(resultado) {
                        $("#id_pais").append("<option selecte value=''>Seleccione un pais</option>")
                        $.each(resultado.data, function(index, value) {
                            if (pais === value.id_pais) {
                                $("#id_pais").append("<option selected value='" + value.id_pais + "'>" + value.nombre_pais + "</option>")
                            } else {
                                $("#id_pais").append("<option value='" + value.id_pais + "'>" + value.nombre_pais + "</option>")
                            }
                        });
                    });

                    $.ajax({
                        type: "get",
                        url: "./Controlador/controladorCiudad.php",
                        data: { codigo: id_pais, accion: 'listarC' },
                        dataType: "json"
                    }).done(function(resultado) {;
                        $.each(resultado.data, function(index, value) {
                            if (ciudad === value.id_ciudad) {
                                $("#id_ciudad").append("<option selected value='" + value.id_ciudad + "'>" + value.nombre_ciudad + "</option>")
                            } else {
                                $("#id_pais").change(function() {
                                    $("#id_pais option:selected").each(function() {
                                        var id_pais = document.forms['ffarmacia']['id_pais'].value;
                                        $.ajax({
                                            type: "get",
                                            url: "./Controlador/controladorCiudad.php",
                                            data: { codigo: id_pais, accion: 'listarC' },
                                            dataType: "json"
                                        }).done(function(resultado) {;
                                            $("#id_ciudad option").remove()
                                            if (id_pais === "") {
                                                $("#id_ciudad").append("<option selecte value=''>Seleccione primero un pais</option>")
                                            } else {
                                                $("#id_ciudad").append("<option selecte value=''>Seleccione una ciudad</option>")
                                                $.each(resultado.data, function(index, value) {
                                                    $("#id_ciudad").append("<option value='" + value.id_ciudad + "'>" + value.nombre_ciudad + "</option>")
                                                });
                                            }
                                        });
                                    });
                                });
                            }
                        });
                    });

                    $.ajax({
                        type: "get",
                        url: "./Controlador/controladorPropietario.php",
                        data: { accion: 'listar' },
                        dataType: "json"
                    }).done(function(resultado) {
                        $("#id_propietario").append("<option selecte value=''>Seleccione un propietario </option>")
                        $.each(resultado.data, function(index, value) {
                            if (propietario === value.id_propietario) {
                                $("#id_propietario").append("<option selected value='" + value.id_propietario + "'>" + value.nombre_propietario + " " + value.nombre_propietario + "</option>")
                            } else {
                                $("#id_propietario").append("<option value='" + value.id_propietario + "'>" + value.nombre_propietario + " " + value.nombre_propietario + "</option>")
                            }
                        });
                    });

                    $.ajax({
                        type: "get",
                        url: "./Controlador/controladorUsuarios.php",
                        data: { accion: 'listar' },
                        dataType: "json"
                    }).done(function(resultado) {
                        $("#id_usuario").append("<option selecte value=''>Seleccione un administrador de sistemas </option>")
                        $.each(resultado.data, function(index, value) {
                            if (administrador === value.id_usuario) {
                                $("#id_usuario").append("<option selected value='" + value.id_usuario + "'>" + value.nickname_usuario + "</option>")
                            } else {
                                $("#id_usuario").append("<option value='" + value.id_usuario + "'>" + value.nickname_usuario + "</option>")
                            }
                        });
                    });
                }
            });
        })
    })
}

$(document).ready(() => {
    $(".content-header").off("click", "a.editar");
    $(".content-header").off("click", "button#actualizar");
    $(".content-header").off("click", "a.borrar");
    $(".content-header").off("click", "button#nuevo");
    $(".content-header").off("click", "button#grabar");
    $("#titulo").html("Listado de Farmacias");
    dt = $("#tabla").DataTable({
        ajax: "./Controlador/controladorFarmacia.php?accion=listar",
        columns: [
            { data: "id_farmacia" },
            { data: "nombre_farmacia" },
            { data: "direccion_farmacia" },
            { data: "telefono_farmacia" },
            { data: "nombre_propietario" },
            { data: "nickname_usuario" },
            { data: "nombre_ciudad" },
            { data: "nombre_pais" },
            {
                data: "id_farmacia",
                render: function(data) {
                    return '<a href="#" data-codigo="' + data +
                        '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                }
            },
            {
                data: "id_farmacia",
                render: function(data) {
                    return '<a href="#" data-codigo="' + data +
                        '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>';
                }
            }
        ]
    });

    farmacia();
});