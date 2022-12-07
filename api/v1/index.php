<?php 
/**
 * https://github.com/Davisonpro/advanced-rest-api
 * https://davisonpro.dev/how-to-create-an-advanced-php-rest-api/
 * 
 * @package    PHP Advanced API Guide
 * @author     Davison Pro <davisonpro.coder@gmail.com>
 * @copyright  2019 DavisonPro
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

 // Namespaces
define('API_NAMESPACE',          'BestShop');
define('API_DIR_ROOT',            dirname(__FILE__));
define('API_DIR_CLASSES',         API_DIR_ROOT . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR);
define('API_DIR_CONTROLLERS',     API_DIR_ROOT . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR);

require_once API_DIR_ROOT . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php'; 
require_once API_DIR_ROOT . DIRECTORY_SEPARATOR . 'autoload.php'; 
require_once API_DIR_ROOT . DIRECTORY_SEPARATOR . 'functions.php'; 

use BestShop\Api;
use BestShop\Database\DbQuery;
use BestShop\Database\DbCore;
use BestShop\Database\DbPDOCore;
use BestShop\Database\DbMySQLiCore;

abstract class Db extends DbCore {};
class DbPDO extends DbPDOCore {};
class DbMySQLi extends DbMySQLiCore {};

/** CORS Middleware */
$config = array(
	/** MySQL database name */
	'database_name' => 'db_xws',
	/** MySQL hostname */
	'database_host' => '10.50.200.50',
	/** MySQL database username */
	'database_user' => 'xws_user',
	/** MySQL database password */ 
	'database_password' => 'xws123',
	/** MySQL Database Table prefix. */
	'database_prefix' => '',
	/** preferred database */
	'database_engine' => 'DbPDO',
	/** API CORS */
	'cors' => [
		'enabled' => true,
		'origin' => '*', // can be a comma separated value or array of hosts
		'headers' => [
			'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Authorization, Cache-Control, Content-Type, Access-Control-Allow-Origin',
			'Access-Control-Allow-Credentials' => 'true',
			'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE,OPTIONS,PATCH'
		]
	]
);

define('_DB_SERVER_', $config['database_host']);
define('_DB_NAME_', $config['database_name']);

define('_DB_USER_', $config['database_user']);
define('_DB_PASSWD_', $config['database_password']);
define('_DB_PREFIX_',  $config['database_prefix']);
define('_MYSQL_ENGINE_',  $config['database_engine']);

/** API Construct */
$api = new Api([
	'mode' => 'development',
    'debug' => true
]);

$api->add(new \BestShop\Slim\CorsMiddleware());
$api->config('debug', true);

/**
 * Request Payload
 */
$params = $api->request->get();
$requestPayload = $api->request->post();

$api->group('/rooms', function() use ($api) {
	$api->get('/?', 		  '\BestShop\v1\Room:getRooms')->name('get_rooms');
	$api->get('/:roomId?', 	  '\BestShop\v1\Room:getRoom')->name('get_room');
	$api->post('/?', 		  '\BestShop\v1\Room:addRoom')->name('add_room');
	$api->put('/:roomId?', 	  '\BestShop\v1\Room:updateRoom')->name('update_room');
	$api->delete('/:roomId?', '\BestShop\v1\Room:deleteRoom')->name('delete_room');
	$api->get('/new', 	      '\BestShop\v1\Room:newRoom')->name('new_room');
});

$api->group('/features', function() use ($api) {
	$api->get('/?', 		     '\BestShop\v1\Feature:getFeatures')->name('get_features');
	$api->get('/:featureId?',    '\BestShop\v1\Feature:getFeature')->name('get_feature');
	$api->post('/?', 		     '\BestShop\v1\Feature:addFeature')->name('add_feature');
	$api->put('/:featureId?',    '\BestShop\v1\Feature:updateFeature')->name('update_feature');
	$api->delete('/:featureId?', '\BestShop\v1\Feature:deleteFeature')->name('delete_feature');
});

$api->group('/users', function() use ($api) {
	$api->get('/?', 		  '\BestShop\v1\User:getUsers')->name('get_users');
	$api->get('/:userId?',    '\BestShop\v1\User:getUser')->name('get_user');
	$api->post('/?', 		  '\BestShop\v1\User:addUser')->name('add_user');
	$api->put('/:userId?',    '\BestShop\v1\User:updateUser')->name('update_user');
	$api->delete('/:userId?', '\BestShop\v1\User:deleteUser')->name('delete_user');
});

// $api->group('/api', function () use ($api) {
// 	$api->group('/v1', function () use ($api) {
// 		/** Get all Products */
// 		$api->get('/products?', '\BestShop\v1\Product:getProducts')->name('get_products');
		
// 		/** Add a Product */
// 		$api->post('/products?', '\BestShop\v1\Product:addProduct')->name('add_products');
	
// 		/** Get a single Product */
// 		$api->get('/products/:productId?', '\BestShop\v1\Product:getProduct')->name('add_product');

// 		/** Update a single Product */
// 		$api->patch('/products/:productId?', '\BestShop\v1\Product:updateProduct')->name('update_product');
	
// 		$api->delete('/products/:productId?', '\BestShop\v1\Product:deleteProduct')->name('delete_product');
		
// 		/** Grouping Category Endpoints */
// 		$api->group('/categories', function () use ($api) {
// 			/** Get all Categories */
// 			$api->get('/?', '\BestShop\v1\Category:getCategories')->name('get_categories');
			
// 			/** Add a Category */
// 			$api->post('/?', '\BestShop\v1\Category:addCategory')->name('add_category');
	
// 		});
		
// 		/** search products */
// 		$api->get('/search?', '\BestShop\v1\Product:searchProducts')->name('search_products');
// 	});
//});

$api->notFound(function () use ($api) {
	$api->response([
		'success' => false,
		'error' => 'Resource Not Found'
	]);
	return $api->stop();
});

$api->response()->header('Content-Type', 'application/json; charset=utf-8');
$api->run();
