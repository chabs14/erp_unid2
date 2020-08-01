<?php

namespace Api\DataAccess;

use Api\Connectors\DatabaseConnector;
use PDO;
use PDOException;

class WorkPositionDataAccess
{

    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = (new DatabaseConnector())->connection();
    }

    public function selectAll()
    {
        try {
            $stmt = $this->dbConnection->query(
        'SELECT pus.id AS id
                ,positionName
                ,positionDepartment
                ,dep.name AS departmentName
                ,positionIsSupervisor
                ,hor.id AS scheduleId
                ,sundayFrom
                ,sundayTo
                ,sundaySecondTurnFrom
                ,sundaySecondTurnTo
                ,sundayThirdTurnFrom
                ,sundayThirdTurnTo
                ,mondayFrom
                ,mondayTo
                ,mondaySecondTurnFrom
                ,mondaySecondTurnTo
                ,mondayThirdTurnFrom
                ,mondayThirdTurnTo
                ,tuesdayFrom
                ,tuesdayTo
                ,tuesdaySecondTurnFrom
                ,tuesdaySecondTurnTo
                ,tuesdayThirdTurnFrom
                ,tuesdayThirdTurnTo
                ,wednesdayFrom
                ,wednesdayTo
                ,wednesdaySecondTurnFrom
                ,wednesdaySecondTurnTo
                ,wednesdayThirdTurnFrom
                ,wednesdayThirdTurnTo
                ,thursdayFrom
                ,thursdayTo
                ,thursdaySecondTurnFrom
                ,thursdaySecondTurnTo
                ,thursdayThirdTurnFrom
                ,thursdayThirdTurnTo
                ,fridayFrom
                ,fridayTo
                ,fridaySecondTurnFrom
                ,fridaySecondTurnTo
                ,fridayThirdTurnFrom
                ,fridayThirdTurnTo
                ,saturdayFrom
                ,saturdayTo
                ,saturdaySecondTurnFrom
                ,saturdaySecondTurnTo
                ,saturdayThirdTurnFrom
                ,saturdayThirdTurnTo
            FROM puestos_empleados_rh pus
            JOIN departamentos_rh dep ON pus.positionDepartment = dep.id
            LEFT JOIN horarios_puestos_rh hor ON hor.positionId = pus.id
            ORDER BY positionName'
            );
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function select($id)
    {
        $stmt = $this->dbConnection->prepare(
  'SELECT pus.id AS id
            ,positionName
            ,positionDepartment
            ,dep.name AS departmentName
            ,positionIsSupervisor
            ,hor.id AS scheduleId
            ,sundayFrom
            ,sundayTo
            ,sundaySecondTurnFrom
            ,sundaySecondTurnTo
            ,sundayThirdTurnFrom
            ,sundayThirdTurnTo
            ,mondayFrom
            ,mondayTo
            ,mondaySecondTurnFrom
            ,mondaySecondTurnTo
            ,mondayThirdTurnFrom
            ,mondayThirdTurnTo
            ,tuesdayFrom
            ,tuesdayTo
            ,tuesdaySecondTurnFrom
            ,tuesdaySecondTurnTo
            ,tuesdayThirdTurnFrom
            ,tuesdayThirdTurnTo
            ,wednesdayFrom
            ,wednesdayTo
            ,wednesdaySecondTurnFrom
            ,wednesdaySecondTurnTo
            ,wednesdayThirdTurnFrom
            ,wednesdayThirdTurnTo
            ,thursdayFrom
            ,thursdayTo
            ,thursdaySecondTurnFrom
            ,thursdaySecondTurnTo
            ,thursdayThirdTurnFrom
            ,thursdayThirdTurnTo
            ,fridayFrom
            ,fridayTo
            ,fridaySecondTurnFrom
            ,fridaySecondTurnTo
            ,fridayThirdTurnFrom
            ,fridayThirdTurnTo
            ,saturdayFrom
            ,saturdayTo
            ,saturdaySecondTurnFrom
            ,saturdaySecondTurnTo
            ,saturdayThirdTurnFrom
            ,saturdayThirdTurnTo
        FROM puestos_empleados_rh pus
        JOIN departamentos_rh dep ON pus.positionDepartment = dep.id
        LEFT JOIN horarios_puestos_rh hor ON hor.positionId = pus.id
        WHERE pus.id = ?
        ORDER BY positionName'
        );
        try {
            $stmt->execute(array($id));
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function selectByDepartment($department)
    {
        $stmt = $this->dbConnection->prepare('SELECT pus.id AS id, positionName, positionDepartment, dep.name AS departmentName, positionIsSupervisor FROM puestos_empleados_rh pus JOIN departamentos_rh dep ON pus.positionDepartment = dep.id WHERE dep.id = ?');
        try {
            $stmt->execute(array($department));
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function selectSupervisorsByDepartment($department)
    {
        $stmt = $this->dbConnection->prepare('SELECT pus.id AS id, positionName, positionDepartment, dep.name AS departmentName, positionIsSupervisor FROM puestos_empleados_rh pus JOIN departamentos_rh dep ON pus.positionDepartment = dep.id WHERE dep.id = ? AND positionIsSupervisor = 1');
        try {
            $stmt->execute(array($department));
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insert($data)
    {
        $values = json_decode($data, true);
        $array = Array();
        foreach ($values['positionSchedule'] as $value){
            $array = array_merge($array, $value);
        }
        unset($values['positionSchedule']);
        $stmt = $this->dbConnection->prepare('INSERT INTO puestos_empleados_rh (positionName, positionDepartment, positionIsSupervisor) VALUES (:positionName, :positionDepartment, :positionIsSupervisor)');
        try {
            $stmt->execute(array_map('trim', $values));
            $success = $stmt->rowCount();
            $id = $this->dbConnection->lastInsertId();
            $array['positionId'] = $id;
            $params = array('sundayFrom','sundayTo','sundaySecondTurnFrom','sundaySecondTurnTo','sundayThirdTurnFrom','sundayThirdTurnTo','mondayFrom','mondayTo','mondaySecondTurnFrom','mondaySecondTurnTo','mondayThirdTurnFrom','mondayThirdTurnTo','tuesdayFrom','tuesdayTo','tuesdaySecondTurnFrom','tuesdaySecondTurnTo','tuesdayThirdTurnFrom','tuesdayThirdTurnTo','wednesdayFrom','wednesdayTo','wednesdaySecondTurnFrom','wednesdaySecondTurnTo','wednesdayThirdTurnFrom','wednesdayThirdTurnTo','thursdayFrom','thursdayTo','thursdaySecondTurnFrom','thursdaySecondTurnTo','thursdayThirdTurnFrom','thursdayThirdTurnTo','fridayFrom','fridayTo','fridaySecondTurnFrom','fridaySecondTurnTo','fridayThirdTurnFrom','fridayThirdTurnTo','saturdayFrom','saturdayTo','saturdaySecondTurnFrom','saturdaySecondTurnTo','saturdayThirdTurnFrom','saturdayThirdTurnTo','positionId');
            $queryValues  = array();
            foreach ($params as $param){
                $queryValues[":$param"] =  isset($array[$param]) ? $array[$param] : '00:00';
            }
            $valuesString = implode(", ",array_keys($queryValues));
            $query = 'INSERT INTO horarios_puestos_rh (sundayFrom, sundayTo, sundaySecondTurnFrom, sundaySecondTurnTo, sundayThirdTurnFrom, sundayThirdTurnTo, mondayFrom, mondayTo, mondaySecondTurnFrom, mondaySecondTurnTo, mondayThirdTurnFrom, mondayThirdTurnTo, tuesdayFrom, tuesdayTo, tuesdaySecondTurnFrom, tuesdaySecondTurnTo, tuesdayThirdTurnFrom, tuesdayThirdTurnTo, wednesdayFrom, wednesdayTo, wednesdaySecondTurnFrom, wednesdaySecondTurnTo, wednesdayThirdTurnFrom, wednesdayThirdTurnTo, thursdayFrom, thursdayTo, thursdaySecondTurnFrom, thursdaySecondTurnTo, thursdayThirdTurnFrom, thursdayThirdTurnTo, fridayFrom, fridayTo, fridaySecondTurnFrom, fridaySecondTurnTo, fridayThirdTurnFrom, fridayThirdTurnTo, saturdayFrom, saturdayTo, saturdaySecondTurnFrom, saturdaySecondTurnTo, saturdayThirdTurnFrom, saturdayThirdTurnTo, positionId) VALUES ('.$valuesString.')';
            $stmt = $this->dbConnection->prepare($query);
            $stmt->execute($queryValues);
            $success += $stmt->rowCount();
            return $success;
        } catch (PDOException $e) {
            exit($e->getMessage());
        }

    }

    public function update($id, $data)
    {
        $values = json_decode($data, true);
        $values['id'] = $id;
        $array = Array();
        foreach ($values['positionSchedule'] as $value){
            $array = array_merge($array, $value);
        }
        unset($values['positionSchedule']);
        $stmt = $this->dbConnection->prepare('UPDATE puestos_empleados_rh SET positionName = :positionName, positionDepartment = :positionDepartment, positionIsSupervisor = :positionIsSupervisor WHERE id = :id');
        try {
            $stmt->execute(array_map('trim', $values));
            $success = $stmt->rowCount();
            $params = array('sundayFrom','sundayTo','sundaySecondTurnFrom','sundaySecondTurnTo','sundayThirdTurnFrom','sundayThirdTurnTo','mondayFrom','mondayTo','mondaySecondTurnFrom','mondaySecondTurnTo','mondayThirdTurnFrom','mondayThirdTurnTo','tuesdayFrom','tuesdayTo','tuesdaySecondTurnFrom','tuesdaySecondTurnTo','tuesdayThirdTurnFrom','tuesdayThirdTurnTo','wednesdayFrom','wednesdayTo','wednesdaySecondTurnFrom','wednesdaySecondTurnTo','wednesdayThirdTurnFrom','wednesdayThirdTurnTo','thursdayFrom','thursdayTo','thursdaySecondTurnFrom','thursdaySecondTurnTo','thursdayThirdTurnFrom','thursdayThirdTurnTo','fridayFrom','fridayTo','fridaySecondTurnFrom','fridaySecondTurnTo','fridayThirdTurnFrom','fridayThirdTurnTo','saturdayFrom','saturdayTo','saturdaySecondTurnFrom','saturdaySecondTurnTo','saturdayThirdTurnFrom','saturdayThirdTurnTo');
            $queryValues  = array();
            foreach ($params as $param){
                $queryValues["$param"] =  isset($array[$param]) ? $param." = '".trim($array[$param])."'" : NULL;
            }
            $valuesString = implode(',',$queryValues);
            $query = "UPDATE horarios_puestos_rh SET ".rtrim($valuesString, ',')." WHERE positionId = ?";
            $stmt = $this->dbConnection->prepare($query);
            $stmt->execute(array($id));
            $success += $stmt->rowCount();
            return $success;
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function delete($id)
    {
        $stmt = $this->dbConnection->prepare('DELETE FROM puestos_empleados_rh WHERE id = ?');
        try {
            $stmt->execute(array($id));
            $stmt = $this->dbConnection->prepare('DELETE FROM horarios_puestos_rh WHERE positionId = ?');
            $stmt->execute(array($id));
            return $stmt->rowCount();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

}
