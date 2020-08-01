<?php 

    include("db.php");

    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $des = $_POST['descripcion'];
    $fechap = $_POST['fechaP'];
    $telefono = $_POST['telefono'];
    $cat = $_POST['id_categoria'];
    $prov = $_POST['id_provedor'];
    $Nimg1 = $_POST['img1'];
    $imgdir1 = "img_catalogo/".$Nimg1;
    $Nimg2 = $_POST['img2'];
    $imgdir2 = "img_catalogo/".$Nimg2;
    $Nimg3 = $_POST['img3'];
    $imgdir3 = "img_catalogo/".$Nimg3;

    
            $consulta="INSERT INTO productos(nombre_prod, precio_prod, des_prod, fech_prod, img_prod, tel_prod, id_cat_prod, id_provedor, img_prod_2, img_prod_3)
            VALUES ('$nombre', '$precio','$des', '$fechap', '$imgdir1', '$telefono', '$cat', '$prov', '$imgdir2', '$imgdir3')";
            $resul=mysqli_query($conectar, $consulta);
        
            header('location: ../Tproductos.php');
    
    ?>