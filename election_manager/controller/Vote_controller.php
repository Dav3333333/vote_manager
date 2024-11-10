<?php
namespace Controller;

use \PDO;
use Php\Classes\Card;
use Controller\Card_controller;
use Controller\Canditates_controller;

class Vote_controller 
{
    protected PDO $bdd;
    private Card_controller $card_controller;
    private bool $vote_state;
    private bool $vote_autorization;
    private Canditates_controller $canditates_controller;

    public function __construct($bdd){
        $this->bdd = $bdd;
        $this->vote_autorization = ($this->bdd->query("SELECT * FROM vote_state")->fetchAll()[0]["state"] == 1)? true : false;
        if($this->vote_autorization){
            $this->card_controller = new Card_controller($this->bdd);
            $this->vote_state = false;
            $this->canditates_controller = new Canditates_controller($this->bdd);
        }else{
            die('<div class="error"> This page is not accessible now ! ');
        }
    }
    
    /**
     * vote action (increment the vote)
     * @param \Php\Classes\Card $card
     * @param int $canditate_id
     * @return bool
     */
    public function vote(Card $card, int $canditate_id):bool{
        return $this->card_controller->vote($card, $canditate_id);
    }

    /**
     * allow the the vote session
     * @return void
     */
    public function start_vote(){
        if(!$this->vote_state){
            $this->vote_state = true;
        }
    }

    public function get_candidates():array{
        return $this->canditates_controller->get_candidates();
    }

}
