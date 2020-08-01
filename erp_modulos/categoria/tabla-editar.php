<?php
require_once '../../config/config.php';
require_once ROOT_PATH . '/libs/database.php';
session_start();
error_reporting(0);
$id_usr = $_SESSION['id'];
if (isset($id_usr)) {
    //Traer id del modulo actual
    $idModuloCostos = $db->select("modulos", "id_modulo", ["nombre_modulo" => "proveedores"]);
    //Si no puede consultar este modulo mostrar pagina de error
    if (!in_array($idModuloCostos[0], $_SESSION["consultar"])) {
        header("Location:" . URL . "/403.html");
    } else {
 include("funciones/db.php");
$id = $_GET["id"];
$cat = "SELECT * FROM categoria WHERE id_cat_provedor = '$id'";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Editar Categoria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Tables are the backbone of almost all web applications.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="./main.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>/main.css" />
        <link rel="stylesheet" href="<?php echo constant('URL') ?>/style.css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <?php include(ROOT_PATH . "/includes/navbar.php"); ?>

        <div class="app-main">
        <?php include(ROOT_PATH . "/includes/sidenav.php"); ?>

            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                                    </i>
                                </div>
                                <div>Módulo de Costos
                                    <div class="page-title-subheading">Editar Categoria
                                    </div>
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <div class="d-inline-block dropdown">
                                    <a href="index.php" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="col-lg-10">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <h5 class="card-title">Categorias</h5>
                                    <div class="table-responsive">
                                        <table class="mb-0 table">
                                            <tbody>
                                                <tr>
                                                    <?php $resultado = mysqli_query($conectar, $cat);

                                                    while ($row = mysqli_fetch_assoc($resultado)) { ?>

                                                        <form action="funciones/editar.php" method="POST"  onsubmit="return validarCat();">
                                                        <div class="position-relative form-group">
                                                                <input name="id" id="id" type="hidden" class="form-control" value="<?php echo $row["id_cat_provedor"] ?>">
                                                            </div>
                                                            <div class="position-relative form-group">
                                                                <label for="categoria" class="">Nombre de Categoria</label>
                                                                <input name="categoria" id="cat" type="text" class="form-control" value="<?php echo $row["nombre"] ?>">
                                                            </div>
                                                            <button type="submit" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-success">
                                                                Guardar Cambios
                                                            </button>
                                                    </form>
                                                </tr>
                                            <?php }
                                                    mysqli_free_result($resultado); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include(ROOT_PATH . "/includes/footer.php"); ?>

            </div>
        </div>
    </div>
    <script src="funciones/validarCat.js"></script>
    <script type="text/javascript" src="./assets/scripts/main.js"></script>
</body>

</html>
<?php
    }
} else {
    header('Location:' . URL . '/erp_modulos/login/index.php');
}
?>