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
// include("./funciones/db.php");
// $cat = "SELECT * FROM categoria"
    include ("funciones/db.php");
$id = $_GET["id"];
$prov = "SELECT p1.id_provedor, p1.nombre_pro, p1.domicilio, p1.cp, p1.localidad, p1.id_estado, p3.estadonombre, p1.id_pais, p4.paisnombre, p1.telefono, p1.email, p2.nombre 
    FROM provedor p1 INNER JOIN categoria p2 on p1.id_categoria = p2.id_cat_provedor INNER JOIN estado p3 on p1.id_estado = p3.id_estado INNER JOIN paises p4 on p1.id_pais = p4.id_pais WHERE p1.id_provedor ='$id'";

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Editar Proveedor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Tables are the backbone of almost all web applications.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="./main.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>/main.css" />
        <link rel="stylesheet" href="<?php echo constant('URL') ?>/style.css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
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
                                    <div class="page-title-subheading">Editar Proveedores
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
                                    <h5 class="card-title">Proveedores</h5>
                                    <div class="table-responsive">
                                        <table class="mb-0 table">
                                            <tbody>
                                                <tr>
                                                    <?php $resultado = mysqli_query($conectar, $prov);

                                                    while ($row = mysqli_fetch_assoc($resultado)) { ?>

                                                        <form action="funciones/editarP.php" method="POST" onsubmit="return validar();">
                                                            <div class="position-relative form-group">
                                                                <input name="id" type="hidden" class="form-control" value="<?php echo $row["id_provedor"] ?>">
                                                            </div>
                                                            <div class="position-relative form-group">
                                                                <label for="provedores" class="">Nombre o Razon social</label>
                                                                <input name="nombre" id="nombre" type="text" class="form-control" value="<?php echo $row["nombre_pro"] ?>" require>
                                                            </div>
                                                            <div class="position-relative form-group">
                                                                <label for="provedores" class="">Domicilio</label>
                                                                <input name="domicilio" id="domicilio" type="text" class="form-control" value="<?php echo $row["domicilio"] ?>" required>
                                                            </div>
                                                            <div class="position-relative form-group">
                                                                <label for="provedores" class="">Codigo Postal</label>
                                                                <input name="codigopostal" id="cp" type="text" class="form-control" value="<?php echo $row["cp"] ?>" required>
                                                            </div>
                                                            
                                                            <div class="position-relative form-group">
                                                            <label for="pais" class="">Pais</label>
                                                                <select name="pais" id="pais" type="text" class="form-control">
                                                                <option value="<?php echo $row["id_pais"];?>"><?php echo $row["paisnombre"];?></option>
                                                                <?php
                                                                $cpais ="SELECT * FROM paises";
                                                                $resu = mysqli_query($conectar, $cpais); 
                                                                while ($filapais = mysqli_fetch_assoc($resu)) { ?>
                                                                <option value="<?php echo $filapais["id_pais"];?>"><?php echo utf8_encode($filapais["paisnombre"])?></option>
                                                                <?php } mysqli_free_result($resu); ?>
                                                                </select>
                                                            </div>

                                                            <div class="position-relative form-group">
                                                            <label for="pais" class="">Estado</label>
                                                                <select name="estado" id="estado" type="text" class="form-control">
                                                                <option value="<?php echo $row["id_estado"];?>"><?php echo utf8_encode($row["estadonombre"])?></option>
                                                                <?php
                                                                $cestado ="SELECT * FROM estado";
                                                                $restado = mysqli_query($conectar, $cestado); 
                                                                while ($files = mysqli_fetch_assoc($restado)) { ?>
                                                                <option value="<?php echo $files["id_estado"];?>"><?php echo utf8_encode($files["estadonombre"])?></option>
                                                                <?php } mysqli_free_result($restado); ?>
                                                                </select>
                                                            </div>
                                                            
                                                            
                                                            
                                                            <div class="position-relative form-group">
                                                                <label for="provedores" class="">Ciudad</label>
                                                                <input name="localidad" id="localidad" type="text" class="form-control" value="<?php echo $row["localidad"] ?>" required>
                                                            </div>
                                                            <div class="position-relative form-group">
                                                                <label for="provedores" class="">Telefono</label>
                                                                <input name="telefono" id="telefono" type="text" class="form-control" value="<?php echo $row["telefono"] ?>"required>
                                                            </div>
                                                            <div class="position-relative form-group">
                                                                <label for="provedores" class="">Email</label>
                                                                <input name="email" id="email" type="text" class="form-control" value="<?php echo $row["email"] ?>"required>
                                                            </div>
                                                                                                                        
                                                            <div class="position-relative form-group">
                                                                <label for="provedores" class="">Categoria</label>
                                                                <select name="id_categoria" id="cat" type="text" class="form-control">
                                                                <?php
                                                                    $consulta ="SELECT * FROM categoria";
                                                                    $resulcat = mysqli_query($conectar, $consulta); 
                                                                    while ($cat = mysqli_fetch_assoc($resulcat)) { ?>
                                                                        <option value="<?php echo $cat["id_cat_provedor"];?>"><?php echo utf8_encode($cat["nombre"])?></option>
                                                                <?php } mysqli_free_result($resulcat); ?>
                                                                 </select>
                                                            </div>
                                                            <button type="submit" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-success">
                                                                Guardar Cambios
                                                            </button>
                                                        
                                                        </form>
                                                </tr>
                                                    <?php }mysqli_free_result($resultado); ?>
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
    <script src="funciones/validar.js"></script>
    <script type="text/javascript" src="./assets/scripts/main.js"></script>
    
</body>

</html>
<?php
    }
} else {
    header('Location:' . URL . '/erp_modulos/login/index.php');
}
?>
<script type="text/javascript">
    $(document).ready(function(){
        //$('#pais').val(1);
        recargarListae();

        $('#pais').change(function(){
            recargarListae();
        });
    })
</script>
<script type="text/javascript">
    function recargarListae(){
        $.ajax({
            type:"POST",
            url:"funciones/datos.php",
            cache: false,
            data:"estado =" + $('#pais').val(),
            success:function(r){
                console.log ($('#estados').html(r));
            }
        });
    }
</script>