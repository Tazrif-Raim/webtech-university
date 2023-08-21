<?php
require '../models/model.php';

$solutions = getApprovedSolutions();
$solutionTypes = getSolutionTypes();
$sectors = getAllSectors();
$regions = getAllRegions();

$req = "";
//var_dump(json_encode($solutionTypes));

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['username'])){
        echo json_encode(getOrganizationNameByUsername($_POST['username']));
    }
    if(isset($_POST['solutionId'])){
        echo json_encode(getAllSectorsByID($_POST['solutionId']));
    }
}

if(isset($_GET['req'])){
    $req = $_REQUEST['req'];
    
    if($req == 'allSolutions'){
        echo json_encode($solutionTypes);
    }
    
    if($req == 'allSectors'){
        echo json_encode($sectors);
    }
    
    if($req == 'allRegions'){
        echo json_encode($regions);
    }
    
    if(strpos($req, "(%)") !== false){
        $parts = explode("(%)", $req);
        if(count($parts)==5){
            $solTypes = json_decode($parts[0], true);
            $sec = json_decode($parts[1], true);
            $reg = json_decode($parts[2], true);
            $sor = json_decode($parts[3], true);
            $page = $parts[4];
            $a=null;
            $b=null;
            $c=null;
            $d=null;
            foreach($solTypes as $i=>$solType){
                $a[] = $solType;
            }
            //var_dump($a);
            foreach($sec as $i=>$se){
                $b[] = $se;
            }
            if($b!=null){
                $b = getSolutionIdBySectors($b);
            }
            foreach($reg as $i=>$re){
                $c[] = $re;
            }
            foreach($sor as $i=>$so){
                $d[] = $so;
            }
            $solutions = getFilteredSolutions($a, $b, $c, $d, $page); 
            echo json_encode($solutions);
        } else {
            echo json_encode($solutions);
        } 
    }
}



function getFilteredSolutions($solutionType, $sector, $region, $sort, $page){
    $selectQuery = "SELECT * FROM `solution` WHERE status = 'approved'";
    if(isset($solutionType) && count($solutionType)>0){
        $selectQuery .= " AND solutionType IN (";
        foreach($solutionType as $i=>$solType){
            $selectQuery .= "'".$solType."'";
            if($i<count($solutionType)-1){
                $selectQuery .= ", ";
            }
        }
        $selectQuery .= ")";
    }
    if(isset($sector) && count($sector)>0){
        $selectQuery .= " AND solutionID IN (";
        foreach($sector as $i=>$sec){
            $selectQuery .= "'".$sec."'";
            if($i<count($sector)-1){
                $selectQuery .= ", ";
            }
        }
        $selectQuery .= ")";
    }
    if(isset($region) && count($region)>0){
        $selectQuery .= " AND region IN (";
        foreach($region as $i=>$reg){
            $selectQuery .= "'".$reg."'";
            if($i<count($region)-1){
                $selectQuery .= ", ";
            }
        }
        $selectQuery .= ")";
    }
    if(isset($sort) && count($sort)==1){
        $selectQuery .= " ORDER BY publicationDate ";
        foreach($sort as $i=>$sor){
            if($sor == "newest"){
                $selectQuery .= "DESC";
            }
            else{
                $selectQuery .= "ASC";
            }
        }
    }
    if(isset($page)){
        $selectQuery .= " LIMIT ".(($page-1)*4).", 4";
    }
    //var_dump($selectQuery);
    return fetchFilteredSolutions($selectQuery);
}

?>