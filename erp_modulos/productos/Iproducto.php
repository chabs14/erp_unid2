<?php
require_once '../../config/config.php';
require_once ROOT_PATH . '/libs/database.php';
session_start();
error_reporting(0);
$id_usr = $_SESSION['id'];
if (isset($id_usr)) {
    //Traer id del modulo actual
    $idModuloCostos = $db->select("modulos", "id_modulo", ["nombre_modulo" => "reglamento"]);
    //Si no puede consultar este modulo mostrar pagina de error
    if (!in_array($idModuloCostos[0], $_SESSION["consultar"])) {
        header("Location:" . URL . "/403.html");
    } else {

    include ("funciones/db.php");

$categoria ="SELECT * FROM categoria";
$provedor = "SELECT id_provedor, nombre_pro FROM provedor";

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tablas Categorias</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Tables are the backbone of almost all web applications.">
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>/main.css" />
        <link rel="stylesheet" href="<?php echo constant('URL') ?>/style.css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link href="./main.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/jno6r4i4lpdnzqi1dqhbwm9remj4mk9tllzmc5diub23pw0o/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
     <script>
    tinymce.init({
      selector: '#descripcion'
    });
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
                                    <div class="page-title-subheading">Insertar Producto
                                    </div>
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <div class="d-inline-block dropdown">
                                    <a href="index.php"aria-haspopup="true"
                                    aria-expanded="false" class="btn-shadow btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="col-md-10">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <h5 class="card-title">Productos</h5>

                                    <form action="funciones/insertar_pro.php" method="POST" onsubmit="return validarPro();">
                                        <div class="position-relative form-group">
                                            <label for="nombre" class="">Nombre</label><p id="mensaje">
                                            <input name="nombre" id="nombre" type="text" class="form-control">
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="domicilio" class="">Precio</label>
                                            <input name="precio" id="precio" type="tex" class="form-control">
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="descripcion" class="">Descripcion</label>
                                            <textarea name="descripcion" id="descripcion" type="text" class="form-control"></textarea>
                                        </div>

                                      
                                        <div class="position-relative form-group">
                                        <label for="id_categoria" class="">Categoria</label>
                                            <select name="id_categoria" id="id_cat" type="text" class="form-control">
                                            <option value="0">Seleccione una categoria</option>
                                            <?php $resultado = mysqli_query($conectar, $categoria); 
                                                    while ($row = mysqli_fetch_assoc($resultado)) { ?>
                                                    
                                                    <option value="<?php echo $row["id_cat_provedor"];?>"><?php echo $row["nombre"];?></option>
                                                    <?php } mysqli_free_result($resultado); ?>
                                            </select>
                                        </div>
                                        <div class="position-relative form-group">
                                        <label for="id_categoria" class="">Provedor</label>
                                            <select name="id_provedor" id="id_pro" type="text" class="form-control">
                                            <option value="0">Seleccione un provedor</option>
                                            <?php $resultado = mysqli_query($conectar, $provedor); 
                                                    while ($row = mysqli_fetch_assoc($resultado)) { ?>
                                                    
                                                    <option value="<?php echo $row["id_provedor"];?>"><?php echo $row["nombre_pro"];?></option>
                                                    <?php } mysqli_free_result($resultado); ?>
                                            </select>
                                        </div>
                                        <div class="position-relative form-group">
                                        <label for="email" class="">Imagen 1</label>

                                        <input name="img1" id="img1" type="file" class="form-control" required>
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="email" class="">Imagen 2</label>
                                            <input name="img2" id="img2" type="file" class="form-control" required>
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="email" class="">Imagen 3</label>
                                            <input name="img3" id="img3" type="file" class="form-control" required>

                  

                                        </div>
                                        <button type="submit" id="btncatalogo" aria-haspopup="true"
                                            aria-expanded="false" class="btn-shadow btn btn-success">
                                            Agregar Producto
                                        </button>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include(ROOT_PATH . "/includes/footer.php"); ?>
            </div>
        </div>
    </div>
    <script src="funciones/validarPro.js"></script>
    <script type="text/javascript" src="./assets/scripts/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
  </script>

    <script src="imgcatalogo.js"></script>


</body>

</html>
<?php
}
} else {
    header('Location:' . URL . '/erp_modulos/login/index.php');
}
?>