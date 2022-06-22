<?php
    require_once '_db.php';

    $reservations = db::getInstance()->query_to_array(
        "SELECT 
            * 
        FROM Reservierung res 
        JOIN Raum rau ON res.RaumID = rau.ID"
    );

    $roomIds = array_map(function($reserv) { return $reserv['RaumID']; }, $reservations);
    $roomIds = array_unique($roomIds);
    $roomIds = implode(",", $roomIds);

    $features = db::getInstance()->query_to_array(
        "SELECT 
            rf.RaumID, 
            rf.FeatureID, 
            f.Name 
        FROM Raum_Feature rf 
        JOIN Feature f ON rf.FeatureID = f.ID
        WHERE rf.RaumID IN ($roomIds)"
    );

    $features = group_by('RaumID', $features);

    foreach ($reservations as &$reservation) {
        $arr = array();
        $roomId = $reservation['RaumID'];
        if (array_key_exists($roomId, $features))
            $arr = $features[$roomId];

        $reservation['features'] = $arr;
    }


    echo json_encode($reservations);

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