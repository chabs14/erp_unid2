<?php 

    include("db.php");

    $id = $_GET['id'];

    $eliminar="DELETE FROM productos WHERE id_prod = '$id'";
    $resultado=mysqli_query($conectar, $eliminar);
    
    header('location: ../Tproductos.php');
    ?>