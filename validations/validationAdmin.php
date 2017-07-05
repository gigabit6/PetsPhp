<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if($_SESSION['isAdmin']!=1)
{
    header("Location: index.php");
    exit;
}
