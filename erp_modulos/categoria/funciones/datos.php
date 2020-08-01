<?php 
include 'db.php';
$estado=$_POST['estado'];

	$sql="SELECT id_estado,
			estadonombre,
			 id_p 
		from estado 
		where id_p='$estado'";

	$result=mysqli_query($conectar,$sql);

	$cadena="<label for='provedores'>Estado</label> 
			<select name='estado' id='estado' type='text' class='form-control'>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[1]).'</option>';
	}

	echo  $cadena."</select>";
	

?>