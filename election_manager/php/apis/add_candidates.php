<?php 

use Controller\Admin_controller;

// contollers
require_once("../../config.php");
require_once("../../controller/Card_controller.php");
require_once("../../controller/Canditates_controller.php");
require_once("../../controller/Vote_controller.php");

require_once("../../controller/admin_controller.php");
require_once("../../controller/Candidates_controller_admin.php");
require_once("../../controller/Vote_admin_controller.php");

// classes
require_once("../classes/Card.php");
require_once("../classes/Candidate.php");

if(isset($_POST["name"], $_POST['second-name']) && !empty($_POST["name"]) && !empty($_POST['second-name'])){
    $full_name = htmlspecialchars($_POST['name']) . " ".htmlspecialchars($_POST['second-name']);

    $ext = ['png', 'PNG', "jpg", "JPG", "jpeg", "JPEG"];

    $types = ['image/jpeg', "image/png", "image/PNG", "image/JPG"];

    if(isset($_FILES['image'])){
        $file = $_FILES['image'];

        $img_ext = explode('.',$file['name']);
        $img_ext = $img_ext[array_key_last($img_ext)];

        $img_name = $file['name'];

        if(in_array($img_ext, $ext) && in_array($file['type'],$types) ){
            if(move_uploaded_file($file['tmp_name'], '../images/'.$img_name)){
                $admin_controler = new Admin_controller($bdd);
                $admin_controler = $admin_controler->get_candidates_controller_admin();
                echo $admin_controler->add_candidate($full_name, $img_name);
            }
        }else{
            echo "Selectionner un fichier avec extention  'png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG'"; 
            var_dump($file);
        }
    }else{
        echo "vous devez selectionner une image";
    }
}else{
    echo 'Vous devez remplir champs nom et post-nom';
}

