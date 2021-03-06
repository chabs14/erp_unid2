<?php
require_once '../../config/config.php';
require_once ROOT_PATH . '/libs/database.php';
session_start();
error_reporting(0);
$id_usr = $_SESSION['id'];
if (isset($id_usr)) {
    //Traer id del modulo actual
    $idModuloTareas = $db->select("modulos", "id_modulo", ["nombre_modulo" => "tareas"]);
    //Si no puede consultar este modulo mostrar pagina de error
    if (!in_array($idModuloTareas[0], $_SESSION["consultar"])) {
        header("Location:" . URL . "/403.html");
    } else {
?>
    <!DOCTYPE html>
    <html lang="mx">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <link rel="stylesheet" href="<?php echo constant('URL') ?>/main.css" />
        <link rel="stylesheet" href="<?php echo constant('URL') ?>/style.css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">
        <title>Lista de tareas</title>
    </head>

    <body>
        <!-- Full Container -->
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            <!-- Navbar -->
            <?php include(ROOT_PATH . "/includes/navbar.php"); ?>
            <!-- Container app main -->
            <div class="app-main">
                <!-- Sidenav -->
                <?php include(ROOT_PATH . "/includes/sidenav.php"); ?>
                <!-- App Content -->
                <div class="app-main__outer">
                    <!-- Content -->
                    <div class="app-main__inner">
                        <!-- Page title -->
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <!-- Img title -->
                                    <div class="page-title-icon">
                                        <?php
                                        $iconoTareas = $db->get('modulos', 'icono_modulo', ['nombre_modulo' => 'tareas']);
                                        ?>
                                        <i class="<?php echo $iconoTareas; ?> icon-gradient bg-mean-fruit"></i>
                                    </div>
                                    <!-- Title & subtitle -->
                                    <div>
                                        Consultar lista de tareas
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                <?php
                                        //Si el id del modulo está en el array de permisos insertar muestra el boton
                                        if (in_array($idModuloTareas[0], $_SESSION["insertar"])) :
                                        ?>
                                            <button class="btn btn-outline-success" data-toggle="modal" data-target="#modalTareas" id="newTarea">
                                                Nueva tarea
                                            </button>
                                        <?php
                                        endif;
                                        ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <table class="mb-0 table table-bordered text-center" id="tableTareas">
                                            <thead>
                                                <tr>
                                                    <th data-width="260">Descripción</th>
                                                    <th>Fecha de asignación</th>
                                                    <th>Asignada por</th>
                                                    <th>Asignada a</th>
                                                    <th>Estatus</th>
                                                    <?php
                                                        //Si el id del modulo se encuentra en el array de permisos editar o eliminar muestra el th
                                                    if (in_array($idModuloTareas[0], $_SESSION["editar"]) || in_array($idModuloTareas[0], $_SESSION["eliminar"])) :
                                                    ?>
                                                    <th>Acciones</th>
                                                    <?php
                                                    endif;
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $tareas = $db/* ->debug() */->select("tareas(t)",[
                                                    "[>]usuarios(u)" => ["t.usr_tar" => "id_usr"],
                                                    "[>]usuarios(us)" => ["t.usr2_tar" => "id_usr"],
                                                ],[
                                                    "t.id_tar",
                                                    "t.desc_tar",
                                                    "t.fechaasig_tar", 
                                                    "t.usr_tar",
                                                    "t.usr2_tar",
                                                    "t.status_tar",
                                                    "u.nombre_usr",
                                                    "us.nombre_usr(usuario2)"
                                                ],[
                                                    "OR" => [
                                                        "t.usr_tar" => $id_usr,
                                                        "t.usr2_tar" => $id_usr
                                                    ]
                                                ]
                                                );
                                                    foreach ($tareas as $tarea) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $tarea["desc_tar"]; ?></td>
                                                        <td><?php echo $tarea["fechaasig_tar"]; ?></td>
                                                        <td><?php echo $tarea["usuario2"]; ?></td>
                                                        <td><?php echo $tarea["nombre_usr"]; ?></td>
                                                        <?php
                                                        switch($tarea["status_tar"]){
                                                            case "No iniciado":
                                                                ?>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton-<?php echo $tarea["id_tar"]; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <?php echo $tarea["status_tar"]; ?>
                                                                        </button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-<?php echo $tarea["id_tar"]; ?>">
                                                                            <?php
                                                                            if($id_usr == $tarea["usr_tar"]){
                                                                                ?>
                                                                                <a class="dropdown-item iniciar-tarea" href="javascript:void(0)" data-tarea="<?php echo $tarea["id_tar"]; ?>">Iniciar Tarea</a>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                            <a class="dropdown-item detalles-tarea" href="javascript:void(0)" data-toggle="modal" data-target="#tiempoDetallesModal" data-tarea="<?php echo $tarea["id_tar"]; ?>">Detalles</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <?php
                                                            break;
                                                            case "Iniciado":
                                                                ?>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton-<?php echo $tarea["id_tar"]; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <?php echo $tarea["status_tar"]; ?>
                                                                        </button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-<?php echo $tarea["id_tar"]; ?>">
                                                                            <?php
                                                                            if($id_usr == $tarea["usr_tar"]){
                                                                                ?>
                                                                                <a class="dropdown-item pausar-tarea" href="javascript:void(0)" data-tarea="<?php echo $tarea["id_tar"]; ?>">Pausar tarea</a>
                                                                                <a class="dropdown-item terminar-tarea" href="javascript:void(0)" data-tarea="<?php echo $tarea["id_tar"]; ?>">Marcar como terminada</a>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                            <a class="dropdown-item detalles-tarea" href="javascript:void(0)" data-toggle="modal" data-target="#tiempoDetallesModal" data-tarea="<?php echo $tarea["id_tar"]; ?>">Detalles</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <?php
                                                            break;
                                                            case "Pausado":
                                                                ?>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton-<?php echo $tarea["id_tar"]; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <?php echo $tarea["status_tar"]; ?>
                                                                        </button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-<?php echo $tarea["id_tar"]; ?>">
                                                                            <?php
                                                                            if($id_usr == $tarea["usr_tar"]){
                                                                                ?>
                                                                                <a class="dropdown-item reanudar-tarea" href="javascript:void(0)" data-tarea="<?php echo $tarea["id_tar"]; ?>">Reanudar tarea</a>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                            <a class="dropdown-item detalles-tarea" href="javascript:void(0)" data-toggle="modal" data-target="#tiempoDetallesModal" data-tarea="<?php echo $tarea["id_tar"]; ?>">Detalles</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <?php
                                                            break;
                                                            case "Completado":
                                                                ?>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton-<?php echo $tarea["id_tar"]; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <?php echo $tarea["status_tar"]; ?>
                                                                        </button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-<?php echo $tarea["id_tar"]; ?>">
                                                                            <a class="dropdown-item detalles-tarea terminadisimo" href="javascript:void(0)" data-toggle="modal" data-target="#tiempoDetallesModal" data-tarea="<?php echo $tarea["id_tar"]; ?>">Detalles</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <?php
                                                            break;
                                                            default:
                                                                ?>
                                                                <td><div class="badge badge-danger">No definido</div></td>
                                                                <?php
                                                            break;
                                                        }
                                                        ?>
                                                        <?php
                                                            //Si el id del modulo se encuentra en el array de permisos editar o eliminar muestra el td
                                                            if (in_array($idModuloTareas[0], $_SESSION["editar"]) || in_array($idModuloTareas[0], $_SESSION["eliminar"])) :
                                                            ?>
                                                                <td>
                                                                    <?php
                                                                    //Si el id del modulo está en el array de permisos editar muestra el boton
                                                                    if (in_array($idModuloTareas[0], $_SESSION["editar"])) :
                                                                    ?>
                                                                        <button class="btnEdit mr-2 btn btn-outline-primary" data-id="<?php echo $tarea['id_tar'] ?>" data-toggle="modal" data-target="#modalTareas">
                                                                            Editar
                                                                        </button>
                                                                    <?php
                                                                    endif;

                                                                    //Si el id del modulo está en el array de permisos eliminar muestra el boton
                                                                    if (in_array($idModuloTareas[0], $_SESSION["eliminar"])) :
                                                                    ?>
                                                                        <button class="btnDelete mr-2 btn btn-outline-danger" data-id="<?php echo $tarea["id_tar"]; ?>">
                                                                            Eliminar
                                                                        </button>
                                                                    <?php
                                                                    endif;
                                                                    ?>
                                                                </td>
                                                            <?php
                                                            endif;
                                                            ?>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer -->
                    <?php include(ROOT_PATH . "/includes/footer.php"); ?>
                </div>
                <!-- /App Content -->
            </div>
            <!-- /Container app main -->
        </div>
        <!-- /Full Container -->
        <script type="text/javascript" src="<?php echo constant('URL') ?>/assets/scripts/main.js"></script>
        <script type="text/javascript" src="<?php echo constant('URL') ?>/vendor/components/jquery/jquery.min.js"></script>
        <script src="https://cdn.tiny.cloud/1/pwzdplmh9jw9bm4mxpjzjmnr5958n79k1v636aeb82h9zivw/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script src="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.js"></script>
        <!-- TINYMCE -->
        <script type="text/javascript">
            tinyMCE.init({
                selector: "#desc_tar",
                mode: "textareas",
                plugins: "paste,link,preview,lists, advlist",
                theme_advanced_buttons3_add: "pastetext,pasteword,selectall,link",
                paste_auto_cleanup_on_paste: true
            });
            $('#tableTareas').bootstrapTable({
                pagination: true,
                search: true
            });
        </script>
        <script type="text/javascript" src="<?php echo constant('URL') ?>/erp_modulos/tareas/main.js"></script>
    </body>

    </html>

    <!-- Modal -->
    <div class="modal fade" id="modalTareas" tabindex="-1" role="dialog" aria-labelledby="modalTareas" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Insertar nueva tarea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTareas">
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <h6>Descripción de la tarea:</h6>
                                <textarea id="desc_tar" name="desc_tar"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Asignado a:</label>
                                <select name="usr_tar" id="usr_tar" class="form-control">
                                    <?php
                                    global $db;
                                    $query = $db->select("usuarios","*",["ORDER" =>["id_usr" => "ASC"]]);
                                        foreach($query as $clave => $valor){
                                    ?>
                                    <option value="<?php echo $valor['id_usr']; ?>"><?php echo $valor['nombre_usr']; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <!-- ASIGNADO POR -->
                                <input type="hidden" name="usr2_tar" id="usr2_tar" value="<?php echo($id_usr) ?>"> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label>Fecha límite:</label>
                                <input type="date" class="form-control" id="fechaentrega_tar" name="fechaentrega_tar">
                            </div>
                            <!-- <div class="col-md-6 mb-3">
                                <label>Estatus:</label>
                                <select name="status_tar" id="status_tar" class="form-control"> 
                                <option value="No iniciado">No iniciado</option>
                                <option value="Iniciado">Iniciado</option>
                                <option value="Pausado">Pausado</option>
                                <option value="Completado">Completado</option>
                                </select>
                            </div> -->
                        </div>
                        <button class="btn btn-outline-success" id="btnInsertTarea" type="button">Insertar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Small modal -->
    <div class="modal fade" id="tiempoDetallesModal" tabindex="-1" role="dialog" aria-labelledby="tiempoDetallesModal" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
            </div>
        </div>
    </div>
    <?php
    }
} else {
    header("Location:" . URL . "/erp_modulos/login/index.php");
}
?>