<?php
include("funciones/db.php");
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
    <title>Tablas Categorias</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Tables are the backbone of almost all web applications.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="./main.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Costos CxC/CxP</li>
                            <li>
                                <a href="Tprovedores.php">
                                    <i class="metismenu-icon pe-7s-id"></i>
                                    Proveedores
                                </a>
                            </li>
                            <li>
                                <a href="Treglamento.php">
                                    <i class="metismenu-icon pe-7s-notebook"></i>
                                    Reglamentos
                                </a>
                            </li>
                            <li>
                                <a href="tabla-categoria.php">
                                    <i class="metismenu-icon pe-7s-albums"></i>
                                    Categorias
                                </a>
                            </li>
                            <li>
                                <a href="Tproductos.php">
                                    <i class="metismenu-icon pe-7s-albums"></i>
                                    Productos
                                </a>
                            </li>
                            <li>
                                <a href="Vi_producto.php">
                                    <i class="metismenu-icon pe-7s-albums"></i>
                                    catalogo
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
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
                                    <a href="Tprovedores.php" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-danger">Cancelar</a>
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
                                                                <option value="<?php echo $filapais["id_pais"];?>"><?php echo $filapais["paisnombre"];?></option>
                                                                <?php } mysqli_free_result($resu); ?>
                                                                </select>
                                                            </div>

                                                            <div class="position-relative form-group">
                                                            <label for="pais" class="">Estado</label>
                                                                <select name="estado" id="estado" type="text" class="form-control">
                                                                <option value="<?php echo $row["id_estado"];?>"><?php echo $row["estadonombre"];?></option>
                                                                <?php
                                                                $cestado ="SELECT * FROM estado";
                                                                $restado = mysqli_query($conectar, $cestado); 
                                                                while ($files = mysqli_fetch_assoc($restado)) { ?>
                                                                <option value="<?php echo $files["id_estado"];?>"><?php echo $files["estadonombre"];?></option>
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
                                                                        <option value="<?php echo $cat["id_cat_provedor"];?>"><?php echo $cat["nombre"]?></option>
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
            </div>
        </div>
    </div>
    <script src="funciones/validar.js"></script>
    <script type="text/javascript" src="./assets/scripts/main.js"></script>
    
</body>

</html>
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