<?php
    require_once "_db.php";

    if (isset($_POST["cmd"]) && $_POST["cmd"] == "new" 
        && isset($_POST["benutzerId"]) 
        && isset($_POST["raumId"])
        && isset($_POST["datum"])
        && isset($_POST["von"])
        && isset($_POST["bis"])) 
    {
        $benutzerId = $_POST["benutzerId"];
        $raumId = $_POST["raumId"];
        $datum = $_POST["datum"];
        $von = $_POST["von"];
        $bis = $_POST["bis"];
        
        $checkQuery = 
        "SELECT
            *
        FROM
            Reservierung
        WHERE
            RaumID = $raumId
            AND Datum = '$datum'
            AND Bis > '$von'
            AND Von < '$bis'";

        $reservations = db::getInstance()->query_to_array($checkQuery);

        if (count($reservations) > 0) {
            echo '{"error":"room_already_occupied"}';
            return;
        }

        $insertQuery = 
            "INSERT INTO Reservierung 
                (BenutzerID, RaumID, Datum, Von, Bis) 
            VALUES 
                ('$benutzerId', '$raumId', '$datum', '$von', '$bis')";

        db::getInstance()->query($insertQuery);

        echo '{"info":"reservation_saved"}';
    }
    elseif (isset($_POST["cmd"]) && $_POST["cmd"] == "delete" && isset($_POST["reservierungId"])) 
    {
        
    }
    else
    {
        echo '{"error":"wrong_or_not_enough_arguments"}';
    }
?>