<?php
require 'db_connect.php';

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
?>