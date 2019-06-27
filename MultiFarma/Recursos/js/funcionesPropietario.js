var dt;

function propietario() {
    $(".content-header").on("click", "a.editar", function() {
        $("#titulo").html("Editar Propietario");
        //Recupera datos del fromulario
        var codigo = $(this).data("codigo");

        $("#nuevo-editar").load("./Vista/Propietario/editarPropietario.php");
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#propietario").removeClass("show");
        $("#propietario").addClass("hide");
        $.ajax({
            type: "get",
            url: "./Controlador/controladorPropietario.php",
            data: { codigo: codigo, accion: "consultar" },
            dataType: "json"
        }).done(function(propietario) {
            if (propietario.respuesta === "no existe") {
                swal({
                    type: "error",
                    title: "Oops...",
                    text: "Propietario no existe!"
                });
            } else {
                $("#id_propietario").val(propietario.codigo);
                $("#nombre_propietario").val(propietario.nombre);
                $("#apellido_propietario").val(propietario.apellido);
                $("#direccion_propietario").val(propietario.direccion);
                $("#telefono_propietario").val(propietario.telefono);
            }
        });
    });

    $(".content-header").on("click", "a.borrar", function() {
        //Recupera datos del formulario
        var codigo = $(this).data("codigo");

        swal({
            title: "¿Está seguro?",
            text: "¿Realmente desea borrar el propietario con codigo : " + codigo + " ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Borrarlo!"
        }).then(decision => {
            if (decision.value) {
                var request = $.ajax({
                    method: "get",
                    url: "./Controlador/controladorPropietario.php",
                    data: { codigo: codigo, accion: "borrar" },
                    dataType: "json"
                });

                request.done(function(resultado) {
                    if (resultado.respuesta == "correcto") {
                        swal(
                            "Borrado!",
                            "El propietario con codigo : " + codigo + " fue borrado",
                            "success"
                        );
                        dt.ajax.reload();
                    } else {
                        swal({
                            type: "error",
                            title: "Oops...",
                            text: "Something went wrong!"
                        });
                    }
                });

                request.fail(function(jqXHR, textStatus) {
                    swal({
                        type: "error",
                        title: "Oops...",
                        text: "Something went wrong!" + textStatus
                    });
                });
            }
        });
    });

    $(".content-header").on("click", "button.btncerrar", function() {
        $("#contenedor").removeClass("show");
        $("#contenedor").addClass("hide");
        $(".content-header").html("");
    });

    $(".content-header").on("click", "button.btncerrar2", function() {
        $("#titulo").html("Listado de Propietarios");
        $("#nuevo-editar").html("");
        $("#nuevo-editar").removeClass("show");
        $("#nuevo-editar").addClass("hide");
        $("#propietario").removeClass("hide");
        $("#propietario").addClass("show");
    });

    $(".content-header").on("click", "button#nuevo", function() {
        $("#titulo").html("Nueva ciudad");
        $("#nuevo-editar").load("./Vista/Propietario/nuevoPropietario.php");
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#propietario").removeClass("show");
        $("#propietario").addClass("hide");
    });

    $(".content-header").on("click", "button#actualizar", function() {
        var datos = $("#fpropietario").serialize();
        $.ajax({
            type: "get",
            url: "./Controlador/controladorpropietario.php",
            data: datos,
            dataType: "json"
        }).done(function(resultado) {
            if (resultado.respuesta) {
                swal(
                    "Actualizado!",
                    "Se actualizaron los datos correctamente",
                    "success"
                );
                dt.ajax.reload();
                $("#titulo").html("Listado Propietarios");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#propietario").removeClass("hide");
                $("#propietario").addClass("show");
            } else {
                swal({
                    type: "error",
                    title: "Oops...",
                    text: "Something went wrong!"
                });
            }
        });
    });

    $(".content-header").on("click", "button#grabar", function() {
        var codigo = document.forms["fpropietario"]["id_propietario"].value;

        $.ajax({
            type: "get",
            url: "./Controlador/controladorPropietario.php",
            data: { codigo: codigo, accion: "consultar" },
            dataType: "json"
        }).done(function(propietario) {
            if (propietario.respuesta == "no existe") {
                var datos = $("#fpropietario").serialize();

                $.ajax({
                    type: "get",
                    url: "./Controlador/controladorPropietario.php",
                    data: datos,
                    dataType: "json"
                }).done(function(resultado) {
                    if (resultado.respuesta) {
                        swal("Grabado!!", "El registro se grabó correctamente", "success");
                        dt.ajax.reload();
                        $("#titulo").html("Listado propietarios");
                        $("#nuevo-editar").html("");
                        $("#nuevo-editar").removeClass("show");
                        $("#nuevo-editar").addClass("hide");
                        $("#propietario").removeClass("hide");
                        $("#propietario").addClass("show");
                    } else {
                        swal({
                            type: "error",
                            title: "Oops...",
                            text: "Something went wrong!"
                        });
                    }
                });
            } else {
                swal({
                    type: "error",
                    title: "Oops...",
                    text: "El propietario ya existe!!!!!"
                });
            }
        });
    });
}
$(document).ready(() => {
    $(".content-header").off("click", "a.editar");
    $(".content-header").off("click", "button#actualizar");
    $(".content-header").off("click", "a.borrar");
    $(".content-header").off("click", "button#nuevo");
    $(".content-header").off("click", "button#grabar");
    $("#titulo").html("Listado de Propietarios");
    dt = $("#tabla").DataTable({
        ajax: "./Controlador/controladorPropietario.php?accion=listar",
        columns: [
            { data: "id_propietario" },
            { data: "nombre_propietario" },
            { data: "apellido_propietario" },
            { data: "direccion_propietario" },
            { data: "telefono_propietario" },
            {
                data: "id_propietario",
                render: function(data) {
                    return (
                        '<a href="#" data-codigo="' +
                        data +
                        '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                    );
                }
            },
            {
                data: "id_propietario",
                render: function(data) {
                    return (
                        '<a href="#" data-codigo="' +
                        data +
                        '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>'
                    );
                }
            }
        ]
    });

    propietario();
});