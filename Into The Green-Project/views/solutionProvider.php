<?php
require '../controllers/solutionProvidersController.php';
$solutionProviderName = $_GET["name"];
$solutionProvider = askSolutionProvider($solutionProviderName);
$type = $solutionProvider["type"];
$organiztionType = $solutionProvider["organizationType"];
$name = $solutionProvider["organizationName"];
$logo = $solutionProvider["logo"];
$aboutMedia = $solutionProvider["aboutMedia"];
$shortAbout = $solutionProvider["shortAbout"];
$founded = $solutionProvider["founded"];
$employees = $solutionProvider["employees"];
$hq = $solutionProvider["hq"];
$story = $solutionProvider["story"];
$specializations = $solutionProvider["specializations"];
$organizationWebsite = $solutionProvider["organizationWebsite"];
$organizationAddress = $solutionProvider["organizationAddress"];
$mapsLink = $solutionProvider["mapsLink"];
$contactName = $solutionProvider["contactName"];
$contactEmail = $solutionProvider["contactEmail"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name;?></title>
</head>
<body>
    <?php require 'navbar.php'; ?>
    <div>
        <div>
            <span>
                <?php echo $type;?> | 
            </span>
            <span>
                <?php echo $organiztionType;?>
            </span>
        </div>
        <div>
            <span>
                <h1><?php echo $name;?></h1>
            </span>
            <span>
                <img src="<?php echo $logo;?>" alt="solution provider logo" height="100" width="100">
            </span>
        </div>
        <div>
            <div>
                <img src="<?php echo $aboutMedia;?>" alt="solution provider media" height="480" width="720">
            </div>
            <div>
                <?php echo '<p>'.$shortAbout.'</p>';?>
            </div>
            <div>
                <img src="<?php echo $logo;?>" alt="solution provider logo" height="100" width="100">
            </div>
            <div>
                <div>
                    <h3>About</h3>
                    Founded: <?php echo $founded;?><br>
                    Employees: <?php echo $employees;?><br>
                    HQ: <?php echo $hq;?><br>
                    Organization Type: <?php echo $organiztionType;?><br>
                    specializations: <br>
                    <?php
                        if($specializations!=null){
                            foreach($specializations as $specialization){
                                echo $specialization."<br>";
                            }
                        }
                    ?>
                </div>
                <hr>
                <div>
                    <?php echo $story;?>
                </div>
                <hr>
                <div>
                    <div>
                        <?php echo $organiztionType;?><br>
                        <?php echo $name;?><br>
                        <a href="<?php echo $organizationWebsite;?>" target="_blank" rel="noopener noreferrer">Website</a>
                    </div>
                    <div>
                        Address<br>
                        <?php echo $organizationAddress;?><br>
                        <a href="<?php echo $mapsLink;?>" target="_blank" rel="noopener noreferrer">Locate on Maps</a>
                    </div>
                    <div>
                        Contact
                        <?php echo $contactName;?><br>
                        <a href="mailto:<?php echo $contactEmail;?>" target="_blank" rel="noopener noreferrer"><?php echo $contactEmail;?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>