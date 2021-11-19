<?php

session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location:index.php?notconnected');
}

if (empty($_SESSION)) {
    if (isset($auth)) {
        header('Location:sign-in.php?auth');
        exit();
    }
}