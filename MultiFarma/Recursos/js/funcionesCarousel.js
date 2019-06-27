var dt;

function carousel() {

    $(".content-header").on("click", "a.borrar", function() {
        //Recupera datos del formulario
        var codigo = $(this).data("codigo");

        swal({
            title: "¿Está seguro?",
            text: "¿Realmente desea borrar el carousel con id : " + codigo + " ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Borrarlo!"
        }).then(decision => {
            if (decision.value) {
                var request = $.ajax({
                    method: "get",
                    url: "./Controlador/controladorCarousel.php",
                    data: { codigo: codigo, accion: "borrar" },
                    dataType: "json"
                });

                request.done(function(resultado) {
                    if (resultado.respuesta == "correcto") {
                        swal(
                            "Borrado!",
                            "Carousel con codigo : " + codigo + " fue borrada",
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
                        text: "No pudo ser Borrado!" + textStatus
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
        $("#titulo").html("Listado de Proveedores");
        $("#nuevo-editar").html("");
        $("#nuevo-editar").removeClass("show");
        $("#nuevo-editar").addClass("hide");
        $("#proveedor").removeClass("hide");
        $("#ciudproveedorad").addClass("show");
    });

    $(".content-header").on("click", "button#nuevo", function() {
        $(this).hide();
        $("#titulo").html("Subir Imagenes");
        $("#nuevo-editar").load('./Vista/Carousel/CargarImg.php', function() {
            $("#nuevo-editar").removeClass('hide');
            $("#nuevo-editar").addClass('show');
            $("#proveedor").removeClass('show');
            $("#proveedor").addClass('hide');

            $.ajax({
                type: "get",
                url: "./Controlador/controladorCarousel.php",
                data: { accion: 'listar' },
                dataType: "json"
            }).done(function(resultado) {;
                $("#id_carousel option").remove()
                $("#imagen").append("<option selecte value=''>Seleccione una imagen</option>")
                $.each(resultado.data, function(index, value) {
                    $("#id_carousel").append("<option value='" + value.id_carousel + "'>" + value.imagen + "</option>")
                });
            });
            $("#id_carousel").change(function() {
                $("#id_carousel option:selected").each(function() {
                    var id_carousel = document.forms['fcarousel']['id_carousel'].value;
                    $.ajax({
                        type: "get",
                        url: "./Controlador/controladorCarousel.php",
                        data: { codigo: id_carousel, accion: 'listarC' },
                        dataType: "json"
                    }).done(function(resultado) {;
                        $("#id_carousel option").remove()
                        if (id_carousel === "") {
                            $("#id_carousel").append("<option selecte value=''>Seleccione primero un id</option>")
                        } else {
                            $("#imagen").append("<option selecte value=''>Seleccione una imagen</option>")
                            $.each(resultado.data, function(index, value) {
                                $("#imagen").append("<option value='" + value.id_carousel + "'>" + value.imagen + "</option>")
                            });
                        }
                    });
                });
            });
        });

    });

    $(".content-header").on("click", "button#actualizar", function() {
        var datos = $("#fproveedor").serialize();
        $.ajax({
            type: "get",
            url: "./Controlador/controladorCarousel.php",
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
                $("#titulo").html("carousel");
                $("#nuevo-editar").html("");
                $("#nuevo-editar").removeClass("show");
                $("#nuevo-editar").addClass("hide");
                $("#carousel").removeClass("hide");
                $("#carousel").addClass("show");
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

        var codigo = document.forms["fcarousel"]["id_carousel"].value;
        
        $.ajax({
            type: "get",
            url: "./Controlador/controladorCarousel.php",
            data: { codigo: codigo, accion: 'consultar' },
            dataType: "json"
        }).done(function(proveedor) {
            if (proveedor.respuesta == "no existe") {
                
                var datos = $("#fcarousel").serialize();                   
                
                var form_data = new FormData();
                var file_data = $('#imagen').prop('files')[0];    
                form_data.append('file', file_data);                
                // form_data.append('id_carousel', codigo);             

                $.ajax({
                    type: "post",
                    url: "./Controlador/controladorCarousel.php?"+datos,
                    data: form_data,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function(resultado) {
                    if (resultado.respuesta) {
                        swal(
                            'Grabado!!',
                            'El registro se grabó correctamente',
                            'success'
                        )
                        dt.ajax.reload();
                        $("#titulo").html("Carousel");
                        $("#nuevo-editar").html("");
                        $("#nuevo-editar").removeClass("show");
                        $("#nuevo-editar").addClass("hide");
                        $("#carousel").removeClass("hide");
                        $("#carousel").addClass("show")
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
                    text: 'El ID ya existe!!!!!'
                })
            }
        });
    });

    $(".content-header").on("click", "a.editar", function() {
        $("#titulo").html("Editar carousel");
        //Recupera datos del fromulario
        var codigo = $(this).data("codigo");


        $("#nuevo-editar").load("./Vista/Carousel/editarImg.php", function() {
            $("#nuevo-editar").addClass('show');
            $("#nuevo-editar").removeClass('hide');
            $("#carousel").addClass('hide');
            $("#carousel").removeClass('show');

            $.ajax({
                type: "get",
                url: "./Controlador/controladorCarousel.php",
                data: { codigo: codigo, accion: 'consultar' },
                dataType: "json"
            }).done(function(proveedor) {
                if (proveedor.respuesta === "no existe") {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Carousel Inexistente!'
                    })
                } else {
                    $("#id_carousel").val(carousel.id_carousel);
                    $("#imagen").val(carousel.imagen);

                }
            });
        });
    });
}

$(document).ready(() => {
    $(".content-header").off("click", "a.editar");
    $(".content-header").off("click", "button#actualizar");
    $(".content-header").off("click", "a.borrar");
    $(".content-header").off("click", "button#nuevo");
    $(".content-header").off("click", "button#grabar");
    $("#titulo").html("Listado Carousel");
    dt = $("#tabla").DataTable({
        ajax: "./Controlador/controladorCarousel.php?accion=listar",
        columns: [
            { data: "id_carousel" },
            { data: "imagen" },
            {
                data: "id_carousel",
                render: function(data) {
                    return (
                        '<a href="#" data-codigo="' +
                        data +
                        '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                    );
                }
            },
            {
                data: "id_carousel",
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

    carousel();
});