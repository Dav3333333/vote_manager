<?php 

// contollers
require_once("../../config.php");
require_once("../../controller/Card_controller.php");
require_once("../../controller/Canditates_controller.php");
require_once("../../controller/Vote_controller.php");

// classes
require_once("../classes/Card.php");
require_once("../classes/Candidate.php");

use Controller\Vote_controller;

$vote_controler = new Vote_controller($bdd);
$candidates = $vote_controler->get_candidates();

$html = '';

if(count($candidates) > 0){
    for ($i = 0; $i < count($candidates); $i++) { 
        $html .= '
            <form action="#" class="candidate">
                <div class="identities">
                    <div class="number">
                        <h3>Canditat N :'.$candidates[$i]->get_number().'</h3>
                    </div>
                    <div class="image">
                        <img src="php/images/'.$candidates[$i]->get_image().'" alt="">
                    </div>
                    <div class="name">
                        <h3>'.$candidates[$i]->get_name().'</h3>
                    </div>
                </div>
            </form>
        ';
    }
}


echo $html;
