<?php 

    include("db.php");
    $id = $_POST['id'];
    $categoria = $_POST['categoria'];

    $actualizar="UPDATE categoria SET nombre = '$categoria' WHERE id_cat_provedor = '$id'";
    $resultado=mysqli_query($conectar, $actualizar);
    
    header('location: ../tabla-categoria.php');
    ?>