<?php
require "../../config/config.php";
require_once ROOT_PATH . "/libs/database.php";
require_once ROOT_PATH . "/vendor/autoload.php";

use Fpdf\Fpdf;

if($_POST){
    switch($_POST['accion']){
        case 'registro-asistencia':
            registroAsistencia();
        break;
        case 'registro-salida':
            registroSalida();
        break;
        case 'generar-reporte-retardos':
            generarReporteRetardos();
        break;
    }
}

function registroAsistencia(){
    extract($_POST);
    global $db;
    $res = $db->get("empleados_rh", "*", [
        "number" => $number
    ]);
    if($res){
        $db->insert("asistencia", [
            "codigo_persona" => $number,
            "fecha_hora" => $fecha_hora,
            "tipo" => "entrada",
            "fecha" => $fecha,
            "empleado_id" => $res['id'],
            "departamento_id" => $res['department']
        ]);
        $resultado['status'] = 1;
    } else {
        $resultado['status'] = 0;
    }
    echo json_encode($resultado);
}

function registroSalida(){
    extract($_POST);
    global $db;
    $res = $db->get("empleados_rh", "*", [
        "number" => $number
    ]);
    if($res){
        $db->insert("asistencia", [
            "codigo_persona" => $number,
            "fecha_hora" => $fecha_hora,
            "tipo" => "salida",
            "fecha" => $fecha,
            "empleado_id" => $res['id'],
            "departamento_id" => $res['department']
        ]);
        $resultado['status'] = 1;
    } else {
        $resultado['status'] = 0;
    }
    echo json_encode($resultado);
}

function generarReporteRetardos(){
    extract($_POST);
    global $db;
    $nombreDia = strtolower(date('l', strtotime($fecha)))."From";
    // $segunda_consulta = $db->get("horarios_puestos_rh(hp)", $nombreDia, [
    //     "hp.id" => "h.id"
    // ]);
    $resultado = $db->select("asistencia(a)", [
        "[>]empleados_rh(e)" => ["a.empleado_id" => "id"],
        "[>]departamentos_rh(d)" => ["a.departamento_id" => "id"],
        "[>]puestos_empleados_rh(p)" => ["e.position" => "id"],
        "[>]horarios_puestos_rh(h)" => ["e.position" => "positionId"]
    ], [
        "a.fecha_hora", "a.codigo_persona", "a.tipo", "a.fecha",
        "e.name(nombre)", "e.lastname", "e.mothersLastname",
        "d.name",
        "h.".$nombreDia, "h.id",
        "p.positionName"
    ], [
        "a.fecha" => $fecha,
        "a.tipo" => "entrada",
        "a.codigo_persona[!]" => null,
        "h.".$nombreDia."[!]" => null
    ]);
    foreach($resultado as $key => $value){
        if(date($value["fecha_hora"]) < date($fecha." ".$value[$nombreDia])){
            unset($resultado[$key]);
        }
    }
    $resultado = array_values($resultado);
    $pdf = new Fpdf('P', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $title = "Reporte de retardos";
    $wpage = $pdf->GetPageWidth();
    $wstring = $pdf->GetStringWidth($title);
    $pdf->Cell($wpage, 10, $title, 0, 1, 'C');
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell($wpage, 10, $fecha, 0, 1, 'C');
    foreach($resultado as $key => $value){
        $nombreWidth = $pdf->GetStringWidth($value["nombre"]);
        $apellidoWidth = $pdf->GetStringWidth($value["lastname"]);
        $otroApellidoWidth = $pdf->GetStringWidth($value["mothersLastname"]);
        $pdf->Cell($nombreWidth + 1, 10, $value["nombre"]);
        $pdf->Cell($apellidoWidth + 1, 10, $value["lastname"]);
        $pdf->Cell($otroApellidoWidth + 1, 10, $value["mothersLastname"]);
        $pdf->Ln();
        $pdf->Cell($pdf->GetStringWidth("Hora de entrada: "), 10, "Hora de entrada: ");
        $tam = $pdf->GetStringWidth($value[$nombreDia]) + 1;
        $pdf->Cell($tam, 10, $value[$nombreDia]);
        $pdf->Ln();
        $pdf->Cell($pdf->GetStringWidth("Hora de llegada: "), 10, "Hora de llegada: ");
        $otrotam = $pdf->GetStringWidth($value["fecha_hora"]) + 1;
        $pdf->Cell($otrotam, 10, $value["fecha_hora"]);
        $pdf->Ln();
        $pdf->Cell($pdf->GetStringWidth($value["name"]), 10, $value["name"]);
        $pdf->Ln();
        $pdf->Cell($pdf->GetStringWidth($value["positionName"]), 10, $value["positionName"]);
        $pdf->Ln();
        $pdf->Cell($pdf->GetStringWidth($value["codigo_persona"]), 10, $value["codigo_persona"]);
        $pdf->Ln();
        $pdf->Line($pdf->GetX(), $pdf->GetY() + 1, $pdf->GetPageWidth() - 10, $pdf->GetY() + 1);
        $pdf->Ln();
    }
    // header("Content-type:application/pdf");
    // It will be called downloaded.pdf
    // header("Content-Disposition:attachment;filename='downloaded.pdf'");
    // The PDF source is in original.pdf
    // readfile("reporte-".$fecha.".pdf");
    $pdf->Output("reporte-".$fecha.".pdf", "F");
    $nombreArchivo["nombre"] = "reporte-".$fecha.".pdf";
    echo json_encode($nombreArchivo);
}
?>