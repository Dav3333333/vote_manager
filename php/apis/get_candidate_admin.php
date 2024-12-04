<?php

// contollers
require_once("../../config.php");
require_once("../../controller/Card_controller.php");
require_once("../../controller/Canditates_controller.php");
require_once("../../controller/Candidates_controller_admin.php");
require_once("../../controller/Vote_controller.php");
require_once("../../controller/Vote_admin_controller.php");
require_once("../../controller/Admin_controller.php");

// classes
require_once("../classes/Card.php");
require_once("../classes/Candidate.php");

use Controller\Admin_controller;
use Controller\Candidates_controller_admin;

$admin = new Candidates_controller_admin($bdd);

$admin_candidate = $admin->get_candidates();

$html_view = "";

if(count($admin_candidate) > 0){
    for ($i=0; $i < count($admin_candidate); $i++) { 
        $html_view .= '
                <form class="candidate">
                    <div class="identities">
                        <div class="number">
                            <h3>Canditat N :'.$admin_candidate[$i]->get_number().'</h3>
                        </div>
                        <div class="image">
                            <img src="php/images/'.$admin_candidate[$i]->get_image().'" alt="">
                        </div>
                        <div class="name">
                            <h3>'.$admin_candidate[$i]->get_name().'</h3>
                        </div>
                    </div>
                </form>
            ';
    }
}else{
    $html_view .= "No candidates now in the system";
}


echo $html_view;
