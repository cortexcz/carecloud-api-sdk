<?php
/**
 * Send purchase
 */

use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsSendpurchaseBody;
use CrmCareCloud\Webservice\RestApi\Client\Model\BillItem;
use CrmCareCloud\Webservice\RestApi\Client\Model\FinalBill;
use CrmCareCloud\Webservice\RestApi\Client\Model\PluId;
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

// Set the bill info
$plu_ids = new PluId();
$plu_ids->setListCode('local_code');
$plu_ids->setCode('e345');

$bill_item = new BillItem();
$bill_item->setPluIds(array($plu_ids));
$bill_item->setPluName('Teapot');
$bill_item->setCategoryPluId('1110001');
$bill_item->setVatRate(0);
$bill_item->setQuantity(1);
$bill_item->setPaidAmount(100);
$bill_item->setPrice(100);
$bill_item->setBillItemId('teapot_id_01');
$bill_item->setLoyaltyOff(true);
$bill_item->setPurchaseItemTypeId('86e05affc7a7abefcd513ab400');
$bill_item->setCustomerId(null);

$bill = new FinalBill();
$bill->setFiscal(false);
$bill->setPurchaseTypeId('86e05affc7a7abefcd513ab400');
$bill->setCanceled(false);
$bill->setPaymentType('S');
$bill->setPaymentRecap(null);
$bill->setBillId('bill003');
$bill->setBillNumber(null);
$bill->setPaymentTime('2022-10-31T15:51:49+02:00');
$bill->setCreatedBy(null);
$bill->setCurrencyId('8bed991c68a470e7aaeffbf048');
$bill->setTotalPrice(100);
$bill->setUtm(null);
$bill->setBillItems(array($bill_item));

// Set the request body
$body = new ActionsSendpurchaseBody();
$body->setStoreId('8bed991c68a470e7aaeffbf048');
$body->setCashdeskNumber(1);
$body->setCardNumber(null);
$body->setCustomerId(null);
$body->setBill($bill);

// Call endpoint and post data
try
{
    $post_purchase = $care_cloud->purchasesApi()->postPurchaseSend($body, $accept_language);
    $purchase_id = $post_purchase->getData()->getPurchaseId();
    var_dump($purchase_id);
}
catch(ApiException $e)
{
    die(var_dump($e->getResponseBody() ?: $e->getMessage()));
}