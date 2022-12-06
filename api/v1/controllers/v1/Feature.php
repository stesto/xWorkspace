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

class Feature extends Route {

    public function getFeatures() {
        $api = $this->api;
        $db = Db::getInstance();

        $featuresSql = 
            "SELECT
                *
            FROM
                Feature";
        $features = $db->executeS($featuresSql);

        return $api->response([
            'success' => true,
            'features' => $features
        ]);
    }

    public function getFeature($featureId) {
        $api = $this->api;
        $db = Db::getInstance();

        if (!Validate::isInt($featureId)) {
            return $api->response([
                'success' => false,
                'message' => 'id_must_be_integer'
            ]);
        }
        
        $featuresSql = 
            "SELECT
                *
            FROM
                Feature
            WHERE
                ID = $featureId";
        $features = $db->executeS($featuresSql);

        if (count($features) == 0) {
            return $api->response([
                'success' => false,
                'message' => 'id_not_found'
            ]);
        }

        $feature = $features[0];

        return $api->response([
            'success' => true,
            'feature' => $feature
        ]);
    }

    public function updateFeature($featureId) {
        $api = $this->api;
        $db = Db::getInstance();

        if (!Validate::isInt($featureId)) {
            return $api->response([
                'success' => false,
                'message' => 'id_must_be_integer'
            ]);
        }
        
        $payload = $api->request()->post();
        
        $fields = array(
            "Name"
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

        $insertQuery = "UPDATE Feature SET ";
        $insertValues = array();
        foreach ($fields as $field) {
            $value = Tools::sql_value($payload[$field]);
            array_push($insertValues, "`$field`=$value");
        }

        $insertQuery = $insertQuery . implode(",", $insertValues) . " WHERE ID=$featureId;";

        $db->executeS($insertQuery);

        return $api->response([
            'success' => true,
            'feature' => $payload
        ]);
    }

    public function addFeature() {
        $api = $this->api;
        $db = Db::getInstance();
        
        $payload = $api->request()->post();
        
        $fields = array(
            "Name"
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

        $insertValues = array();
        foreach ($fields as $field) {
            array_push($insertValues, Tools::sql_value($payload[$field]));
        }

        $insertQuery = "INSERT INTO Feature (" . implode(",", $fields) . ") VALUES (" . implode(",", $insertValues) . ");";

        $db->executeS($insertQuery);

        return $api->response([
            'success' => true,
            'feature' => $payload
        ]);
    }

    public function deleteFeature($featureId) {
        $api = $this->api;
        $db = Db::getInstance();

        if (!Validate::isInt($featureId)) {
            return $api->response([
                'success' => false,
                'message' => 'id_must_be_integer'
            ]);
        }

        $db->executeS("DELETE FROM Feature WHERE ID = $featureId");
        
        return $api->response([
            'success' => true
        ]);
    }
}


