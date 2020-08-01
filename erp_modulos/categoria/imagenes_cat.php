<?php
$type = $_FILES['file']['type'];
$tmp_name = $_FILES['file']["tmp_name"];
$name = $_FILES['file']["name"];
$nuevo_path = "../../erp_vistas/img_catalogo/".$name;
move_uploaded_file($tmp_name, $nuevo_path);
$array = explode('.', $nuevo_path);
$ext = end($array);

$type = $_FILES['file2']['type'];
$tmp_name = $_FILES['file2']["tmp_name"];
$name = $_FILES['file2']["name"];
$nuevo_path = "../../erp_vistas/img_catalogo/".$name;
move_uploaded_file($tmp_name, $nuevo_path);
$array = explode('.', $nuevo_path);
$ext = end($array);

$type = $_FILES['file3']['type'];
$tmp_name = $_FILES['file3']["tmp_name"];
$name = $_FILES['file3']["name"];
$nuevo_path = "../../erp_vistas/img_catalogo/".$name;
move_uploaded_file($tmp_name, $nuevo_path);
$array = explode('.', $nuevo_path);
$ext = end($array);
?>