<?php

$auth = true;
require 'includes/config.php';
require 'includes/connect.php';

if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['price']) || empty($_POST['adresse'])) {
    header('Location:add-location.php?error=missingInput');
    exit();
} else {
    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $price = htmlspecialchars(floatval($_POST['price']));
    $adress= htmlspecialchars(trim($_POST['adresse']));
    $image= htmlspecialchars(trim($_POST['image']));
    

    if (empty($_FILES['image']['name'])) {
        $imagePath = 'public/uploads/noimg.jpg';
        $image = null;
    }
}

if ($image) {
    if ($image['size'] > 10000000) {
        header('Location:add-location.php?error=imageTooBig');
        exit();
    }

    $valid_ext = ['jpg', 'jpeg', 'png'];
    $check_ext = strtolower(substr(strrchr($image['name'], '.'), 1));

    if (!in_array($check_ext, $valid_ext)) {
        header('Location:add-location.php?error=wrongFormat');
        exit();
    }

    $imagePath = 'public/uploads/'.uniqid().'/'.$image['name'];

    mkdir(dirname($imagePath));

    if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
        if (!in_array($check_ext, $valid_ext)) {
            header('Location:add-location.php?error=unknownError');
            exit();
        }
    }
}

$insertProduct = 'INSERT INTO location (name,description,price,adress,image) VALUES(:name,:description,:price,:adresse,:image)';
$reqInsertProduct = $connexion->prepare($insertProduct);
$reqInsertProduct->bindValue(':name', $name, PDO::PARAM_STR);
$reqInsertProduct->bindValue(':description', $description, PDO::PARAM_STR);
$reqInsertProduct->bindValue(':price', $price);
$reqInsertProduct->bindValue(':adresse', $adress, PDO::PARAM_STR);
$reqInsertProduct->bindValue(':image', $imagePath, PDO::PARAM_STR);

if ($reqInsertProduct->execute()) {
    header('Location:index.php?success=addedProduct');
    exit();
} else {
    header('Location:add-product.php?error=unknownError');
    exit();
}