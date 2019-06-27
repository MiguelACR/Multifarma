var dt;

function ciudad() {
    $(".content-header").on("click", "a.editar", function() {
        $("#titulo").html("Editar Ciudad");
        //Recupera datos del fromulario
        var codigo = $(this).data("codigo");
        var pais;

        $("#nuevo-editar").load("./Vista/Ciudades/editarCiudad.php");
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#ciudad").removeClass("show");
        $("#ciudad").addClass("hide");
        $.ajax({
            type: "get",
            url: "./Controlador/controladorCiudad.php",
            data: { codigo: codigo, accion: "consultar" },
            dataType: "json"
        }).done(function(ciudad) {
            if (ciudad.respuesta === "no existe") {
                swal({
                    type: "error",
                    title: "Oops...",
                    text: "Ciudad no existe!"
                });
            } else {
                $("#id_ciudad").val(ciudad.codigo);
                $("#nombre_ciudad").val(ciudad.ciudad);
                pais = ciudad.pais;
            }
        });

        $.ajax({
            type: "get",
            url: "./Controlador/controladorPais.php",
            data: { accion: 'listar' },
            dataType: "json"
        }).done(function(resultado) {
            $("#id_pais option").remove();
            $.each(resultado.data, function(index, value) {

                if (pais === value.id_pais) {
                    $("#id_pais").append("<option selected value='" + value.id_pais + "'>" + value.nombre_pais + "</option>")
                } else {
                    $("#id_pais").append("<option value='" + value.id_pais + "'>" + value.nombre_pais + "</option>")
                }
            });
        });
    });

    $(".content-header").on("click", "a.borrar", function() {
        //Recupera datos del formulario
        var codigo = $(this).data("codigo");

        swal({
            title: "¿Está seguro?",
            text: "¿Realmente desea borrar la ciudad con codigo : " + codigo + " ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Borrarlo!"
        }).then(decision => {
            if (decision.value) {
                var request = $.ajax({
                    method: "get",
                    url: "./Controlador/controladorCiudad.php",
                    data: { codigo: codigo, accion: "borrar" },
                    dataType: "json"
                });

                request.done(function(resultado) {
                    if (resultado.respuesta == "correcto") {
                        swal(
                            "Borrado!",
                            "La ciudad con codigo : " + codigo + " fue borrada",
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
        $("#titulo").html("Listado de Ciudades");
        $("#nuevo-editar").html("");
        $("#nuevo-editar").removeClass("show");
        $("#nuevo-editar").addClass("hide");
        $("#ciudad").removeClass("hide");
        $("#ciudad").addClass("show");
    });

    $(".content-header").on("click", "button#nuevo", function() {
        $("#titulo").html("Nueva ciudad");
        $("#nuevo-editar").load("./Vista/Ciudades/nuevoCiudad.php");
        $("#nuevo-editar").removeClass("hide");
        $("#nuevo-editar").addClass("show");
        $("#ciudad").removeClass("show");
        $("#ciudad").addClass("hide");
        $.ajax({
            type: "get",
            url: "./Controlador/controladorPais.php",
            data: { accion: 'listar' },
            dataType: "json"
        }).done(function(resultado) {
            //console.log(resultado.data)
            // DATOS DE PAIS
            $("#id_pais option").remove()
            $("#id_pais").append("<option selecte value=''>Seleccione un pais</option>")
            $.each(resultado.data, function(index, value) {
                $("#id_pais").append("<option value='" + value.id_pais + "'>" + value.nombre_pais + "</option>")
            });
        });
    });

    $(".content-header").on("click", "button#actualizar", function() {
        var datos = $("#fciudad").serialize();
        $.ajax({
            type: "get",
            url: "./Controlador/controladorCiudad.php",
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
                $("#titulo").html("Listado Ciudad");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#ciudad").removeClass("hide");
                $("#ciudad").addClass("show");
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
        var codigo = document.forms["fciudad"]["id_ciudad"].value;
        $.ajax({
            type: "get",
            url: "./Controlador/controladorCiudad.php",
            data: { codigo: codigo, accion: 'consultar' },
            dataType: "json"
        }).done(function(ciudad) {
            if (ciudad.respuesta == "no existe") {
                var datos = $("#fciudad").serialize();

                $.ajax({
                    type: "get",
                    url: "./Controlador/controladorCiudad.php",
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
                        $("#titulo").html("Listado ciudades");
                        $("#nuevo-editar").html("");
                        $("#nuevo-editar").removeClass("show");
                        $("#nuevo-editar").addClass("hide");
                        $("#ciudad").removeClass("hide");
                        $("#ciudad").addClass("show")
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
                    text: 'La ciudad ya existe!!!!!'
                })
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
    $("#titulo").html("Listado de Ciudades");
    dt = $("#tabla").DataTable({
        ajax: "./Controlador/controladorCiudad.php?accion=listar",
        columns: [
            { data: "id_ciudad" },
            { data: "nombre_ciudad" },
            { data: "nombre_pais" },
            {
                data: "id_ciudad",
                render: function(data) {
                    return (
                        '<a href="#" data-codigo="' +
                        data +
                        '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                    );
                }
            },
            {
                data: "id_ciudad",
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

    ciudad();
});