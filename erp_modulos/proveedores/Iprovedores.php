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

$consulta ="SELECT * FROM categoria";
$cpais ="SELECT * FROM paises";
$paises ="SELECT P.id_pais, p.paisnombre, e.id_estado, e.estadonombre FROM paises p INNER JOIN estado e on e.id_p = p.id_pais";

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Nuevo Proveedor</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Tables are the backbone of almost all web applications.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="./main.css" rel="stylesheet">
    <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
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
                                    <div class="page-title-subheading">Insertar Proveedore
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
                                    <h5 class="card-title">Proveedores</h5>

                                    <form action="funciones/insertarP.php" method="POST" onsubmit="return validar();">
                                        <div class="position-relative form-group">
                                            <label for="nombre" class="">Nombre o Razon Social</label><p id="mensaje">
                                            <input name="nombre" id="nombre" type="text" class="form-control">
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="domicilio" class="">Domicilio</label>
                                            <input name="domicilio" id="domicilio" type="text" class="form-control">
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="codigpostal" class="">Codigo Postal</label>
                                            <input name="codigopostal" id="cp" type="text" class="form-control">
                                        </div>

                                        <div class="position-relative form-group">
                                            <label for="pais" class="">Pais</label>
                                            <select name="pais" id="pais" type="text" class="form-control">
                                            <option value="0">Seleccione un pais</option>
                                            <?php $resu = mysqli_query($conectar, $cpais); 
                                                    while ($row = mysqli_fetch_assoc($resu)) { ?>
                                                    <option value="<?php echo $row["id_pais"];?>"><?php echo utf8_encode($row["paisnombre"])?></option>
                                                    <?php } mysqli_free_result($resu); ?>
                                            </select>
                                        </div>

                                        
                                        <div class="position-relative form-group" id="lista2">
                                        </div>

                                        <div class="position-relative form-group">
                                            <label for="localidad" class="">ciudad</label>
                                            <input name="localidad" id="localidad" type="text" class="form-control">
                                        </div>
                                        

                                        <div class="position-relative form-group">
                                            <label for="telefono" class="">Telefono</label>
                                            <input name="telefono" id="telefono" type="text" class="form-control">
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="email" class="">Email</label>
                                            <input name="email" id="email" type="text" class="form-control">
                                        </div>
                                        <div class="position-relative form-group">
                                        <label for="id_categoria" class="">Categoria</label>
                                            <select name="id_categoria" id="id_cat" type="text" class="form-control">
                                            <option value="0">Seleccione una categoria</option>
                                            <?php $resultado = mysqli_query($conectar, $consulta); 
                                                    while ($row = mysqli_fetch_assoc($resultado)) { ?>
                                                    
                                                    <option value="<?php echo $row["id_cat_provedor"];?>"><?php echo utf8_encode($row["nombre"])?></option>
                                                    <?php } mysqli_free_result($resultado); ?>
                                            </select>
                                        </div>
                                        <button type="submit" id="btn" aria-haspopup="true"
                                            aria-expanded="false" class="btn-shadow btn btn-success">
                                            Agregar Provedor
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
    <script src="funciones/validar.js"></script>
    <script type="text/javascript" src="./assets/scripts/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

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
		recargarLista();

		$('#pais').change(function(){
			recargarLista();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"funciones/datos.php",
			data:"estado=" + $('#pais').val(),
			success:function(r){
				$('#lista2').html(r);
			}
		});
	}
</script>