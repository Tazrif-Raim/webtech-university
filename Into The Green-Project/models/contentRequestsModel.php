<?php
function getAllContentRequests(){
    $data = file_get_contents("../data/contentRequests.json");
    $data = json_decode($data, true);
    return $data;
}

function getContentFromId($id){
    $data = file_get_contents("../data/contentRequests.json");
    $data = json_decode($data, true);
    if(isset($data)){
        foreach($data as $content){
            if($content["id"]==$id){
                return $content;
            }
        }
    }
}

function deleteContentFromId($id){
    $data = file_get_contents("../data/contentRequests.json");
    $data = json_decode($data, true);
    if(isset($data)){
        foreach($data as $content){
            if($content["id"]==$id){
                $index = array_search($content, $data);
                unset($data[$index]);
                $data = json_encode($data);
                file_put_contents("../data/contentRequests.json", $data);
                return true;
            }
        }
    }
    return false;
}
$solutionCountId = 0;
function addSolution($solution){
    if(file_exists('../data/solutions.json'))  
    {  
        $current_data = file_get_contents('../data/solutions.json');  
        $array_data = json_decode($current_data, true);  
        $new_data = array(  
            'solutionId' =>    $solutionCountId,
            'type' =>    $solution['type'],
            'solutionType'     =>     $solution['solutionType'],  
            'sectors' =>    $solution['sectors'],
            'country' =>    $solution['country'],
            'city' =>    $solution['city'],
            'title' =>    $solution['title'],
            'date' =>    $solution['date'],
            'media' =>    $solution['media'],
            'solutionProviderName' =>    $solution['solutionProviderName'],
            'challenge' =>    $solution['challenge'],
            'solution' =>    $solution['solution'],
            'result' =>    $solution['result']
        );
        $solutionCountId++; 
        $array_data[] = $new_data;  
        $final_data = json_encode($array_data);
        file_put_contents('../data/solutions.json', $final_data); 
    } 
}
?>