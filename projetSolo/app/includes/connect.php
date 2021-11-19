<?php

require "dev.env.php";


$connexion_string = "mysql:dbname=" .DATABASE. ";host=" .SERVER;

try {
    $connexion = new PDO($connexion_string, USER, PASSWORD);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $connexion = null;
    echo 'Erreur : ' . $e->getMessage();
};