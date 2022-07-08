<?php
    require_once '_db.php';

    $query = "";

    if (isset($_GET["datum"]) && isset($_GET["von"]) && isset($_GET["bis"])) {
        $datum = $_GET["datum"];
        $von = $_GET["von"];
        $bis = $_GET["bis"];

        $query =
            "SELECT * FROM Raum WHERE ID NOT IN (
                SELECT 
                    RaumID 
                FROM 
                    Reservierung 
                WHERE 
                    Reservierung.Von < '$bis' 
                    AND Reservierung.Bis > '$von' 
                    AND Reservierung.Datum = '$datum'
            )";
    }
    elseif (isset($_GET["id"])) {
        $id = $_GET["id"];

        $query = "SELECT * FROM Raum WHERE ID = '$id'";
    }
    else {
        $query = "SELECT * FROM Raum";
    }

    $rooms = db::getInstance()->query_to_array($query);

    $features = db::getInstance()->query_to_array(
        "SELECT 
            rf.RaumID, 
            rf.FeatureID, 
            f.Name 
        FROM Raum_Feature rf 
        JOIN Feature f ON rf.FeatureID = f.ID");
        
    $features = group_by('RaumID', $features);

    // echo var_dump($features);

    foreach ($rooms as &$room) {
        $arr = array();
        $id = $room['ID'];
        if (array_key_exists($id, $features))
            $arr = $features[$id];

        $room['features'] = $arr;
    }


    echo json_encode($rooms);

    function group_by($key, $data) {
        $result = array();
    
        foreach($data as $val) {
            if(array_key_exists($key, $val)) {
                $result[$val[$key]][] = $val;
            } else {
                $result[""][] = $val;
            }
        }
    
        return $result;
    }
?>