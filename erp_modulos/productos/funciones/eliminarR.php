<?php 

    include("db.php");

    $id = $_GET['id'];

    $eliminar="DELETE FROM reglamento WHERE id = '$id'";
    $resultado=mysqli_query($conectar, $eliminar);
    
    header('location: ../Treglamento.php');
    ?>