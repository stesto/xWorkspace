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
use BestShop\Product\Product as ProductObject;
use BestShop\Product\Category as CategoryObject;
use BestShop\Util\ArrayUtils;
use BestShop\Validate;

class Room extends Route {

    public function getRooms() {
        $api = $this->api;
        $db = Db::getInstance();

        $roomsSql = new DbQuery();
        $roomsSql->select('*')->from('Raum');
        $rooms = $db->executeS($roomsSql);

        $featuresSql = new DbQuery();
        $featuresSql->select('rf.RaumID, f.*')->from('Raum_Feature', 'rf')->join('JOIN Feature f ON f.ID = rf.FeatureID');
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
                'message' => 'id_wrong_type'
            ]);
        }

        $roomId = pSQL($roomId);
        
        $roomsSql = new DbQuery();
        $roomsSql->select('*')->from('Raum')->where('ID = '.$roomId);
        $rooms = $db->executeS($roomsSql);

        if (count($rooms) == 0) {
            return $api->response([
                'success' => false,
                'message' => 'id_not_found'
            ]);
        }

        $room = $rooms[0];

        $featuresSql = new DbQuery();
        $featuresSql
            ->select('rf.RaumID, f.*')
            ->from('Raum_Feature', 'rf')
            ->join('JOIN Feature f ON f.ID = rf.FeatureID')
            ->where("rf.RaumID = $roomId");
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
}
