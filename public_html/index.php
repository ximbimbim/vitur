<?php
defined( 'YII_DEBUG' ) or define( 'YII_DEBUG', true );
defined( 'YII_ENV' ) or define( 'YII_ENV', 'dev' );

// Configura autoload e bootstrap
require( dirname(__DIR__).'/vendor/autoload.php' );
require( dirname(__DIR__).'/vendor/yiisoft/yii2/Yii.php' );
require( dirname(__DIR__).'/app/config/bootstrap.php' );

// Carrega configuração
$config = require( dirname(__DIR__).'/app/config/config.php' );

// Inicia applicação
$application = new yii\web\Application( $config );
$application->run();