<?php 

if(!isset($_GET["page"])){
    $_GET["page"] = "home";
}

if(isset($_GET['page'])){
    require_once("config.php");
}


require_once("repeted/header.php");
echo '<link rel="stylesheet" href="style.css">';

switch ($_GET["page"]) {
    case 'home':
        require_once("views/home.php");
        break;
    case 'vote':
        require_once("views/vote.php");
        break;
    case 'result':
        require_once("views/result.php");
        break;
    case 'admin':
        require_once("views/admin.php");
        break;
    default:
        require_once("views/home.php");
        break;
}