<?php
require_once 'db_connect.php';

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

function getSolution(){
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `solution`';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function getSpecializations($data){
    $conn=db_conn();
    $selectQuery = "SELECT sector FROM `specialization` WHERE type = ? AND id = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['type'],
            $data['solutionID']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function getSolutionProviderName($username){
    $conn = db_conn();
    $selectQuery = "SELECT organizationName FROM `solutionProvider` WHERE username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$username]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['organizationName'];
}

function addSpecialization($data){
    $conn = db_conn();
    $selectQuery = "INSERT into specialization (type, id, sector) values (:type, :id, :sector)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':type' => $data['type'],
            ':id' => $data['id'],
            ':sector' => $data['sector']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}

function addSolution($data){
    $conn = db_conn();
    $selectQuery = "INSERT into `solution` (solutionID, username, type, solutionType, region, title, submissionDate/*, media*/, challenge, solutionBody, result, status) VALUES (:solutionID, :username, :type, :solutionType, :region, :title, :submissionDate, /*:media,*/ :challenge, :solutionBody, :result, :status)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':solutionID' => $data['solutionID'], 
            ':username' => $data['username'],
            ':type' => "solution",
            ':solutionType' => $data['solutionType'],
            ':region' => $data['region'],
            ':title' => $data['title'],
            ':submissionDate' => $data['submissionDate'],
            //':media' => $data['media'],
            ':challenge' => $data['challenge'],
            ':solutionBody' => $data['solutionBody'],
            ':result' => $data['result'],
            ':status' => "pending"
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}

function getPendingSolutions(){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `solution` WHERE status = 'pending'";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

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

function getSolutionById($id){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `solution` WHERE solutionID = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function approveSolution($data){
    $conn = db_conn();
    $selectQuery = "UPDATE `solution` set status = 'approved' where solutionID = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['id']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}

function setPublicationDate($data){
    $conn = db_conn();
    $selectQuery = "UPDATE `solution` set publicationDate = ? where solutionID = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['publicationDate'],
            $data['id']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}

function rejectSolution($data){
    $conn = db_conn();
    $selectQuery = "DELETE FROM `solution`  where SolutionID = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['id']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}

function deleteSpecialization($data){
    $conn = db_conn();
    $selectQuery = "DELETE FROM `specialization`  where id = ? and type = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['id'],
            $data['type']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}

function getPublishedSolutionById($id){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `solution` WHERE solutionID = ? and status = 'approved'";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $id
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
}

function getPublishedSolutionsByUsername($username){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `solution` WHERE status = 'approved' and username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function getSolutionsForRevision($username){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `solution` WHERE status = 'revision' and username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function getSolutionByUsernameAndId($username, $id){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `solution` WHERE username = ? and solutionID = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $username,
            $id
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
}

function addComment($data){
    $conn = db_conn();
    $selectQuery = "UPDATE `solution` set comment = ? where solutionID = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['comment'],
            $data['id']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}

function setStatusRevision($data){
    $conn = db_conn();
    $selectQuery = "UPDATE `solution` set status = 'revision' where SolutionID = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['id']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}

function uploadImage($target_file, $solutionID){
    $conn = db_conn();
    $selectQuery = "UPDATE `solution` set media = ? where solutionID = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $target_file,
            $solutionID
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}

function deleteAllSpecializations($id, $type){
    $conn = db_conn();
    $selectQuery = "DELETE FROM `specialization`  where id = ? and type = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $id,
            $type
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}

function updateSolution($data){
    $conn = db_conn();
    $selectQuery = "UPDATE `solution` set solutionType = ?, region = ?, title = ?, challenge = ?, solutionBody = ?, result = ?, submissionDate = ?, status = 'pending' where solutionID = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['solutionType'],
            $data['region'],
            $data['title'],
            $data['challenge'],
            $data['solutionBody'],
            $data['result'],
            $data['submissionDate'],
            $data['solutionID']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}

function searchSolutionByTitle($title){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `solution` WHERE title LIKE '%$title%' and status = 'approved'";
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
?>