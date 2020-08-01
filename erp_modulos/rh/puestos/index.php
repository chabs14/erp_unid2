<?php include __DIR__ . "/../common/session.php";?>
<!DOCTYPE html>
<html lang="mx">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,
    user-scalable=no, shrink-to-fit=no"/>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="/main.css"/>
    <link rel="stylesheet" href="positions.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src=" ../common/factory.js"></script>
    <script src="positions.js"></script>

    <title>Módulos</title>
</head>

<body>
<!-- Full Container -->
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <?php include(ROOT_PATH . "/includes/navbar.php"); ?>
    <!-- Container app main -->
    <div class="app-main">
        <?php include(ROOT_PATH . "/includes/sidenav.php"); ?>
        <!-- App Content -->
        <div class="app-main__outer">
            <!-- Content -->
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <!-- Img title -->
                            <div class="page-title-icon">
                                <i class="fas fa-network-wired"></i>
                            </div>
                            <!-- Title & subtitle -->
                            <div>
                                Consultar Puestos
                            </div>
                        </div>
                        <?php if (in_array($_SESSION['module'], $_SESSION['insertar'])) { ?>
                            <div class="page-title-actions">
                                <a class="btn btn-outline-success" data-toggle="modal" data-target="#modal-submit"
                                   href="#"
                                   role="button"
                                   id="newPosition">
                                    Nuevo puesto
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="container main-container col-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="container">
                            </div>
                            <table class="mb-0 table table-bordered text-center" id="table-pos">
                                <thead>
                                <tr>
                                    <th scope="col" data-sortable="true">#</th>
                                    <th scope="col" data-sortable="true">Puesto</th>
                                    <th scope="col" data-sortable="true">Departamento</th>
                                    <th scope="col" data-sortable="true">Es supervisor</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <div class="app-wrapper-footer">
                <div class="app-footer">
                    <div class="app-footer__inner">
                        <div class="app-footer-left">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link">
                                        Footer Link 1
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="app-footer-right">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link">
                                        Footer Link 2
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /App Content -->
        </div>
        <!-- /Container app main -->
    </div>
    <!-- /Full Container -->
    <div class="modal fade" id="modal-submit" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submit-label">Insertar nueva posición de trabajo</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-pos">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Puesto:</label>
                            <input type="text" class="form-control" id="positionName" name="positionName">
                        </div>
                        <div class="form-group">
                            <label for="positionDepartment">Departamento:</label>
                            <div class="input-group">
                                <select class="form-control" id="positionDepartment" name="positionDepartment">
                                    <option>Choose</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="positionIsSupervisor"
                                   name="positionIsSupervisor" value="0" onclick="$(this).val(this.checked ? 1 : 0)"
                            >
                            <label for="positionIsSupervisor" class="form-check-label">Es supervisor</label>
                        </div>
                    </form>
                        <br>
                        <div id="schedule">
                            <label>Horario del puesto:</label>
                        <!-- <div class="custom-control custom-switch" style="float: right;">
                                <input type="checkbox" class="custom-control-input" id="multiselector">
                                <label class="custom-control-label" for="multiselector">Multiselector</label>
                             </div> -->
                            <div class="collapse" id="multi">
                                 <div class="form-row">
                                    <div class="form-group col-4">
                                        <div class="input-group">
                                            <select class="form-control" id="multi-select" name="multi-select" multiple>
                                                <option>Selecionar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-8">
                                        <div class="collapse days" id="multi" data-parent="#schedule">
                                            <div id="multiSchedule">
                                                <form id="multiSchedule-form">
                                                    <div class="collapse" id="multiTurn">
                                                        <div class="form-row  text-center">
                                                            <div class="input-group sm-3 col">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">De:</span>
                                                                </div>
                                                                <input class="form-control" type="text" id="multiFrom" name="multiFrom">
                                                            </div>
                                                            <div class="input-group sm-3 col">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">A:</span>
                                                                </div>
                                                                <input class="form-control" type="text" id="multiTo" name="multiTo">
                                                            </div>
                                                            <div class="col-1">
                                                                <button class="btn btn-info" type="button" data-toggle="collapse"
                                                                        data-target="#multiSecondTurn" data-util="add-turn"
                                                                        aria-expanded="false" aria-controls="multiSecondTurn"><i
                                                                            class="fa"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="collapse turn" id="multiSecondTurn">
                                                        <div class="form-row  text-center">
                                                            <div class="input-group sm-3 col">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">De:</span>
                                                                </div>
                                                                <input class="form-control" type="text" id="multiSecondTurnFrom"
                                                                    name="multiSecondTurnFrom">
                                                            </div>
                                                            <div class="input-group sm-3 col">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">A:</span>
                                                                </div>
                                                                <input class="form-control" type="text" id="multiSecondTurnTo"
                                                                    name="multiSecondTurnTo">
                                                            </div>
                                                            <div class="col-1">
                                                                <button class="btn btn-info" type="button" data-toggle="collapse"
                                                                        data-target="#multiThirdTurn" data-util="add-turn"
                                                                        aria-expanded="false" aria-controls="multiThirdTurn"><i
                                                                            class="fa"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="collapse turn" id="multiThirdTurn">
                                                        <div class="form-row  text-center">
                                                            <div class="input-group sm-3 col">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">De:</span>
                                                                </div>
                                                                <input class="form-control" type="text" id="multiThirdTurnFrom"
                                                                    name="multiThirdTurnFrom">
                                                            </div>
                                                            <div class="input-group sm-3 col">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">A:</span>
                                                                </div>
                                                                <input class="form-control" type="text" id="multiThirdTurnTo"
                                                                    name="multiThirdTurnTo">
                                                            </div>
                                                            <div class="input-group col-1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="days-select-bar">
                                <div class="form-row  text-center">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-secondary active">
                                            <input type="radio" name="options" id="optionSunday" autocomplete="off"
                                                   data-toggle="collapse" data-target="#sunday" aria-expanded="true">
                                            Domingo
                                        </label>
                                        <label class="btn btn-secondary active">
                                            <input type="radio" name="options" id="optionSunday" autocomplete="off"
                                                   data-toggle="collapse" data-target="#monday" aria-expanded="true">
                                            Lunes
                                        </label>
                                        <label class="btn btn-secondary">
                                            <input type="radio" name="options" id="optionSunday" autocomplete="off"
                                                   data-toggle="collapse" data-target="#tuesday" aria-expanded="true">
                                            Martes
                                        </label>
                                        <label class="btn btn-secondary">
                                            <input type="radio" name="options" id="optionSunday" autocomplete="off"
                                                   data-toggle="collapse" data-target="#wednesday" aria-expanded="true">
                                            Miercoles
                                        </label>
                                        <label class="btn btn-secondary">
                                            <input type="radio" name="options" id="optionSunday" autocomplete="off"
                                                   data-toggle="collapse" data-target="#thursday" aria-expanded="true">
                                            Jueves
                                        </label>
                                        <label class="btn btn-secondary">
                                            <input type="radio" name="options" id="optionSunday" autocomplete="off"
                                                   data-toggle="collapse" data-target="#friday" aria-expanded="true">
                                            Viernes
                                        </label>
                                        <label class="btn btn-secondary">
                                            <input type="radio" name="options" id="optionSunday" autocomplete="off"
                                                   data-toggle="collapse" data-target="#saturday" aria-expanded="true">
                                            Sabado
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="container days">
                                <div class="collapse day" id="sunday" data-parent="#schedule">
                                    <div id="sundaySchedule">
                                        <form id="sundaySchedule-form">
                                            <div class="collapse show" id="sundayTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="sundayFrom" name="sundayFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="sundayTo" name="sundayTo">
                                                    </div>
                                                    <div class="col-1">
                                                        <button class="btn btn-info" type="button" data-toggle="collapse"
                                                                data-target="#sundaySecondTurn" data-util="add-turn"
                                                                aria-expanded="false" aria-controls="sundaySecondTurn"><i
                                                                    class="fa"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse turn" id="sundaySecondTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="sundaySecondTurnFrom"
                                                               name="sundaySecondTurnFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="sundaySecondTurnTo"
                                                               name="sundaySecondTurnTo">
                                                    </div>
                                                    <div class="col-1">
                                                        <button class="btn btn-info" type="button" data-toggle="collapse"
                                                                data-target="#sundayThirdTurn" data-util="add-turn"
                                                                aria-expanded="false" aria-controls="sundayThirdTurn"><i
                                                                    class="fa"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse turn" id="sundayThirdTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="sundayThirdTurnFrom"
                                                               name="sundayThirdTurnFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="sundayThirdTurnTo"
                                                               name="sundayThirdTurnTo">
                                                    </div>
                                                    <div class="input-group col-1">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="collapse day" id="monday" data-parent="#schedule">
                                    <div id="mondaySchedule">
                                        <form id="mondaySchedule-form">
                                            <div class="collapse show" id="mondayTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="mondayFrom" name="mondayFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="mondayTo" name="mondayTo">
                                                    </div>
                                                    <div class="col-1">
                                                        <button class="btn btn-info" type="button" data-toggle="collapse"
                                                                data-target="#mondaySecondTurn" data-util="add-turn"
                                                                aria-expanded="false" aria-controls="mondaySecondTurn"><i
                                                                    class="fa"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse turn" id="mondaySecondTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="mondaySecondTurnFrom"
                                                               name="mondaySecondTurnFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="mondaySecondTurnTo"
                                                               name="mondaySecondTurnTo">
                                                    </div>
                                                    <div class="col-1">
                                                        <button class="btn btn-info" type="button" data-toggle="collapse"
                                                                data-target="#mondayThirdTurn" data-util="add-turn"
                                                                aria-expanded="false" aria-controls="mondayThirdTurn"><i
                                                                    class="fa"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse turn" id="mondayThirdTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="mondayThirdTurnFrom"
                                                               name="mondayThirdTurnFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="mondayThirdTurnTo"
                                                               name="mondayThirdTurnTo">
                                                    </div>
                                                    <div class="input-group col-1">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="collapse day" id="tuesday" data-parent="#schedule">
                                    <div id="tuesdaySchedule">
                                        <form id="tuesdaySchedule-form">
                                            <div class="collapse show" id="tuesdayTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="tuesdayFrom" name="tuesdayFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="tuesdayTo" name="tuesdayTo">
                                                    </div>
                                                    <div class="col-1">
                                                        <button class="btn btn-info" type="button" data-toggle="collapse"
                                                                data-target="#tuesdaySecondTurn" data-util="add-turn"
                                                                aria-expanded="false" aria-controls="tuesdaySecondTurn"><i
                                                                    class="fa"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse turn" id="tuesdaySecondTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="tuesdaySecondTurnFrom"
                                                               name="tuesdaySecondTurnFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="tuesdaySecondTurnTo"
                                                               name="tuesdaySecondTurnTo">
                                                    </div>
                                                    <div class="col-1">
                                                        <button class="btn btn-info" type="button" data-toggle="collapse"
                                                                data-target="#tuesdayThirdTurn" data-util="add-turn"
                                                                aria-expanded="false" aria-controls="tuesdayThirdTurn"><i
                                                                    class="fa"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse turn" id="tuesdayThirdTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="tuesdayThirdTurnFrom"
                                                               name="tuesdayThirdTurnFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="tuesdayThirdTurnTo"
                                                               name="tuesdayThirdTurnTo">
                                                    </div>
                                                    <div class="input-group col-1">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="collapse day" id="wednesday" data-parent="#schedule">
                                    <div id="wednesdaySchedule">
                                        <form id="wednesdaySchedule-form">
                                            <div class="collapse show" id="wednesdayTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="wednesdayFrom" name="wednesdayFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="wednesdayTo" name="wednesdayTo">
                                                    </div>
                                                    <div class="col-1">
                                                        <button class="btn btn-info" type="button" data-toggle="collapse"
                                                                data-target="#wednesdaySecondTurn" data-util="add-turn"
                                                                aria-expanded="false" aria-controls="wednesdaySecondTurn"><i
                                                                    class="fa"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse turn" id="wednesdaySecondTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="wednesdaySecondTurnFrom"
                                                               name="wednesdaySecondTurnFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="wednesdaySecondTurnTo"
                                                               name="wednesdaySecondTurnTo">
                                                    </div>
                                                    <div class="col-1">
                                                        <button class="btn btn-info" type="button" data-toggle="collapse"
                                                                data-target="#wednesdayThirdTurn" data-util="add-turn"
                                                                aria-expanded="false" aria-controls="wednesdayThirdTurn"><i
                                                                    class="fa"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse turn" id="wednesdayThirdTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="wednesdayThirdTurnFrom"
                                                               name="wednesdayThirdTurnFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="wednesdayThirdTurnTo"
                                                               name="wednesdayThirdTurnTo">
                                                    </div>
                                                    <div class="input-group col-1">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="collapse day" id="thursday" data-parent="#schedule">
                                    <div id="thursdaySchedule">
                                        <form id="thursdaySchedule-form">
                                            <div class="collapse show" id="thursdayTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="thursdayFrom" name="thursdayFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="thursdayTo" name="thursdayTo">
                                                    </div>
                                                    <div class="col-1">
                                                        <button class="btn btn-info" type="button" data-toggle="collapse"
                                                                data-target="#thursdaySecondTurn" data-util="add-turn"
                                                                aria-expanded="false" aria-controls="thursdaySecondTurn"><i
                                                                    class="fa"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse turn" id="thursdaySecondTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="thursdaySecondTurnFrom"
                                                               name="thursdaySecondTurnFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="thursdaySecondTurnTo"
                                                               name="thursdaySecondTurnTo">
                                                    </div>
                                                    <div class="col-1">
                                                        <button class="btn btn-info" type="button" data-toggle="collapse"
                                                                data-target="#thursdayThirdTurn" data-util="add-turn"
                                                                aria-expanded="false" aria-controls="thursdayThirdTurn"><i
                                                                    class="fa"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse turn" id="thursdayThirdTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="thursdayThirdTurnFrom"
                                                               name="thursdayThirdTurnFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="thursdayThirdTurnTo"
                                                               name="thursdayThirdTurnTo">
                                                    </div>
                                                    <div class="input-group col-1">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="collapse day" id="friday" data-parent="#schedule">
                                    <div id="fridaySchedule">
                                        <form id="fridaySchedule-form">
                                            <div class="collapse show" id="fridayTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="fridayFrom" name="fridayFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="fridayTo" name="fridayTo">
                                                    </div>
                                                    <div class="col-1">
                                                        <button class="btn btn-info" type="button" data-toggle="collapse"
                                                                data-target="#fridaySecondTurn" data-util="add-turn"
                                                                aria-expanded="false" aria-controls="fridaySecondTurn"><i
                                                                    class="fa"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse turn" id="fridaySecondTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="fridaySecondTurnFrom"
                                                               name="fridaySecondTurnFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="fridaySecondTurnTo"
                                                               name="fridaySecondTurnTo">
                                                    </div>
                                                    <div class="col-1">
                                                        <button class="btn btn-info" type="button" data-toggle="collapse"
                                                                data-target="#fridayThirdTurn" data-util="add-turn"
                                                                aria-expanded="false" aria-controls="fridayThirdTurn"><i
                                                                    class="fa"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse turn" id="fridayThirdTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="fridayThirdTurnFrom"
                                                               name="fridayThirdTurnFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="fridayThirdTurnTo"
                                                               name="fridayThirdTurnTo">
                                                    </div>
                                                    <div class="input-group col-1">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="collapse day" id="saturday" data-parent="#schedule">
                                    <div id="saturdaySchedule">
                                        <form id="saturdaySchedule-form">
                                            <div class="collapse show" id="saturdayTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="saturdayFrom" name="saturdayFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="saturdayTo" name="saturdayTo">
                                                    </div>
                                                    <div class="col-1">
                                                        <button class="btn btn-info" type="button" data-toggle="collapse"
                                                                data-target="#saturdaySecondTurn" data-util="add-turn"
                                                                aria-expanded="false" aria-controls="saturdaySecondTurn"><i
                                                                    class="fa"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse turn" id="saturdaySecondTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="saturdaySecondTurnFrom"
                                                               name="saturdaySecondTurnFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="saturdaySecondTurnTo"
                                                               name="saturdaySecondTurnTo">
                                                    </div>
                                                    <div class="col-1">
                                                        <button class="btn btn-info" type="button" data-toggle="collapse"
                                                                data-target="#saturdayThirdTurn" data-util="add-turn"
                                                                aria-expanded="false" aria-controls="saturdayThirdTurn"><i
                                                                    class="fa"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse turn" id="saturdayThirdTurn">
                                                <div class="form-row  text-center">
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">De:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="saturdayThirdTurnFrom"
                                                               name="saturdayThirdTurnFrom">
                                                    </div>
                                                    <div class="input-group sm-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">A:</span>
                                                        </div>
                                                        <input class="form-control" type="text" id="saturdayThirdTurnTo"
                                                               name="saturdayThirdTurnTo">
                                                    </div>
                                                    <div class="input-group col-1">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-delete" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirm-label">Eliminar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="modal-btn-si">Si</button>
                    <button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>