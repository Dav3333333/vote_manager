<?php
namespace Controller;

use PDO;
use Php\Classes\Candidate;

class Canditates_controller
{
    protected PDO $bdd;
    protected array $candidates;
    
    public function __construct(PDO $bdd){
        $this->bdd= $bdd;
        $this->candidates = $this->load_candidates();
    }

    /**
     * Return the list of canditdates classes objects
     * @return array
     */
    private function load_candidates():array{
        $q = $this->bdd->prepare("SELECT id_unique FROM candidate ORDER BY id ASC");
        $q->execute();
        $data = [];
        while ($s = $q->fetch(PDO::FETCH_ASSOC)) {
            $cand = new Candidate($this->bdd, $s['id_unique']);
            array_push($data, $cand);
        }
        return $data;
    }

    /**
     * return an array of candidates on the system
     * @return array
     */
    public function get_candidates():array{
        return $this->candidates;
    }

}
