<?php
namespace Controller;

use Controller\Canditates_controller;

class Candidates_controller_admin extends Canditates_controller
{
    /**
     * return true if succes and false if not
     * @return bool
     */
    public function add_candidate(string $names, string $image_name):bool{
        # escape specials char from the string
        $names = htmlspecialchars($names);
        $image_path = htmlspecialchars($image_name);
        if(strlen($names) > 0 && strlen($image_path) > 0 ){
            #generating and escaping special chars
            $id_unique = htmlspecialchars(md5(str_split(''.time(),10)[0]));
            # formulating query and returning the reponse feed back
            $q = $this->bdd->prepare("INSERT INTO candidate(id_unique,names,image_path) VALUES(?,?,?)");
            return ($q->execute(array($id_unique, $names, $image_path))) ? true : false;
        }else{
            return false;
        }
    }

    /**
     * remove a candidate in the list of enroled candidate
     * @param string $id_unique_candidate
     * @return bool
     */
    public function remove_candidate(string $id_unique_candidate):bool{
        $id = htmlspecialchars($id_unique_candidate);
        if(is_string($id) && strlen($id) === 10){
            return $this->bdd->prepare("DELETE FROM candidate 
                                                WHERE id_unique = ?")->execute(array($id_unique_candidate));
        }else{
            return false;
        }
    }
}
