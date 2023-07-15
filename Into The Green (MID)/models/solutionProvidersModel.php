<?php
function getSolutionProvider($solutionProviderName){
    $data = file_get_contents("../data/solutionProviders.json");
    $data = json_decode($data, true);
    if(isset($data)){
        foreach($data as $solutionProvider){
            if($solutionProvider["organizationName"]==$solutionProviderName){
                return $solutionProvider;
            }
        }
    }
}

function getSolutionProviders(){
    $data = file_get_contents("../data/solutionProviders.json");
    $data = json_decode($data, true);
    return $data;
}
?>