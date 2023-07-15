<?php
require '../models/solutionProvidersModel.php';

function askSolutionProvider($solutionProviderName){
    return getSolutionProvider($solutionProviderName);
}

function askSolutionProviders(){
    return getSolutionProviders();
}
?>