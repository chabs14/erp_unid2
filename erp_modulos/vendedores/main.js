$(document).ready(function () {
    var obj = {};

    $(".btnModulo").click(function (e) {
        e.preventDefault();
        console.log("hola");
    });

    $("#newVendedor").click(function () {
        obj = {
            action: "insertVendedor",
        };
        $(".modal-title").text("Nuevo vendedor");
        $("#btnInsertVendedor").text("Insertar");
        $("#formVendedores")[0].reset();
    });

    $(".btnEdit").click(function () {
        let id = $(this).attr("data");
        obj = {
            action: "getVendedor",
            empleado_id:id,
        };
        $.post(
            "functions.php",
            obj,
            function (res) {
                $("#empleado_id").val(res.empleado_id);
                obj = {
                    action: "updateVendedor",
                    empleado_id:id,
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
        $("#modalVendedores")
            .find("input")
            .map(function (i, e) {
                obj[e.name] = $(this).val();
            });
        $("#modalVendedores")
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
