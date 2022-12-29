<?php

function ensureLogin() {
    if (!isset($_COOKIE["username"]) || !isset($_COOKIE["user_id"])) {
        header("Location: login.php");
        die();
    }
}

function isAdmin() {
    return isset($_COOKIE["user_role"]) && $_COOKIE["user_role"] == 'admin';
}

function ensureAdmin() {
    if (!isAdmin()) {
        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " + $_SERVER['HTTP_REFERER']);
        }
        else {
            header("Location: bueroreservierung.php");
        }
    }
}

?>