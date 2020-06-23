$(document).ready(function () {
    var obj = {};

    $(".btnModulo").click(function (e) {
        e.preventDefault();
        console.log("oo)");
    });

    $("#newVendedor").click(function () {
        obj = {
            action: "insertVendedor",
        };
        $(".modal-title").text("NuevoVendedor");
        $("#btnInsertVendedor").text("Guardar");
        $("#formVendedor")[0].reset();
    });

    $(".btnEdit").click(function () {
        let id = $(this).attr("data");
        obj = {
            action: "getVendedor",
            id_usr: id,
        };
        $.post(
            "functions.php",
            obj,
            function (res) {
                $("#codigo_vendedor").val(res.codigo_vendedor);
                $("#nombre_vendedor").val(res.nombre_vendedor);
                $("#domicilio_vendedor").val(res.domicilio_vendedor);
                $("#telefono_vendedor").val(res.telefono_vendedor);
                $("#comision_vendedor").val(res.comision_vendedor);
                $("#correo_vendedor").val(res.correo_vendedor);
                $("#id_perfil").val(res.id_perfil);
                obj = {
                    action: "updateVendedor",
                    id_vendedor: id,
                };
            },
            "JSON"
        );
        $(".modal-title").text("Editar Vendedor");
        $("#btnInsertVendedor").text("Editar");
    });

    $(".btnDelete").click(function () {
        let id = $(this).attr("data");
        obj = {
            action: "deleteVendedor",
            id_vendedor: id,
        };
        Swal.fire({
            title: "¿Estás seguro?",
            text: "No podrás revertir los cambios.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33 ",
            cancelButtonText: "Cancelar",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Eliminar",
        }).then((result) => {
            if (result.value) {
                $.post(
                    "functions.php",
                    obj,
                    function (res) {
                        if (res.status == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "¡Perfecto!",
                                text: "Vendedor eliminado correctamente",
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    "JSON"
                );
            }
        });
    });

    $("#btnInsertVendedor").click(function () {
        $("#modalVendedor")
            .find("input")
            .map(function (i, e) {
                obj[e.name] = $(this).val();
            });
        $("#modalVendedor")
            .find("select")
            .map(function (i, e) {
                obj[e.name] = $(this).val();
            });

        switch (obj.action) {
            case "insertVendedor":
                $.post(
                    "functions.php",
                    obj,
                    function (res) {
                        if (res.status == 0) {
                            Swal.fire({
                                icon: "error",
                                title: "Error...",
                                text: "Campos vacios, favor de llenarlos correctamente.",
                            });
                        } else if (res.status == 2) {
                            Swal.fire({
                                icon: "error",
                                title: "Error...",
                                text: "Intentalo nuevamente.",
                            });
                        } else if (res.status == 3) {
                            Swal.fire({
                                icon: "error",
                                title: "Error...",
                                text: "Intentalo nuevamente.",
                            });
                        } else if (res.status == 4) {
                            Swal.fire({
                                icon: "error",
                                title: "Error...",
                                text: "Inserte un número de telefono valido.",
                            });
                        } else if (res.status == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "¡Perfecto!",
                                text: "Vendedor ingresado correctamente",
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    "JSON"
                );
                break;

            case "updateVendedor":
                $.post(
                    "functions.php",
                    obj,
                    function (res) {
                        if (res.status == 0) {
                            Swal.fire({
                                icon: "error",
                                title: "Error...",
                                text: "Campos vacios, favor de llenarlos correctamente.",
                            });
                        } else if (res.status == 2) {
                            Swal.fire({
                                icon: "error",
                                title: "Error...",
                                text: "Intentalo nuevamente.",
                            });
                        } else if (res.status == 4) {
                            Swal.fire({
                                icon: "error",
                                title: "Error...",
                                text: "Inserte un número de telefono valido.",
                            });
                        } else if (res.status == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "¡Perfecto!",
                                text: "Vendedor editado correctamente",
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    "JSON"
                );
                break;

            default:
                break;
        }
    });
});
