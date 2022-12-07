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

class User extends Route {
    private static $fields = array(
        "Name", "Password", "Nachname", "Email", "Rolle"
    );

    public function getUsers() {
        $api = $this->api;
        $db = Db::getInstance();

        $usersSql = 
            "SELECT
                *
            FROM
                Benutzer";
        $users = $db->executeS($usersSql);

        return $api->response([
            'success' => true,
            'users' => $users
        ]);
    }

    public function getUser($userId) {
        $api = $this->api;
        $db = Db::getInstance();

        if (!Validate::isInt($userId)) {
            return $api->response([
                'success' => false,
                'message' => 'id_must_be_integer'
            ]);
        }
        
        $usersSql = 
            "SELECT
                *
            FROM
                Benutzer
            WHERE
                ID = $userId";
        $users = $db->executeS($usersSql);

        if (count($users) == 0) {
            return $api->response([
                'success' => false,
                'message' => 'id_not_found'
            ]);
        }

        $user = $users[0];

        return $api->response([
            'success' => true,
            'user' => $user
        ]);
    }

    public function updateUser($userId) {
        $api = $this->api;
        $db = Db::getInstance();

        if (!Validate::isInt($userId)) {
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

        $insertQuery = "UPDATE Benutzer SET ";
        $insertValues = array();
        foreach (self::$fields as $field) {
            $value = Tools::sql_value($payload[$field]);
            array_push($insertValues, "`$field`=$value");
        }

        $insertQuery = $insertQuery . implode(",", $insertValues) . " WHERE ID=$userId;";

        $db->executeS($insertQuery);

        return $api->response([
            'success' => true,
            'user' => $payload
        ]);
    }

    public function addUser() {
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

        $insertValues = array();
        foreach (self::$fields as $field) {
            array_push($insertValues, Tools::sql_value($payload[$field]));
        }

        $insertQuery = "INSERT INTO Benutzer (" . implode(",", self::$fields) . ") VALUES (" . implode(",", $insertValues) . ");";

        $db->executeS($insertQuery);

        return $api->response([
            'success' => true,
            'feature' => $payload
        ]);
    }

    public function deleteUser($userId) {
        $api = $this->api;
        $db = Db::getInstance();

        if (!Validate::isInt($userId)) {
            return $api->response([
                'success' => false,
                'message' => 'id_must_be_integer'
            ]);
        }

        $db->executeS("DELETE FROM Benutzer WHERE ID = $userId");
        
        return $api->response([
            'success' => true
        ]);
    }
}
