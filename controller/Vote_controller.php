<?php
namespace Controller;

use \PDO;
use Php\Classes\Card;
use Controller\Card_controller;
use Controller\Canditates_controller;

class Vote_controller 
{
    protected PDO $bdd;
    protected Card_controller $card_controller;
    /**
     * return true if the vote id being doing else false
     * @var bool
     */
    protected bool $vote_state;
    protected bool $vote_autorization;
    protected Canditates_controller $canditates_controller;

    public function __construct($bdd){
        $this->bdd = $bdd;
        // $this->vote_autorization = ($this->bdd->query("SELECT * FROM vote_register")->fetchAll()[0]["autorization"] == 1)? true : false;
        $this->vote_autorization = true;
        if($this->vote_autorization){
            $this->card_controller = new Card_controller($this->bdd);
            $this->vote_state = ($this->bdd->query("SELECT * FROM vote_state")->fetchAll()[0]["state"] == 1)? true : false;
            $this->canditates_controller = new Canditates_controller($this->bdd);
        }else{
            header("Content: Application/json");
            die(json_encode(['error' => 'Vote is not accessible now : Contact the admin', 'admin'=>"problem"]));
        }
    }

    public function get_vote_confirm():bool{
        return ($this->vote_autorization && $this->vote_state)? true : false; 
    }
    
    /**
     * vote action (increment the vote)
     * @param \Php\Classes\Card $card
     * @param int $canditate_id
     * @return bool
     */
    public function vote(Card $card, int $canditate_id):bool{
        return ($this->get_vote_confirm()) ? 
        $this->card_controller->vote($card, $canditate_id) :false;

    }

    public function get_candidates():array{
        return $this->canditates_controller->get_candidates();
    }

}
