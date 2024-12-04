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

use Controller\Vote_controller;

header('Content: Application/json');

$vote_controler = new Vote_controller($bdd);


echo json_encode(['message' => $vote_controler->get_vote_confirm()]);
