<?php
require '../../config/config.php';
require_once ROOT_PATH . '/libs/database.php';

if ($_POST) {
    switch ($_POST["action"]) {
        case 'insertVendedor':
            insertVendedor();
            break;

        case 'getVendedor':
            getVendedor($_POST["empleado_id"]);
            break;

        case 'updateVendedor':
            updateVendedor($_POST["empleado_id"]);
            break;

        case 'deleteVendedor':
            deleteVendedor($_POST["id_vendedor"]);
            break;

        default:
            # code...
            break;
    }
}

function insertVendedor()
{
    global $db;
    $respuesta = [];
    $empleado_id = ($_POST['empleado_id']);


    if (empty($empleado_id) == '1') {
        $respuesta['status'] = 0;
    } else {
        $db->insert('vendedores', [
            "empleado_id" => $empleado_id,
        ]
    );
        $respuesta['status'] = 1;
    }


    echo json_encode($respuesta);
}

function getVendedor($id_empleado)
{
    global $db;
    $vendedor = $db->get("vendedores", "*", ["empleado_id" => $id_empleado]);
    echo json_encode($vendedor);
}

function updateVendedor($id_vendedor)
{

    $empleado_id = ($_POST['empleado_id']);
    if (empty($empleado_id) == '1') {
        $respuesta['status'] = 0;
    } else {
    global $db;
        $db->update(
            "vendedores",
            [
                "empleado_id" => $empleado_id
            ]
        );

        $respuesta["status"] = 1;
    }
    echo json_encode($respuesta);
}

function deleteVendedor($id_vendedor)
{
    global $db;
    $db->delete("vendedores", ["id_vendedor" => $id_vendedor]);
    $respuesta["status"] = 1;
    echo json_encode($respuesta);
}
