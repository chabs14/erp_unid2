<?php
require_once '../../config/config.php';
require_once ROOT_PATH . '/libs/database.php';
session_start();
error_reporting(0);
$id_usr = $_SESSION['id'];
if (isset($id_usr)) {
    //Traer id del modulo actual
    $idModuloCostos = $db->select("modulos", "id_modulo", ["nombre_modulo" => "costos"]);
    //Si no puede consultar este modulo mostrar pagina de error
    if (!in_array($idModuloCostos[0], $_SESSION["consultar"])) {
        header("Location:" . URL . "/403.html");
    } else {
 include("funciones/db.php");
 $cat = "SELECT * FROM categoria";
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tablas Categorias</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Tables are the backbone of almost all web applications.">
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>/main.css" />
        <link rel="stylesheet" href="<?php echo constant('URL') ?>/style.css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link href="./main.css" rel="stylesheet">
</head>
    <script type="text/javascript">

    function confirmar(){
        var respuesta = confirm("Está seguro de eliminar este registro");

        if (respuesta == true){
            return true;
        }
        else{
            return false;
        }
    }
        
    </script>
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
                                    <div class="page-title-subheading">Tabla de Categorias
                                    </div>
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <div class="d-inline-block dropdown">
                                    <a href="insertar-categoria.php" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-outline-success">Nueva Categoria</a>
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
                                            <thead>
                                                <tr>
                                                    
                                                    <th>Nombre</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <?php
                                                    $resultado = mysqli_query($conectar, $cat);
                                                    while ($row = mysqli_fetch_assoc($resultado)) {
                                                        ?>
                                                    <tr>
                                                        <td><?php echo utf8_encode($row["nombre"]); ?></td>
                                                        <td>
                                                            <a href="tabla-editar.php?id=<?php echo $row["id_cat_provedor"]; ?>" type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info">Editar
                                                                </a>
                                                            <a href="funciones/eliminar.php?id=<?php echo $row["id_cat_provedor"]; ?>" type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-danger" onclick="return confirmar()">Eliminar
                                                                </a>
                                                        </td>
                                                    </tr>
                                                       
                                            <?php
                                             }
                                             mysqli_free_result($resultado);
                                            ?>
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
    <script type="text/javascript" src="../../assets/scripts/main.js"></script>
</body>
</html>
<?php
    }
} else {
    header('Location:' . URL . '/erp_modulos/login/index.php');
}
?>