<?php 

// contollers
require_once("../../config.php");
require_once("../../controller/Card_controller.php");
require_once("../../controller/Canditates_controller.php");
require_once("../../controller/Vote_controller.php");

// classes
require_once("../classes/Card.php");
require_once("../classes/Candidate.php");


use Controller\Card_controller;

if(isset($_POST["card_number"]) && !empty($_POST["card_number"])){
    $card_controler = new Card_controller($bdd);
    $card_controler->generate_cards((int) htmlspecialchars($_POST["card_number"]));
    echo "true";
}else{
    echo 'false   '. $_POST['card_number'];
}
