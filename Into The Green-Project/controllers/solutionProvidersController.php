<?php
require '../models/solutionProvidersModel.php';

function askSolutionProvider($solutionProviderName){
    return getSolutionProvider($solutionProviderName);
}

function askSolutionProviderByUserName($username){
    return getSolutionProviderByUserName($username);
}

function organizationNameExist($organizationName){
    return doesOrganizationNameExist($organizationName);
}

function askInsertOrganizationName($organizationName, $username){
    InsertOrganizationName($organizationName, $username);
}

function askSolutionProviders(){
    return getSolutionProviders();
}

function tryImageUpload($filesName, $filesTmpName){
    return InsertLogo($filesName, $filesTmpName);
}
?>