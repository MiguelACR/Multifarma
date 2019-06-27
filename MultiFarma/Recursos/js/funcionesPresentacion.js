var dt;

function presentacion() {
    $(".content-header").on("click", "button#actualizar", function() {
        var datos = $("#fpresentacion").serialize();
        $.ajax({
            type: "get",
            url: "./Controlador/controladorPresentacion.php",
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
                $("#titulo").html("Listado Presentacion");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#presentacion").removeClass("hide");
                $("#presentacion").addClass("show")
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
            text: "¿Realmente desea borrar la presentacion con codigo : " + codigo + " ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
            if (decision.value) {

                var request = $.ajax({
                    method: "get",
                    url: "./Controlador/controladorPresentacion.php",
                    data: { codigo: codigo, accion: 'borrar' },
                    dataType: "json"
                })

                request.done(function(resultado) {
                    if (resultado.respuesta == 'correcto') {
                        swal(
                            'Borrado!',
                            'La presentacion con codigo : ' + codigo + ' fue borrado',
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
        $("#titulo").html("Listado de Presentaciones");
        $("#nuevo-editar").html("");
        $("#nuevo-editar").removeClass("show");
        $("#nuevo-editar").addClass("hide");
        $("#presentacion").removeClass("hide");
        $("#presentacion").addClass("show");

    })

    $(".content-header").on("click", "button.btncerrar", function() {
        $("#contenedor").removeClass("show");
        $("#contenedor").addClass("hide");
        $(".content-header").html('')
    })

    $(".content-header").on("click", "button#nuevo", function() {
        $("#titulo").html("Nueva Presentacion");
        $("#nuevo-editar").load("./Vista/Presentacion/nuevoPresentacion.php");
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#presentacion").removeClass("show");
        $("#presentacion").addClass("hide");
    })

    $(".content-header").on("click", "button#grabar", function() {
        var codigo = document.forms["fpresentacion"]["id_presentacion"].value;
        $.ajax({
            type: "get",
            url: "./Controlador/controladorPresentacion.php",
            data: { codigo: codigo, accion: 'consultar' },
            dataType: "json"
        }).done(function(presentacion) {
            if (presentacion.respuesta == "no existe") {
                var datos = $("#fpresentacion").serialize();

                $.ajax({
                    type: "get",
                    url: "./Controlador/controladorPresentacion.php",
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
                        $("#titulo").html("Listado presentaciones");
                        $("#nuevo-editar").html("");
                        $("#nuevo-editar").removeClass("show");
                        $("#nuevo-editar").addClass("hide");
                        $("#presentacion").removeClass("hide");
                        $("#presentacion").addClass("show")
                    } else {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        })
                    }
                });
            } else {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'La presentacion ya existe!!!!!'
                })
            }
        });
    });

    $(".content-header").on("click", "a.editar", function() {
        $("#titulo").html("Editar Presentacion");
        //Recupera datos del fromulario
        var codigo = $(this).data("codigo");

        $("#nuevo-editar").load("./Vista/Presentacion/editarPresentacion.php");
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#presentacion").removeClass("show");
        $("#presentacion").addClass("hide");
        $.ajax({
            type: "get",
            url: "./Controlador/controladorPresentacion.php",
            data: { codigo: codigo, accion: 'consultar' },
            dataType: "json"
        }).done(function(presentacion) {
            if (presentacion.respuesta === "no existe") {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Presentacion no existe!'
                })
            } else {
                $("#id_presentacion").val(presentacion.codigo);
                $("#nombre_presentacion").val(presentacion.presentacion);
            }
        });
    })

}
$(document).ready(() => {
    $(".content-header").off("click", "a.editar");
    $(".content-header").off("click", "button#actualizar");
    $(".content-header").off("click", "a.borrar");
    $(".content-header").off("click", "button#nuevo");
    $(".content-header").off("click", "button#grabar");
    $("#titulo").html("Listado de Presentaciones");
    dt = $("#tabla").DataTable({
        "ajax": "./Controlador/controladorPresentacion.php?accion=listar",
        "columns": [
            { "data": "id_presentacion" },
            { "data": "nombre_presentacion" },
            {
                "data": "id_presentacion",
                render: function(data) {
                    return '<a href="#" data-codigo="' + data +
                        '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                }
            },
            {
                "data": "id_presentacion",
                render: function(data) {
                    return '<a href="#" data-codigo="' + data +
                        '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>';
                }
            }
        ]
    });

    presentacion();
});