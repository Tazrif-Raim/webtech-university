<?php
require '../models/contentRequestsModel.php';

function askAllContentRequests(){
    return getAllContentRequests();
}

function getTypeRedirectLink($type){
    if($type=="news"){
        return "adminContentRequestsnews.php";
    }
    if($type=="solution"){
        return "adminContentRequestsSolution.php";
    }
    if($type=="publication"){
        return "adminContentRequestsPublication.php";
    }
}

function askContentFromId($id){
    return getContentFromId($id);
}

function completeContentRequest($buttonName, $buttonId){
    if($buttonName=="reject"){
        deleteContentFromId($buttonId);
    }
    else if($buttonName=="revision"){
        $content = getContentFromId($buttonId);
        deleteContentFromId($buttonId);
        //space for code to send content back to person who wrote it for revision
    }
    else if($buttonName=="accept"){
        $content = getContentFromId($buttonId);
        deleteContentFromId($buttonId);
        if($content["type"]=="solution"){
            addSolution($content);
        }
        else if($content["type"]=="news"){
            addNews($content);
        }
        else if($content["type"]=="publication"){
            addPublication($content);
        }
    }
}
?>