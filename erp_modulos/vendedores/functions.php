<?php
require "../../config/config.php";
require_once ROOT_PATH . "/libs/database.php";

if ($_POST) {
    switch ($_POST["action"]) {
        case "insertVendedor":
            insertUser();
            break;

        case "getVendedor":
            getUser($_POST["id_vendedor"]);
            break;

        case "updateVendedor":
            updateUser($_POST["id_vendedor"]);
            break;

        case "deleteVendedor":
            deleteUser($_POST["id_vendedor"]);
            break;

        default:
            # code...
            break;
    }
}

function insertVendedor()
{
    global $db;
    $duplicateEmail = false;
    if (empty(trim($_POST["codigo_vendedor"])) || empty(trim($_POST["nombre_vendedor"])) || empty(trim($_POST["domicilio_vendedor"])) || empty(trim($_POST["telefono_vendedor"])) || empty(trim($_POST["comision_vendedor"]))  || empty(trim($_POST["correo_vendedor"]))|| $_POST["id_perfil"] == "0") {
        $res["status"] = 0;
    } else if ($_POST["correo_vendedor"] != filter_var($_POST["correo_vendedor"], FILTER_VALIDATE_EMAIL)) {
        $res["status"] = 2;
    } else if (!validatePhone($_POST["telefono_vendedor"])) {
        $res["status"] = 4;
    } else {
        $duplicateEmail = validateEmail("vendedores", "correo_vendedor", $_POST["correo_vendedor"]);
        if (!$duplicateEmail) {
            $db->insert("vendedores", [
                "codigo_vendedor" => $_POST["codigo_vendedor"],
                "nombre_vendedor" => $_POST["nombre_vendedor"],
                "domicilio_vendedor" => $_POST["domicilio_vendedor"],
                "telefono_vendedor" => $_POST["telefono_vendedor"],
                "comision_vendedor" => $_POST["comision_vendedor"],
                "correo_vendedor" => $_POST["correo_vendedor"],
                "id_perfil" => $_POST["id_perfil"]
            ]);
            $res["status"] = 1;
        } else {
            $res["status"] = 3;
        }
    }
    echo json_encode($res);
}

function validatePhone($number)
{
    $pattern = "#^\(?\d{2}\)?[\s\.-]?\d{4}[\s\.-]?\d{4}$#";
    return preg_match($pattern, $number);
}

function validateEmail($table, $field, $param)
{
    global $db;
    $emails = $db->select($table, $field);
    foreach ($emails as $email) {
        if ($email == $param) {
            return true;
        }
    }
}

function getUser($id_vendedor)
{
    global $db;
    $user = $db->get("vendedores", "*", ["id_vendedor" => $id_vendedor]);
    echo json_encode($vendedor);
}

function updateUser($id_vendedor)
{
    global $db;
    if (empty(trim($_POST["codigo_vendedor"])) || empty(trim($_POST["nombre_vendedor"])) || empty(trim($_POST["domicilio_vendedor"])) || empty(trim($_POST["telefono_vendedor"])) || empty(trim($_POST["comision_vendedor"])) || empty(trim($_POST["correo_vendedor"]))|| $_POST["id_perfil"] == "0") {
        $res["status"] = 0;
    } else if ($_POST["correo_vendedor"] != filter_var($_POST["correo_vendedor"], FILTER_VALIDATE_EMAIL)) {
        $res["status"] = 2;
    } else if (!validatePhone($_POST["telefono_vendedor"])) {
        $res["status"] = 4;
    } else {
        $db->update(
            "vendedores",
            [
                "codigo_vendedor" => $_POST["codigo_vendedor"],
                "nombre_vendedor" => $_POST["nombre_vendedor"],
                "domicilio_vendedor" => $_POST["domicilio_vendedor"],
                "telefono_vendedor" => $_POST["telefono_vendedor"],
                "comision_vendedor" => $_POST["comision_vendedor"],
                "correo_vendedor" => $_POST["correo_vendedor"],
                "id_perfil" => $_POST["id_perfil"]
            ],
            ["id_vendedor" => $id_vendedor]
        );
        $res["status"] = 1;
    }
    echo json_encode($res);
}

function deleteVendedor($id_vendedor)
{
    global $db;
    $db->delete("vendedores", ["id_vendedor" => $id_vendedor]);
    $res["status"] = 1;
    echo json_encode($res);
}
