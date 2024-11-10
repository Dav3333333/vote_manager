<?php

namespace Php\Classes;
use PDO;
class Candidate 
{

    private PDO $bdd; 
    private string $id_canditate;
    private string $name;
    private int $candidate_number;
    private int $number_voice;
    private string $image;

    public function __construct(PDO $bdd, string $id_canditate){
        $this->bdd = $bdd;
        $this->id_canditate = $id_canditate;
        $this->load_data();
        $this->number_voice = 0;
    }

    private function load_data():void{
        $q = $this->bdd->prepare("SELECT * FROM candidate WHERE id_unique = ?");
        $q->execute(array($this->id_canditate));
        while ($ans = $q->fetch(PDO::FETCH_ASSOC)) {
            $this->name = strtoupper($ans["names"]);
            $this->candidate_number = $ans["id"];
            $this->image = $ans['image_path'];
        }

        $vq = $this->bdd->prepare("SELECT * FROM vote WHERE id_unique_candidate = ?");
        $vq->execute(array($this->id_canditate));
        $this->number_voice = count($vq->fetchAll());
        
    }

    public function get_name():string{
        return $this->name;
    }

    public function get_number():int{
        return $this->candidate_number;
    }

    public function get_number_voice():int{
        return $this->number_voice;
    }

    public function get_image():string{
        return $this->image;
    }

    public function set_number_voice(int $new_number){
        $this->number_voice = $new_number;
    }

}
