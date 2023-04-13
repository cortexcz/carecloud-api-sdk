<?php
/**
 * Get a collection of recommendation records
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Config;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\AuthTypes;

require_once '../vendor/autoload.php';

$project_uri = 'https://yourapiurl.com/webservice/rest-api/enterprise-interface/v1.0';
$login = 'login';
$password = 'password';
$external_app_id = 'application_id';
$auth_type = AuthTypes::BEARER_AUTH;

$config = new Config($project_uri, $login, $password, $external_app_id, $auth_type);

$care_cloud = new CareCloud($config);

// Set Header parameter Accept-Language
$accept_language = 'en'; //	string | The unique id of the language code by ISO 639-1 Default: cs, en-gb;q=0.8

// Set path parameter
$customer_id = '8ea2591121e636086a4a9c0992'; // string | The unique id of the customer

// Set query parameters
$count = 10; // integer >= 1 | The number of records to return (optional, default is 100)
$offset = 0; // integer | The number of records from a collection to skip (optional, default is 0)
$sort_field = null; // string | One of the query string parameters for sorting (optional, default is null)
$sort_direction = 'DESC'; // string | Direction of sorting the response list (optional, default is null)
$name = null; // string | Search record by name or a part of the name (optional, default is null)

// Call endpoint and get data
try {
    $get_recommendation_records = $care_cloud->customersApi()->getSubCustomerRecommendation(
        $customer_id,
        $accept_language,
        $count,
        $offset,
        $sort_field,
        $sort_direction,
        $name
    );
    $recommendation_records = $get_recommendation_records->getData()->getRecommendations();
    $total_items = $get_recommendation_records->getData()->getTotalItems();
    var_dump($recommendation_records);
    var_dump($total_items);
} catch (ApiException $e) {
    var_dump($e->getResponseBody() ?: $e->getMessage());
    die();
}