<?php 

namespace Controller;

use Controller\Vote_controller;


class Vote_admin_controller extends Vote_controller
{
    public function add_candidate(string $names, string $image_path):bool{
        $q = $this->bdd->prepare("INSERT INTO candidate(names, image_path) VALUES(?,?)");
        $q->execute(array($names, $image_path));
        return true;
    }

    public function set_vote_autorization():bool{
        return ($this->bdd->query("UPDATE vote_register.autorization WHERE "));
    }

    public function delet_candidate($id_unique_candidate):bool{
        $q = $this->bdd->prepare("DELETE FROM candidate WHERE id_unique = ?");
        $q->execute(array($id_unique_candidate));
        return true;
    }
}
