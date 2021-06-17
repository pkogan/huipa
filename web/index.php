<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

//$_SERVER['HTTPS']='on';
/*ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);*/
// Notificar todos los errores de PHP


session_save_path (__DIR__ . '/../tmp' );

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
