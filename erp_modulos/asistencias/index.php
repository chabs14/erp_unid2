<?php
require_once '../../config/config.php';
require_once ROOT_PATH . '/libs/database.php';
session_start();
error_reporting(0);
$id_usr = $_SESSION['id'];
$filter = false;
if($_GET){
    $filter = true;
}
date_default_timezone_set("America/Cancun");
$fecha_actual = date('Y-m-d');
$query;
$tipo;
if (isset($id_usr)) {
    //Traer id del modulo actual
    $idModuloTareas = $db->select("modulos", "id_modulo", ["nombre_modulo" => "tareas"]);
    //Si no puede consultar este modulo mostrar pagina de error
    if (!in_array($idModuloTareas[0], $_SESSION["consultar"])) {
        header("Location:" . URL . "/403.html");
    } else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reloj Checador</title>
	<link rel="stylesheet" href="<?php echo constant('URL') ?>/main.css" />
    <link rel="stylesheet" href="<?php echo constant('URL') ?>/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css">
</head>

<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
	<?php include(ROOT_PATH . "/includes/navbar.php"); ?>
	<div class="app-main">
		<?php include(ROOT_PATH . "/includes/sidenav.php"); ?>
		<div class="app-main__outer">
		<!-- Content -->
			<div class="app-main__inner">
				<!-- Page title -->
				<div class="app-page-title">
					<div class="page-title-wrapper">
						<div class="page-title-heading">
							<!-- Img title -->
							<div class="page-title-icon">
								<?php
								$iconoAsistencias = $db->get('modulos', 'icono_modulo', ['nombre_modulo' => 'asistencias']);
								?>
								<i class="<?php echo $iconoAsistencias; ?> icon-gradient bg-mean-fruit"></i>
							</div>
							<!-- Title & subtitle -->
							<div>
								Asistencias
							</div>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="card w-100">
								<div class="card-body">
									<form>
										<h5 class="card-title text-center">Bienvenido</h5>
										<div class="container">
											<div class="row">
												<div class="col-12">
													<div class="input-group mb-3">
													<input class="form-control" type="text" name="user" placeholder="Nº Colaborador" aria-label="Recipient's username" aria-describedby="basic-addon2">
														<div class="input-group-append">
															<span class="input-group-text" id="basic-addon2">
																<i class="fa fa-user" aria-hidden="true"></i>
															</span>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-6">
													<button class="btn btn-success d-block w-100" style="margin-bottom: 1rem;" type="button" id="register-btn">
														Registrar entrada
													</button>
												</div>
												<div class="col-6">
													<button class="btn btn-outline-success d-block w-100" type="button" id="register-salida">
														Registrar salida
													</button>
												</div>
											</div>
											<div class="row">
												<div class="col">
													<div class="text-center" id="mensaje"></div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card w-100">
								<div class="card-body text-center">
									<h5 class="card-title" id="diaSemana"></h5>
									<h6 class="card-subtitle mb-2 text-muted">
										<span id="dia"></span> de
										<span id="mes"></span> del
										<span id="year"></span>
									</h6>
									<div class="card-text" style="font-size: 2rem;">
										<span id="horas"></span>:<span id="minutos"></span>:<span id="segundos"></span> <span id="ampm"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
					if($filter){
						$query = $_GET['query'];
						$tipo = $_GET['tipo'];
					} else {
						$query = $fecha_actual;
						$tipo = "entrada";
					}
					?>
					<div class="row mt-3">
						<div class="col-lg-12">
							<div class="main-card mb-3 card">
								<div class="card-body">
									<div class="row">
										<div class="col-12 ml-auto text-right">
											<form>
												<div class="form-group">
													<div class="form-row">
														<div class="col-md-6 ml-auto">
															<input class="d-bock form-control" type="date" value="<?=$query;?>" id="filtro-fecha" max="<?=date("Y-m-d");?>">
														</div>
														<div class="col-md-4 my-2 text-center">
															<div class="form-check form-check-inline">
																<input class="form-check-input" type="radio" name="tipo" value="entrada" <?php if($tipo == "entrada"){ ?> checked <?php } ?>>
																<label class="form-check-label">Entrada</label>
															</div>
															<div class="form-check form-check-inline">
																<input class="form-check-input" type="radio" name="tipo" value="salida" <?php if($tipo == "salida"){ ?> checked <?php } ?>>
																<label class="form-check-label">Salida</label>
															</div>
														</div>
														<div class="col-md-2 text-center">
														<button class="d-block btn btn-info w-100" type="button" id="filtro">Filtrar</button>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
									<table class="mb-0 table table-bordered text-center">
										<thead>
											<tr>
												<th scope="col">Depto</th>
												<th scope="col">Empleado</th>
												<th scope="col">Código</th>
												<th scope="col">Hora de <?=$tipo?></th>
											</tr>
										</thead>
										<tbody>
											<?php
											// echo $query;
											$lista_hoy = $db->select('asistencia(a)', [
												"[>]empleados_rh(e)" => ["a.empleado_id" => "id"],
												"[>]departamentos_rh(d)" => ["a.departamento_id" => "id"],
												"[>]puestos_empleados_rh(p)" => ["e.position" => "id"],
												"[>]horarios_puestos_rh(h)" => ["e.position" => "positionId"]
											], [
												"e.name",
												"e.lastname",
												"e.mothersLastname",
												"d.name(depto)",
												"a.codigo_persona",
												"a.fecha_hora",
												"a.departamento_id(important)"
											], [
												"a.fecha" => $query,
												"a.tipo" => $tipo,
												"h.".strtolower(date('l', strtotime($query)))."From[!]" => null
											]);
											foreach($lista_hoy as $h){
											?>
												<tr>
													<td><?php echo $h["depto"];?></td>
													<td><?php echo $h["name"]." ".$h["lastname"]." ".$h["mothersLastname"];?></td>
													<td><?php echo $h["codigo_persona"];?></td>
													<?php
													$dia_actual_consulta = $db->get('horarios_puestos_rh(h)', [
														"[>]puestos_empleados_rh(p)" => ["h.positionId" => "id"]
													], [
															strtolower(date('l', strtotime($query)))."From"
													], [
														"p.positionDepartment" => $h["important"]
													]);
													// echo date("Y-m-d");
													// print_r($dia_actual_consulta);
													?>
													<?php
													if($h["fecha_hora"] <= $query." ".$dia_actual_consulta[strtolower(date('l', strtotime($query)))."From"] && $tipo == "entrada"){
														?>
														<td class="text-success">
															<?php
															$hora = explode(" ", $h["fecha_hora"]);
															echo $hora[1];
															?>
														</td>
														<?php
													} else if($h["fecha_hora"] > $query." ".$dia_actual_consulta[strtolower(date('l', strtotime($query)))."From"] && $tipo == "entrada") {
														?>
														<td class="text-warning">
															<?php $hora = explode(" ", $h["fecha_hora"]);
															echo $hora[1];
															?>
														</td>
														<?php
													} else {
														?>
														<td>
															<?php $hora = explode(" ", $h["fecha_hora"]);
															echo $hora[1];
															?>
														</td>
														<?php
													}
													?>
												</tr>
											<?php
											}
											if(!$lista_hoy){
												?>
												<tr>
													<td colspan="4" class="text-center">No hay registros el día de hoy!</td>
												</tr>
												<?php
											}
											?>
										</tbody>
									</table>
									<div class="row">
										<div class="col-6 mx-auto">
											<button type="button" class="btn btn-outline-info d-block w-100" id="generar-reporte-retardos" data-fecha="<?=$query;?>">Generar reporte de retardos del día <?=$query;?></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php include(ROOT_PATH . "/includes/footer.php"); ?>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo constant('URL') ?>/assets/scripts/main.js"></script>
<script type="text/javascript" src="<?php echo constant('URL') ?>/vendor/components/jquery/jquery.min.js"></script>
<script type="text/javascript" src="main.js"></script>
<script>
    $('#filtro').click(function(){
        let tipo = $('input[name=tipo]:checked').val();
        location.href = "./index.php?query=" + $('#filtro-fecha').val() + "&tipo=" + tipo;
	});
</script>
</body>

</html>
<?php
    }
} else {
    header("Location:" . URL . "/erp_modulos/login/index.php");
}
?>