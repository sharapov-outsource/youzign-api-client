<?php
/**
 * Created by PhpStorm.
 * User: Sharapov A. <alexander@sharapov.biz>
 * Date: 17.03.2016
 * Time: 15:13
 */

require_once dirname(__FILE__) . '/../vendor/autoload.php';

// Demo credentials. You should get real credentials in your Youzign profile
$demoKey = '5077d4ed60da38255c2c71421ddac36f';
$demoToken = '55f772fcdae50ce0caee3986112621a3';

$yzApi = new \YouzignAPI\YzApi($demoKey, $demoToken);

// Get profile data
$responseJson = $yzApi->getProfile();

print '<pre>';
var_dump($responseJson);
print '</pre>';