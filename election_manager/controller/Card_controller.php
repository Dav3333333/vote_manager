<?php

namespace Controller;

use \PDO;
use Php\Classes\Card;

final class Card_controller 
{
    private PDO $bdd;
    private array $cards; 
    public function __construct(PDO $bdd){
        $this->bdd = $bdd;
        $this->cards = $this->load_cards();
    }

    /**
     * return the array of card objects
     * @return array
     */
    private function load_cards():array{
        $cards = [];
        $q = $this->bdd->query("SELECT id_unique FROM  card");
        while ($ans = $q->fetch(PDO::FETCH_ASSOC)) {
            $c = new Card($ans["id_unique"], $this->bdd);
            array_push($cards, $c);
        }
        return $cards;
    }

    private function delete_all_card(){
        $this->bdd->query("TRUNCATE TABLE card");
        array_splice($this->cards, 0);
    }

    public function get_all_cards():array{
        return $this->cards;
    }

    public function get_unuse_cards():array{
        $arr = [];
        foreach ($this->cards as $key => $value) {
            if($value->get_state_card() === false){
                array_push($arr, $value);
            }
        }
        return $arr;
    }

    public function checkCard(string $card):bool{
        return in_array(new Card($card, $this->bdd), $this->cards);
    }

    public function get_State_card(string $card_code):bool|null{
        $c = new Card($card_code, $this->bdd);
        return $c->get_state_card();
    }

    /**
     * retrun true if cards are genereated
     * @param int $number
     * @return void
     */
    public function generate_cards(int $number){
        $this->delete_all_card();
        for ($i=0; $i < $number; $i++) { 
            $code_card = str_split(md5("".(time()+$i)), 10)[0];
            $q = $this->bdd->prepare("INSERT INTO card(id_unique) VALUE(?)");
            $q->execute(array($code_card));
        }
        $this->cards = $this->load_cards();
    }

    public function vote(Card $card, string $canditate_id):bool{
        if(!$card->get_state_card()){
            $req = $this->bdd->prepare("INSERT INTO vote(id_unique_candidate,id_unique_card) VALUES(?,?)");
            $req->execute(array($card->get_code_card(), $canditate_id));
            $card->set_state();
            return true;
        }
        return false;
    }
    
}
