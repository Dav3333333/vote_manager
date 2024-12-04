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
    private $vote_admin_controller = null;

    public function __construct($bdd){
        $this->bdd = $bdd;
        if($this->vote_admin_controller === null){
            $this->vote_admin_controller = new Vote_admin_controller($this->bdd);
        }
    }

    public function get_candidates_controller_admin():Candidates_controller_admin{
        return new Candidates_controller_admin($this->bdd);
    }

    public function get_vote_admin_controller():Vote_admin_controller{
        return new Vote_admin_controller($this->bdd);
    }

    public function get_card_controller():Card_controller{
        return new Card_controller($this->bdd);
    }

    /**
     * check modalities, password admin and confirme the vote to start
     * @param string $password
     * @return void
     */
    public function check_password(String $password):bool{
        if($this->bdd->query("SELECT * FROM password WHERE service = 'admin' ")
                ->fetch(PDO::FETCH_ASSOC)['value'] === htmlspecialchars($password)){
                $this->vote_admin_controller->start_vote();
                $this->vote_admin_controller->vote_autorize(1);
            return true;
        }else{
            return false;
        }
    }  
}


