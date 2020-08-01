<?php 

    include("db.php");

    $nombre = $_POST['nombre'];
    $dom = $_POST['domicilio'];
    $cp = $_POST['codigopostal'];
    $loca = $_POST['localidad'];
    $estado = $_POST['estado'];
    $pais = $_POST['pais'];
    $tel = $_POST['telefono'];
    $email = $_POST['email'];
    $cat = $_POST['id_categoria'];

    
            $consulta="INSERT INTO provedor (nombre_pro, domicilio, cp, localidad, id_estado, id_pais, telefono, email, id_categoria)
            VALUES ('$nombre','$dom','$cp','$loca','$estado','$pais','$tel','$email','$cat')";
            $resul=mysqli_query($conectar, $consulta);
        
            header('location: ../Tprovedores.php');
    
    ?>