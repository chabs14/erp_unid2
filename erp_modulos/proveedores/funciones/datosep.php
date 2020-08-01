<?php 
include 'db.php';
$estado=$_POST['estado'];


	$tabla="SELECT * from estado where id_p='$estado' ";

	$resul=mysqli_query($conectar,$tabla);

	$cade="<label for='provedores'>Estado</label> 
			<select name='estado' id='estado' type='text' class='form-control'>";

	while ($vera=mysqli_fetch_row($resul)) {
		$cade=$cade.'<option value='.$vera[0].'>'.utf8_encode($vera[1]).'</option>';
	}

	echo  $cade."</select>";
	

?>