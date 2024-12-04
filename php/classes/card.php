<?php

namespace Php\Classes;

use PDO;

class Card 
{
    private string $code_card;
    private bool|null $state;
    private PDO $bdd;

    public function __construct(string $code_card,PDO $bdd){
        $this->code_card = $code_card;
        $this->bdd = $bdd;
        $this->loadStates();
    }

    private function loadStates():void{
        $q = $this->bdd->prepare("SELECT * FROM card WHERE id_unique = ?");
        $q->execute(array($this->code_card));
        $response = $q->fetchAll();
        if(count($response) == 1){
            $this->state = ($response[0]["etat_vote"] === 0) ? false : true;
        }else{
            $this->state = null;
        }
    }

    public function get_state_card():bool|null{
        return $this->state;
    }

    public function get_code_card():string{
        return $this->code_card;
    }

    public function set_state():void{
        if($this->state){
            $this->state = false;
        }else{
            $this->state = false;
        }
    }
}
