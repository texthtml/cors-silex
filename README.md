# CORS-Silex

 Cross-site HTTP requests middleware for [Silex](http://silex.sensiolabs.org/)

[![Latest Stable Version](https://poser.pugx.org/texthtml/cors-silex/v/stable.svg)](https://packagist.org/packages/texthtml/cors-silex)
[![License](https://poser.pugx.org/texthtml/cors-silex/license.svg)](https://packagist.org/packages/texthtml/cors-silex)
[![Total Downloads](https://poser.pugx.org/texthtml/cors-silex/downloads.svg)](https://packagist.org/packages/texthtml/cors-silex)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/texthtml/cors-silex/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/texthtml/cors-silex/?branch=master)

## Module installation

In your project root folder

1. `composer require texthtml/cors-silex`
2. In your Silex container configuration, register the CORSMiddleware:

```php
$app->register(new TH\Silex\CORS\CORSProvider);
```
