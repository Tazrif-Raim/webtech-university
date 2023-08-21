<?php
require 'db_connect.php';

function getApprovedSolutions(){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `solution` WHERE status = 'approved'";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function getSolutionTypes(){
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `solutionType`';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function getAllSectors(){
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `sector`';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function getAllRegions(){
    $conn = db_conn();
    $selectQuery = 'SELECT DISTINCT region FROM `solution`';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function fetchFilteredSolutions($selectQuery){
    $conn = db_conn();

    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function getSolutionIdBySectors($sectors){
    $conn = db_conn();
    $selectQuery = "SELECT DISTINCT id FROM `specialization` WHERE type = 'solution' AND sector IN (";
    foreach($sectors as $i=>$sector){
        $selectQuery .= "'".$sector."'";
        if($i<count($sectors)-1){
            $selectQuery .= ",";
        }
    }
    $selectQuery .= ")";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $solutionIds = array();
    foreach($rows as $row){
        $solutionIds[] = $row['id'];
    }
    return $solutionIds;
}

function getOrganizationNameByUsername($username){
    $conn = db_conn();
    $selectQuery = "SELECT organizationName FROM `solutionProvider` WHERE username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function getAllSectorsByID($solutionId){
    $conn = db_conn();
    $selectQuery = "SELECT sector FROM `specialization` WHERE type = 'solution' AND id = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $solutionId
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

?>