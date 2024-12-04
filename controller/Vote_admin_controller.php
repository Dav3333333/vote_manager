<?php 

namespace Controller;

use Controller\Vote_controller;


class Vote_admin_controller extends Vote_controller
{

    public function vote_autorize(int $id_vote):bool{
        return ($this->bdd->query("UPDATE 'vote_register' SET 'autorization' = '1' WHERE 'vote_register'.'id' = {$id_vote}"));
    }

    /**
     * allow the the vote session
     * @return void
     */
    public function start_vote():bool{
        return ($this->bdd->query("UPDATE 'vote_state' SET 'state' = '1' WHERE 'vote_stade'.'id' = {0}")) ? true : false;
    }
}
