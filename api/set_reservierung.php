<?php
    require_once "_db.php";

    if (isset($_GET["cmd"]) && $_GET["cmd"] == "new" 
        && isset($_GET["benutzerId"]) 
        && isset($_GET["raumId"])
        && isset($_GET["datum"])
        && isset($_GET["von"])
        && isset($_GET["bis"])) 
    {
        $benutzerId = $_GET["benutzerId"];
        $raumId = $_GET["raumId"];
        $datum = $_GET["datum"];
        $von = $_GET["von"];
        $bis = $_GET["bis"];
        
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
    elseif (isset($_GET["cmd"]) && $_GET["cmd"] == "delete" && isset($_GET["reservierungId"])) 
    {
        $reservierungId = $_GET["reservierungId"];

        $query = "DELETE FROM Reservierung WHERE ID = $reservierungId";
        db::getInstance()->query($query);

        echo '{"info":"reservation_deleted"}';
    }
    else
    {
        echo '{"error":"wrong_or_not_enough_arguments"}';
    }
?>