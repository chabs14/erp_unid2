<?php 

    include("db.php");

    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];

    $actualizar="UPDATE reglamento SET titulo = '$titulo', descripcion = '$descripcion', fecha = '$fecha' WHERE id = '$id'";
    $resultado=mysqli_query($conectar, $actualizar);
    
    header('location: ../Treglamento.php');
    ?>