<?php
require_once "../../config/config.php";
require_once ROOT_PATH . "/libs/database.php";
session_start();
error_reporting(0);
$id_vendedor = $_SESSION["id"];
if (isset($id_vendedor)) {
    //Traer id del modulo actual
    $idModuloVendedores = $db->select("modulos", "id_modulo", ["nombre_modulo" => "vendedores"]);
    //Si no puede consultar este modulo mostrar pagina de errorsss
    if (!in_array($idModuloVendedores[0], $_SESSION["consultar"])) {
        header("Location:" . URL . "/403.html");
    } else {
?>
        <!DOCTYPE html>
        <html lang="mx">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
            <link rel="stylesheet" href="<?php echo constant("URL") ?>/main.css" />
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
            <title>Vendedores</title>
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
                                            $iconoVendedores = $db->get("modulos", "icono_modulo", ["nombre_modulo" => "vendedores"]);
                                            ?>
                                            <i class="<?php echo $iconoVendedores; ?>"></i>
                                        </div>
                                        <!-- Title & subtitle -->
                                        <div>
                                            Consultar Vendedores
                                        </div>
                                    </div>
                                    <div class="page-title-actions">
                                        <?php
                                        //Si el id del modulo está en el array de permisos insertar muestra el boton
                                        if (in_array($idModuloVendedores[0], $_SESSION["insertar"])) :
                                        ?>
                                            <button class="btn btn-outline-success" data-toggle="modal" data-target="#modalVendedor" id="newVendedor">
                                                Nuevo Vendedor
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
                                            <table class="mb-0 table table-bordered text-center" id="tableVendedor">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                         <th>Codigo</th>
                                                        <th>Nombre</th>
                                                        <th>Domicilio</th>
                                                        <th>Telefono</th>
                                                        <th>Comision</th>
                                                        <th>Correo</th>
                                                        <?php
                                                        //Si el id del modulo se encuentra en el array de permisos editar o eliminar muestra el th
                                                        if (in_array($idModuloVendedores[0], $_SESSION["editar"]) || in_array($idModuloVendedores[0], $_SESSION["eliminar"])) :
                                                        ?>
                                                            <th>Acciones</th>
                                                        <?php
                                                        endif;
                                                        ?>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php
                                                    $vendedor = $db->select(
                                                        "vendedores(vendedor)",
                                                        [
                                                            "[><]perfiles(p)" => ["vendedor.id_perfil" => "id_perfil"]
                                                        ],
                                                        ["vendedor.id_vendedor", "vendedor.codigo_vendedor", "vendedor.nombre_vendedor", "vendedor.domicilio_vendedor", "vendedor.telefono_vendedor", "vendedor.comision_vendedor","vendedor.correo_vendedor","p.nombre_perfil"]
                                                    );
                                                    $number = 1;
                                                    foreach ($vendedor as $vendedor) {
                                                    ?>
                                                        <tr>
                                                            <th scope="row"><?php echo $number; ?></th>
                                                            <td><?php echo $vendedor['codigo_vendedor']; ?></td>
                                                            <td><?php echo $vendedor['nombre_vendedor']; ?></td>
                                                            <td><?php echo $vendedor['domicilio_vendedor']; ?></td>
                                                            <td><?php echo $vendedor['telefono_vendedor']; ?></td>
                                                            <td><?php echo $vendedor['comision_vendedor']; ?></td>
                                                            <td><?php echo $vendedor['correo_vendedor']; ?></td>
                                                            <td><?php echo ucfirst(strtolower($vendedor["nombre_perfil"])); ?></td>
                                                            <?php
                                                            //Si el id del modulo está en el array de permisos editar y eliminar muestra el td
                                                            if (in_array($idModuloVendedores[0], $_SESSION["editar"]) || in_array($idModuloVendedores[0], $_SESSION["eliminar"])) :
                                                            ?>
                                                                <td>
                                                                    <?php
                                                                    //Si el id del modulo está en el array de permisos editar muestra el boton
                                                                    if (in_array($idModuloVendedores[0], $_SESSION["editar"])) :
                                                                    ?>
                                                                        <button class="btnEdit mr-2 btn btn-outline-primary" data="<?php echo $vendedor['id_vendedor'] ?>" data-toggle="modal" data-target="#modalVendedor">
                                                                            Editar
                                                                        </button>
                                                                    <?php
                                                                    endif;

                                                                    //Si el id del modulo está en el array de permisos eliminar muestra el boton
                                                                    if (in_array($idModuloVendedores[0], $_SESSION["eliminar"])) :
                                                                    ?>
                                                                        <button class="btnDelete mr-2 btn btn-outline-danger" data="<?php echo $vendedor['id_vendedor'] ?>">
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
                                                        $number++;
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
            <script src="<?php echo constant("URL") ?>/assets/scripts/main.js"></script>
            <script src="<?php echo constant("URL") ?>/vendor/components/jquery/jquery.min.js"></script>
            <script src="<?php echo constant("URL") ?>/erp_modulos/vendedores/main.js"></script>
        </body>

        </html>

        <!-- Modal -->
        <div class="modal fade" id="modalVendedor" tabindex="-1" role="dialog" aria-labelledby="modalVendedor" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Insertar nuevo vendedor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formVendedor">
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="codigo_vendedor">Codigo</label>
                                    <input type="text" class="form-control" id="codigo_vendedor" name="codigo_vendedor" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre_vendedor">Nombre</label>
                                    <input type="text" class="form-control" id="nombre_vendedor" name="nombre_vendedor" placeholder="" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="domicilio_vendedor">Domocilio</label>
                                    <input type="text" class="form-control" id="domicilio_vendedor" name="domicilio_vendedor" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="telefono_vendedor">Telefono</label>
                                    <input type="text" class="form-control" id="telefono_vendedor" name="telefono_vendedor" placeholder="" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="comision_vendedor">Comision</label>
                                    <input type="text" class="form-control" id="comision_vendedor" name="comision_vendedor" placeholder="" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="correo_vendedor">Correo</label>
                                    <input type="text" class="form-control" id="correo_vendedor" name="correo_vendedor" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="id_perfil">Perfil</label>
                                    <select name="id_perfil" id="id_perfil" class="form-control">
                                        <option value="0">Seleccione un perfil</option>
                                        <?php
                                        $perfiles = $db->select('perfiles', '*');
                                        foreach ($perfiles as $perfil) {
                                        ?>
                                            <option value="<?php echo $perfil['id_perfil']; ?>">
                                                <?php echo ucfirst(strtolower($perfil["nombre_perfil"])); ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-outline-success" id="btnInsertVendedor" type="button">Guardar</button>
                        </form>
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