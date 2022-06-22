<?php
    require_once '_db.php';

    $rooms = db::getInstance()->query_to_array('SELECT * FROM Raum');
    $features = db::getInstance()->query_to_array('SELECT rf.RaumID, rf.FeatureID, f.Name FROM Raum_Feature rf JOIN Feature f ON rf.FeatureID = f.ID');
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