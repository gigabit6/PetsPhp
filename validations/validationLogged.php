<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(basename($_SERVER['PHP_SELF']) != "login.php" && basename($_SERVER['PHP_SELF']) != "index.php"){
    if(!isset($_SESSION['id'])){
    header("Location: login.php");
}}