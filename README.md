# youzign-api-client
A PHP client for the Youzign API (http://www.youzign.com/)

Installation (via Composer):
============================

For composer installation, add:

```json
"require": {
    "sharapov/youzign-api-client": "dev-master"
},
```

to your composer.json file and update your dependencies. Or you can run:

```sh
$ composer require sharapov/youzign-api-client
```

in your project directory, where the composer.json file is.

After that, the class is available under `\Sharapov\YouzignAPI` namespace

Usage:
======

Now you can autoload or use the class via its namespace. Below are examples of how to use the library.

Get profile data
----------------

```php
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
```

Get designs list
----------------

```php
require_once dirname(__FILE__) . '/../vendor/autoload.php';

// Demo credentials. You should get real credentials in your Youzign profile
$demoKey = '5077d4ed60da38255c2c71421ddac36f';
$demoToken = '55f772fcdae50ce0caee3986112621a3';

try {
  $yzApi = new \Sharapov\YouzignAPI\YzApi($demoKey, $demoToken);

  // Get designs list
  $responseJson = $yzApi->getDesigns();

  print '<pre>';
  print_r($responseJson);
  print '</pre>';
} catch (\Exception $e) {
  // Print error
  print $e->getMessage();
}
```


Changelog
=========

20 March 2016 - v1.0

Links
=====
[Youzign Homepage](https://youzign.com/)

[Youzign Api manual](https://youzign.readme.io/)

[Composer](https://getcomposer.org/)

[GitHub](https://github.com/sharapov-outsource/youzign-api-client)

[Packagist](https://packagist.org/packages/sharapov/youzign-api-client)
