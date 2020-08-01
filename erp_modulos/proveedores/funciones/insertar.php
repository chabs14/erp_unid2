<?php 

    include("db.php");

    
    $categoria = $_POST['categoria'];

    

   

    $consulta="INSERT INTO categoria (nombre) VALUES ('$categoria')";
    $resul=mysqli_query($conectar, $consulta);

    header('location: ../tabla-categoria.php')
    
    ?>