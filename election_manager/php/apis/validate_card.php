<?php
require_once("../../controller/Card_controller.php");
require_once("../../config.php");
require_once("../classes/Card.php");

use Controller\Card_controller;
use Php\Classes\Card;

if(isset($_POST["card"])){
    $card_controler = new Card_controller($bdd);
    $card_Code = htmlspecialchars($_POST['card']);
    if(strlen($card_Code) === 10){
        if($card_controler->checkCard($card_Code)){
            if(!$card_controler->get_State_card($card_Code)){
                echo "valid";
            }else{
                echo 'This card ('.$card_Code.') is all ready used  --'.$card_controler->get_State_card($card_Code);
            }
        }else{
            echo "invalid Card";
        }
    }else{
        echo "your code lenght is not good";
    }
}
