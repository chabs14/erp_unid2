<?php 

    include("db.php");

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $des = $_POST['descripcion'];

    $cat = $_POST['id_categoria'];
    $prov = $_POST['id_provedor'];
    $Nimg1 = $_POST['img1'];
    $imgdir1 = "img_catalogo/".$Nimg1;
    $Nimg2 = $_POST['img2'];
    $imgdir2 = "img_catalogo/".$Nimg2;
    $Nimg3 = $_POST['img3'];
    $imgdir3 = "img_catalogo/".$Nimg3;

    
            $consulta="UPDATE productos SET nombre_prod ='$nombre', precio_prod='$precio', des_prod = '$des', img_prod ='$imgdir1', id_cat_prod ='$cat', 
             id_provedor='$prov', img_prod_2 = '$imgdir2', img_prod_3 = '$imgdir3' WHERE id_prod = '$id'";
            $resul=mysqli_query($conectar, $consulta);
        
            header('location: ../index.php');
    
    ?>