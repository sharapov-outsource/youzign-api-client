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

After that, the class is available under `YouzignAPI\YzApi` namespace

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

$yzApi = new \YouzignAPI\YzApi($demoKey, $demoToken);

// Get profile data
$responseJson = $yzApi->getProfile();

print '<pre>';
var_dump($responseJson);
print '</pre>';
```

Get designs list
----------------

```php
require_once dirname(__FILE__) . '/../vendor/autoload.php';

// Demo credentials. You should get real credentials in your Youzign profile
$demoKey = '5077d4ed60da38255c2c71421ddac36f';
$demoToken = '55f772fcdae50ce0caee3986112621a3';

$yzApi = new \YouzignAPI\YzApi($demoKey, $demoToken);

// Get designs list
$responseJson = $yzApi->getDesigns();

print '<pre>';
var_dump($responseJson);
print '</pre>';
```


Changelog
=========
1.0 Stable version with basic functionality.

1.1 Added factory service.

1.1.1 Changed chart loading via factory a bit (see class annotations).

1.1.2 Updated service class with Exception handling regarding missing / wrong class name.

1.1.3 The file with classes' constants is now loaded via Composer (thanks to ThaDafinser).

1.1.4 Fixed code-breaking typ (thanks to subtronic).

1.1.5 Added an option to hide the X axis or only it's values (thanks to julien-gm).

1.1.6 Added support for closures in formatting scale (thanks to funkjedi)

2.0 Updated all classes to PSR-2 standard, added typehinting where possible, updated
    annotations in methods to be as accurate as possible. Added Behat testing and
    restructed the namespaces into more sensible structure.

Links
=====
[Youzign Homepage](https://youzign.com/)

[Youzign Api manual](https://youzign.readme.io/)

[Composer](https://getcomposer.org/)

[GitHub](https://github.com/sharapovweb/youzign-api-client)

[Packagist](https://packagist.org/packages/sharapov/youzign-api-client)