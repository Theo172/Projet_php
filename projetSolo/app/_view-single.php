<?php

$id = $_GET['id'];

    $viewLocation = "SELECT * from location WHERE location_id = :location_id";
    $reqViewLocation = $connexion->prepare($viewLocation);
    $reqViewLocation->bindValue(':location_id',$id);
    $reqViewLocation->execute();
    $location = $reqViewLocation->fetch();
    if(empty($location)){
        echo "Erreur";
        echo '<meta http-equiv="refresh" content="0;URL=index.php?error=noid">';
        exit();
    }
?>