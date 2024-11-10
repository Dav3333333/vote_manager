<?php
namespace Controller;

// php controller 
use Controller\Candidates_controller_admin;
use Controller\Vote_admin_controller;
use Controller\Card_controller;

// php classes
use Php\Classes\Card;
use Php\Classes\Candidate;
use PDO;


class Admin_controller 
{
    private PDO $bdd;
    private Candidates_controller_admin $candidates_controller_admin;

    private Vote_admin_controller $vote_admin_controller;

    private Card_controller $card_controller;

    public function __construct($bdd){
        $this->bdd = $bdd;
        $this->candidates_controller_admin = new Candidates_controller_admin($this->bdd);
        $this->vote_admin_controller = new Vote_admin_controller($this->bdd);
        $this->card_controller = new Card_controller($bdd);
    }

    public function get_candidates_controller_admin():Candidates_controller_admin{
        return $this->candidates_controller_admin;
    }

    public function get_vote_admin_controller():Vote_admin_controller{
        return $this->vote_admin_controller;
    }

    public function get_card_controller():Card_controller{
        return $this->card_controller;
    }
    
}


