<?php
/**
 * @package    PHP Advanced API Guide
 * @author     Davison Pro <davisonpro.coder@gmail.com>
 * @copyright  2019 DavisonPro
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

namespace BestShop\v1;

use Db;
use BestShop\Route;
use BestShop\Database\DbQuery;
use BestShop\Util\ArrayUtils;
use BestShop\Tools;
use BestShop\Validate;

class Room extends Route {
    private static $fields = array(
        "Nummer", "Straße", "HausNr", "Ort", "PLZ", "Plaetze", "Sitzform"
    );

    public function newRoom() {
        $api = $this->api;
        $room = (object)[ ];

        foreach (self::$fields as $field) {
            $room->{$field} = "";
        }
        
        $room->Features = [];

        return $api->response([
            'success' => true,
            'room' => $room
        ]);
    }
    /**
     * Returns all rooms and their features using GET
     */
    public function getRooms() {
        $api = $this->api;
        $db = Db::getInstance();

        $roomsSql = 
            "SELECT
                *
            FROM
                Raum";
        $rooms = $db->executeS($roomsSql);

        $featuresSql = 
            "SELECT 
                rf.RaumID,
                f.*
            FROM
                Raum_Feature rf
            JOIN Feature f ON f.ID = rf.FeatureID";
        $features = $db->executeS($featuresSql);

        foreach ($rooms as &$room) {
            $roomFeatures = array();
            foreach ($features as $feature) {
                if ($feature["RaumID"] == $room["ID"]) {
                    unset($feature["RaumID"]);
                    array_push($roomFeatures, $feature);
                }
            }
            $room["Features"] = $roomFeatures;
        }

        return $api->response([
            'success' => true,
            'rooms' => $rooms
        ]);
    }

    /**
     * Returns the room with the given id and its features using GET
     */
    public function getRoom($roomId) {
        $api = $this->api;
        $db = Db::getInstance();

        if ($roomId == "new") {
            return self::newRoom();
        }

        if (!Validate::isInt($roomId)) {
            return $api->response([
                'success' => false,
                'message' => 'id_must_be_integer'
            ]);
        }

        $roomId = $db->escape($roomId);
        
        $roomsSql = 
            "SELECT
                *
            FROM
                Raum
            WHERE
                ID = $roomId";
        $rooms = $db->executeS($roomsSql);

        if (count($rooms) == 0) {
            return $api->response([
                'success' => false,
                'message' => 'id_not_found'
            ]);
        }

        $room = $rooms[0];

        $featuresSql = 
            "SELECT
                rf.RaumID, 
                f.*
            FROM
                Raum_Feature rf
            JOIN Feature f ON f.ID = rf.FeatureID
            WHERE
                rf.RaumID = $roomId";
        $features = $db->executeS($featuresSql);

        $roomFeatures = array();
        foreach ($features as $feature) {
            if ($feature["RaumID"] == $room["ID"]) {
                unset($feature["RaumID"]);
                array_push($roomFeatures, $feature);
            }
        }
        $room["Features"] = $roomFeatures;

        return $api->response([
            'success' => true,
            'room' => $room
        ]);
    }

    /**
     * Overwrites the room of the given id using PUT
     */
    public function updateRoom($roomId) {
        $api = $this->api;
        $db = Db::getInstance();

        if (!Validate::isInt($roomId)) {
            return $api->response([
                'success' => false,
                'message' => 'id_must_be_integer'
            ]);
        }
        
        $payload = $api->request()->post();
        
        

        foreach (self::$fields as $field) {
            if (!ArrayUtils::has($payload, $field)) {
                return $api->response([
                    'success' => false,
                    'message' => 'missing_field',
                    'field' => $field
                ]);
            }
        }

        if(strlen(trim(strval($payload["Plaetze"]))) == 0) {
            $payload["Plaetze"] = NULL;
        }

        if (!Validate::isNullOrUnsignedId($payload["Plaetze"])) {
            return $api->response([
                'success' => false,
                'message' => 'must_be_a_positive_integer',
                'field' => 'Plaetze'
            ]);
        }
        
        $newFeatures = array();

        if (ArrayUtils::has($payload, "Features")) {
            $features = $payload["Features"];
            if (!is_array($features)) {
                return $api->response([
                    'success' => false,
                    'message' => 'must_be_array',
                    'field' => 'Features'
                ]);
            }

            foreach ($features as $feature) {
                if (!ArrayUtils::has($feature, "ID")) {
                    return $api->response([
                        'success' => false,
                        'message' => 'missing_field_in_feature',
                        'field' => 'ID'
                    ]);
                }

                $featureId = $feature["ID"];
                if (!Validate::isInt($featureId)) {
                    return $api->response([
                        'success' => false,
                        'message' => 'must_be_a_positive_integer',
                        'field' => 'ID'
                    ]);
                }

                $newFeatures[$featureId] = null;
            }
        }

        $insertQuery = "UPDATE Raum SET ";
        $insertValues = array();
        foreach (self::$fields as $field) {
            $value = Tools::sql_value($payload[$field]);
            array_push($insertValues, "`$field`=$value");
        }

        $insertQuery = $insertQuery . implode(",", $insertValues) . " WHERE ID=$roomId;";
        $insertQuery = $insertQuery . "DELETE FROM Raum_Feature WHERE RaumID=$roomId;";

        if (count($newFeatures) > 0) {
            $newFeatures = array_keys($newFeatures);
            $newFeatures = array_map(fn($id) => "($roomId,$id)", $newFeatures);
            $newFeatures = implode(",", $newFeatures);
            $insertQuery = $insertQuery . "INSERT INTO `Raum_Feature`(RaumID, FeatureID) VALUES $newFeatures;";
        }

        $result = $db->executeS($insertQuery);

        return $api->response([
            'success' => true,
            'room' => $payload
        ]);
    }

    /**
     * Inserts a new room using POST
     */
    public function addRoom() {
        $api = $this->api;
        $db = Db::getInstance();

        $payload = $api->request()->post();

        foreach (self::$fields as $field) {
            if (!ArrayUtils::has($payload, $field)) {
                return $api->response([
                    'success' => false,
                    'message' => 'missing_field',
                    'field' => $field
                ]);
            }
        }

        if(strlen(trim(strval($payload["Plaetze"]))) == 0) {
            $payload["Plaetze"] = NULL;
        }

        if (!Validate::isNullOrUnsignedId($payload["Plaetze"])) {
            return $api->response([
                'success' => false,
                'message' => 'must_be_a_positive_integer',
                'field' => 'Plaetze'
            ]);
        }
        
        $newFeatures = array();

        if (ArrayUtils::has($payload, "Features")) {
            $features = $payload["Features"];
            if (!is_array($features)) {
                return $api->response([
                    'success' => false,
                    'message' => 'must_be_array',
                    'field' => 'Features'
                ]);
            }

            foreach ($features as $feature) {
                if (!ArrayUtils::has($feature, "ID")) {
                    return $api->response([
                        'success' => false,
                        'message' => 'missing_field_in_feature',
                        'field' => 'ID'
                    ]);
                }

                $featureId = $feature["ID"];
                if (!Validate::isInt($featureId)) {
                    return $api->response([
                        'success' => false,
                        'message' => 'must_be_a_positive_integer',
                        'field' => 'ID'
                    ]);
                }

                $newFeatures[$featureId] = null;
            }
        }
        
        $insertValues = array();
        foreach (self::$fields as $field) {
            array_push($insertValues, Tools::sql_value($payload[$field]));
        }

        $insertQuery = "INSERT INTO Raum (" . implode(",", self::$fields) . ") VALUES (" . implode(",", $insertValues) . ");";

        if (count($newFeatures) > 0) {
            $newFeatures = array_keys($newFeatures);
            $newFeatures = array_map(fn($id) => "(@RaumId,$id)", $newFeatures);
            $newFeatures = implode(",", $newFeatures);
            $insertQuery = $insertQuery . "SET @RaumId = LAST_INSERT_ID(); INSERT INTO `Raum_Feature`(RaumID, FeatureID) VALUES $newFeatures;";
        }

        $db->executeS($insertQuery);

        return $api->response([
            'success' => true
        ]);
    }

    /**
     * Deletes the room using DELETE
     */
    public function deleteRoom($roomId) {
        $api = $this->api;
        $db = Db::getInstance();

        if (!Validate::isInt($roomId)) {
            return $api->response([
                'success' => false,
                'message' => 'id_must_be_integer'
            ]);
        }

        $db->executeS("DELETE FROM Raum_Feature WHERE RaumID = $roomId; DELETE FROM Raum WHERE ID = $roomId");
        
        return $api->response([
            'success' => true
        ]);
    }
}


