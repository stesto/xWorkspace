<?php
    require_once "_db.php";

    if (isset($_GET["Name"]) && isset($_GET["Password"])) {
        $name = $_GET["Name"];
        $password = $_GET["Password"];

        $query = 
            "SELECT 
                *
            FROM 
                Benutzer  
            WHERE 
                Name = '$name' 
                AND Password = '$password'";

        $users = db::getInstance()->query_to_array($query);

        echo json_encode($users);
    }
    else {
        echo "[]";
    }

        