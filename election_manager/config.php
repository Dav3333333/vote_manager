<?php
$hostname = "localhost";
$dbname = "election";
$username = "root";
$password = "";

$bdd = new PDO("mysql:host={$hostname};dbname={$dbname}","{$username}","{$password}",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

