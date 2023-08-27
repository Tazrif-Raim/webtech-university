<?php
require '../models/model.php';
require 'newSolutionController.php';
function getAllPublishedSolutions(){
    return getApprovedSolutions();
}

function getAllPendingSolutions(){
    return getPendingSolutions();
}

function askSpecializations($data){
    $data = getSpecializations($data);
    $specializations = array();
    foreach($data as $d){
        array_push($specializations, $d['sector']);
    }
    return $specializations;
}

function askSolutionProviderName($username){
    return getSolutionProviderName($username);
}

function askSolutionDetailsById($solutionID){
    return getPublishedSolutionById($solutionID);
}
function askSolutionById($solutionID){
    return getSolutionById($solutionID);
}

function getAllPublishedSolutionsOfUser($username){
    return getPublishedSolutionsByUsername($username);
}

function getSolutionOfUser($username, $id){
    return getSolutionByUsernameAndId($username, $id);
}

// function adminEditButtons($solution){
//     if($solution['status']=="approved"){
//         echo "<input type='button' name='submit' value='Revision'>";
//         echo "<input type='button' name='submit' value='Delete'>";
//     }
//     else if($solution['status']=="pending"){
//         echo "<input type='button' name='submit' value='Approve'>";
//         echo "<input type='button' name='submit' value='Revision'>";
//         echo "<input type='button' name='submit' value='Reject'>";
//     }
// }

function updateStatus($solution, $status, $comment){
    if($status=="Approve"){
        $data['id'] = $solution['solutionID'];
        $data['comment'] = $comment;
        addComment($data);
        approveSolution($data);
        $data['publicationDate'] = date("Y-m-d");
        setPublicationDate($data);
    }
    else if($status=="Revision"){
        $data['id'] = $solution['solutionID'];
        $data['comment'] = $comment;
        addComment($data);
        setStatusRevision($data);
    }
    else if($status=="Reject" || $status=="Delete"){
        $data['id'] = $solution['solutionID'];
        $data['type'] = $solution['type'];
        if(isset($solution['challenge'])){
            $previmg = $solution['challenge'];
            if(file_exists($previmg)){
                unlink($previmg);
            }
        }
        if(isset($solution['solutionBody'])){
            $previmg = $solution['solutionBody'];
            if(file_exists($previmg)){
                unlink($previmg);
            }
        }
        if(isset($solution['result'])){
            $previmg = $solution['result'];
            if(file_exists($previmg)){
                unlink($previmg);
            }
        }
        if(isset($solution['media'])){
            $previmg = $solution['media'];
            if(file_exists($previmg)){
                unlink($previmg);
            }
        }
        deleteSpecialization($data);
        rejectSolution($data);
    }
}

function askSolutionsForRevision($username){
    return getSolutionsForRevision($username);
}

function solutionUpdate($data){
    $filename = $data['challengeFileName'];
    $file = fopen($filename, "w") or die("Unable to open file!");
    fwrite($file, $data["challenge"]);
    $data["challenge"] = $filename;
    fclose($file);
    $filename = $data['solutionBodyFileName'];
    $file = fopen($filename, "w") or die("Unable to open file!");
    fwrite($file, $data["solutionBody"]);
    $data["solutionBody"] = $filename;
    fclose($file);
    $filename = $data['resultFileName'];
    $file = fopen($filename, "w") or die("Unable to open file!");
    fwrite($file, $data["result"]);
    $data["result"] = $filename;
    fclose($file);

    deleteAllSpecializations($data['solutionID'], 'solution');
    foreach($data['selectedSpecializations'] as $specialization){
        $data['type'] = 'solution';
        $data['id'] = $data['solutionID'];
        $data['sector'] = $specialization;
        addSpecialization($data);
    }
    echo updateSolution($data);
    if($data['fileName']!=""){
        $solution = getSolutionById($data['solutionID']);
        if($solution['media']!=null){
            $previmg = $solution['media'];
            if(file_exists($previmg)){
                unlink($previmg);
            }
        }
        $msg = UploadFile($data['fileName'],$data['fileTmpName'], $data['solutionID']);
    }
}

function searchSolution($data){
    return searchSolutionByTitle($data);
}
?>