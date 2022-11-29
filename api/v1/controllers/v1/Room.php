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
use BestShop\Validate;

class Room extends Route {

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

    public function getRoom($roomId) {
        $api = $this->api;
        $db = Db::getInstance();

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
        
        $fields = array(
            "Nummer", "Straße", "HausNr", "Ort", "PLZ", "Plaetze", "Sitzform"
        );

        foreach ($fields as $field) {
            if (!ArrayUtils::has($payload, $field)) {
                return $api->response([
                    'success' => false,
                    'message' => 'missing_field',
                    'field' => $field
                ]);
            }
        }

        if (!Validate::isNullOrUnsignedId($payload["Plaetze"])) {
            return $api->response([
                'success' => false,
                'message' => 'must_be_a_positive_integer',
                'field' => 'Plaetze'
            ]);
        }

        $insertQuery = "UPDATE Raum SET ";
        $insertValues = array();
        foreach ($fields as $field) {
            $value = $payload[$field];

            if ($value == NULL)
                $value = "NULL";
            else
                $value = "'".$db->escape($value)."'";

            array_push($insertValues, "`" .$field. "`" . "=" . $value);
        }

        $insertQuery = $insertQuery . implode(",", $insertValues) . " WHERE ID=$roomId;";
        $result = $db->executeS($insertQuery);

        return $api->response([
            'success' => true,
            'room' => $payload
        ]);
    }

    public function addRoom() {
        
    }
}


