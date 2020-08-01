<?php
include 'funciones/db.php';

$categoria ="SELECT * FROM categorias_prod";
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
    <link href="./main.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/jno6r4i4lpdnzqi1dqhbwm9remj4mk9tllzmc5diub23pw0o/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
     <script>
    tinymce.init({
      selector: '#descripcion'
    });
  </script>
    
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
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
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
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
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
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
                        <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
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
                                <a href="Tproductos.php">
                                    <i class="metismenu-icon pe-7s-albums"></i>
                                    Catálogo
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
                                    <div class="page-title-subheading">Insertar Producto
                                    </div>
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <div class="d-inline-block dropdown">
                                    <a href="Tproductos.php"aria-haspopup="true"
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
                                            <label for="localidad" class="">Fecha de publicacion</label>
                                            <input name="fechaP" id="fechaP" type="date" class="form-control">
                                        </div>
                                        

                                        <div class="position-relative form-group">
                                            <label for="telefono" class="">Telefono</label>
                                            <input name="telefono" id="telefono" type="text" class="form-control">
                                        </div>
                                        <div class="position-relative form-group">
                                        <label for="id_categoria" class="">Categoria</label>
                                            <select name="id_categoria" id="id_cat" type="text" class="form-control">
                                            <option value="0">Seleccione una categoria</option>
                                            <?php $resultado = mysqli_query($conectar, $categoria); 
                                                    while ($row = mysqli_fetch_assoc($resultado)) { ?>
                                                    
                                                    <option value="<?php echo $row["id_cat_prod"];?>"><?php echo $row["nombre_cat"];?></option>
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
