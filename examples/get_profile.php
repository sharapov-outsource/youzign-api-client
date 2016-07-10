<?php
/**
 * Yourzign API client
 * (c) Alexander Sharapov <alexander@sharapov.biz>
 * http://sharapov.biz/
 */

require_once dirname(__FILE__) . '/../vendor/autoload.php';

// Demo credentials. You should get real credentials in your Youzign profile
$demoKey = '5077d4ed60da38255c2c71421ddac36f';
$demoToken = '55f772fcdae50ce0caee3986112621a3';

try {
  $yzApi = new \Sharapov\YouzignAPI\YzApi($demoKey, $demoToken);

  // Get designs list
  $responseJson = $yzApi->getProfile();

  print '<pre>';
  print_r($responseJson);
  print '</pre>';
} catch (\Exception $e) {
  // Print error
  print $e->getMessage();
}