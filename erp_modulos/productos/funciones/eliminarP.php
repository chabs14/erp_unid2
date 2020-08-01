<?php 

    include("db.php");

    $id = $_GET['id'];

    $eliminar="DELETE FROM provedor WHERE id_provedor = '$id'";
    $resultado=mysqli_query($conectar, $eliminar);
    
    header('location: ../Tprovedores.php');
    ?>