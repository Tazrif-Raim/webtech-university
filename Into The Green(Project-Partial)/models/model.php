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

function checkLogin($username){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `user` WHERE username = ?";
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

function getAllTypes(){
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `accessType`';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function getAllSpecializations(){
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

function getAllOrganizationTypes(){
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `organizationType`';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function deleteSpecializations($username){
    $conn = db_conn();
    $selectQuery = "DELETE FROM `specialization` WHERE id = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function insertSpecialization($username, $sector){
    $conn = db_conn();
    $selectQuery = "INSERT into `specialization` (id, sector) values (:id, :sector)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':id' => $username,
            ':sector' => $sector
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function getSpecializationsByUsername($username){
    $conn = db_conn();
    $selectQuery = "SELECT sector FROM `specialization` WHERE id = ?";
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

function doesOrganizationNameExist($organizationName){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `solutionProvider` WHERE organizationName = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $organizationName
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function doesUsernameExist($user){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `user` WHERE username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $user
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function insertUser($data){
    $conn = db_conn();
    $selectQuery = "INSERT into `user` (firstName, lastName, username, password, email, access) VALUES (:firstName, :lastName, :username, :password, :email, :access)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':firstName' => $data['firstName'],
            ':lastName' => $data['lastName'],
            ':username' => $data['username'],
            ':password' => $data['password'],
            ':email' => $data['email'],
            ':access' => $data['type']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function insertSolutionProvider($data){
    $conn = db_conn();
    $selectQuery = "INSERT into `solutionProvider` (username) values (:username)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':username' => $data['username']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function getAllSolutionProviders(){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `solutionProvider`";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function deleteSolutionById($username){
    $conn = db_conn();
    $selectQuery = "DELETE FROM `solution` WHERE username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function deleteSolutionProvider($username){
    DeleteSpecializations($username);
    deleteSolutionById($username);
    $conn = db_conn();
    $selectQuery = "DELETE FROM `solutionProvider` WHERE username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function deleteUser($username){
    $conn = db_conn();
    $selectQuery = "DELETE FROM `user` WHERE username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function getSolutionProvider($username){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `solutionProvider` WHERE username = ?";
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

function getName($username){
    $conn = db_conn();
    $selectQuery = "SELECT firstName, lastName, email FROM `user` WHERE username = ?";
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

function searchPasswordByUsername($username){
    $conn = db_conn();
    $selectQuery = "SELECT password FROM `user` WHERE username = ?";
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
function updatePassword($username, $password){
    $conn = db_conn();
    $selectQuery = "UPDATE `user` set password = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $password, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function updateFirstName($username, $firstName){
    $conn = db_conn();
    $selectQuery = "UPDATE `user` set firstName = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $firstName, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function updateLastName($username, $lastName){
    $conn = db_conn();
    $selectQuery = "UPDATE `user` set lastName = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $lastName, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function updateOrganizationName($username, $organizationName){
    $conn = db_conn();
    $selectQuery = "UPDATE `solutionProvider` set organizationName = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $organizationName, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function updateOrganizationType($username, $organizationType){
    $conn = db_conn();
    $selectQuery = "UPDATE `solutionProvider` set organizationType = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $organizationType, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function updateEmail($username, $email){
    $conn = db_conn();
    $selectQuery = "UPDATE `user` set email = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $email, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function updateShortAbout($username, $shortAbout){
    $conn = db_conn();
    $selectQuery = "UPDATE `solutionProvider` set shortAbout = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $shortAbout, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function updateFounded($username, $founded){
    $conn = db_conn();
    $selectQuery = "UPDATE `solutionProvider` set founded = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $founded, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function updateEmployees($username, $employees){
    $conn = db_conn();
    $selectQuery = "UPDATE `solutionProvider` set employees = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $employees, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function updateHq($username, $hq){
    $conn = db_conn();
    $selectQuery = "UPDATE `solutionProvider` set hq = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $hq, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function updateStory($username, $story){
    $conn = db_conn();
    $selectQuery = "UPDATE `solutionProvider` set story = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $story, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function updateWebsite($username, $website){
    $conn = db_conn();
    $selectQuery = "UPDATE `solutionProvider` set website = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $website, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function updateAddress($username, $address){
    $conn = db_conn();
    $selectQuery = "UPDATE `solutionProvider` set address = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $address, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function updateMapsLink($username, $mapsLink){
    $conn = db_conn();
    $selectQuery = "UPDATE `solutionProvider` set mapsLink = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $mapsLink, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function updateContactName($username, $contactName){
    $conn = db_conn();
    $selectQuery = "UPDATE `solutionProvider` set contactName = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $contactName, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function updateContactEmail($username, $contactEmail){
    $conn = db_conn();
    $selectQuery = "UPDATE `solutionProvider` set contactEmail = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $contactEmail, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function doesOrganizationTypeExist($organizationType){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `organizationType` WHERE name = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $organizationType
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function uploadAboutMedia($username, $targetFile){
    $conn = db_conn();
    $selectQuery = "UPDATE `solutionProvider` set aboutMedia = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $targetFile, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function uploadLogo($username, $targetFile){
    $conn = db_conn();
    $selectQuery = "UPDATE `solutionProvider` set logo = ? where username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $targetFile, 
            $username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

/*function getApprovedSolutions(){
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
}*/

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