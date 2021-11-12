<?php

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\SDK\Config;
use CrmCareCloud\Webservice\RestApi\SDK\CareCloud;
use CrmCareCloud\Webservice\RestApi\SDK\Data\AuthTypes;

require_once '../vendor/autoload.php';
require_once 'config.php';

$config    = new Config($projectUri, $login, $password, $externalAppId, $authType);
$careCloud = new CareCloud($config);

try {
    // Get all vouchers
    $vouchers = $careCloud->vouchersApi()->getVouchers();
    $items = $vouchers->getData()->getVouchers();
    $totalItems = $vouchers->getData()->getTotalItems();
} catch (ApiException $e) {
    die(var_dump($e->getResponseBody()));
}
