<?php

// contollers
require_once("../../config.php");
require_once("../../controller/Card_controller.php");
require_once("../../controller/Canditates_controller.php");
require_once("../../controller/Vote_controller.php");

require_once("../../controller/admin_controller.php");
require_once("../../controller/Candidates_controller_admin.php");
require_once("../../controller/Vote_admin_controller.php");

// classes
require_once("../classes/Card.php");
require_once("../classes/Candidate.php");


use Controller\Admin_controller;

if(isset($_POST['pass'])){
    header('Content: Application/json');
    $ad = new Admin_controller($bdd);
    if($ad->check_password($_POST['pass'])){
        echo json_encode(['massage'=>'success']);
    }else{
        echo json_encode(['massage'=>'password incorect']);
    }
}

