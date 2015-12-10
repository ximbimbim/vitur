<?php
use yii\rest\UrlRule;
// Configura aplicação
$config = [ 
	'id' => 'vtr-app',
	'basePath' => dirname ( __DIR__ ),
	'vendorPath' => dirname ( dirname ( __DIR__ ) ) . '/vendor',
	'bootstrap' => [ 
		'log' 
	],
	'controllerNamespace' => 'app\controllers',
	'modules' => [
		'admin' => [
			'class' => 'app\modules\Admin',
		],
		'rest' => [
			'class' => 'app\modules\Rest',
		],
	],
	'components' => [ 
		'i18n' => [
			'translations' => [
				'app*' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/i18n',
					'sourceLanguage' => 'en-US',
					'fileMap' => [
						'app' => 'app.php',
					],
				],
			],
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'enableStrictParsing' => false,
			'rules' => [
				'/' 			  => 'site/index',
				'/admin'		  => 'admin/default/index',
				'/admin/<action>' => 'admin/default/<action>',
				'/<action>' 	  => 'site/<action>',
					
				// REST
				'PUT,PATCH /v0/<c>/<id>' => 'rest/<c>/update',
				'GET,HEAD /v0/<c>/<id>'  => 'rest/<c>/view',
				'DELETE /v0/<c>/<id>' 	 => 'rest/<c>/delete',
				'POST /v0/<c>s' 		 => 'rest/<c>/create',
				'GET,HEAD /v0/<c>s'  	 => 'rest/<c>/index',
				'/v0/<c>s/<id>'  	 	 => 'rest/<c>/options',
				'/v0/<c>s'  	 		 => 'rest/<c>/options',
			]
		],
		'request' => [ 
			'cookieValidationKey' => '0MgdIuVoKk-qio5CB1xpEyDc4pjcS8Rc'
		],
		'cache' => [ 
			'class' => 'yii\caching\FileCache' 
		],
		'db' => [ 
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=vtr-app',
			'username' => 'root',
			'password' => 'v1t0r4gp',
			'charset' => 'utf8' 
		],
		'mailer' => [ 
			'class' => 'yii\swiftmailer\Mailer',
			'viewPath' => '@app/mail',
			// send all mails to a file by default. You have to set
			// 'useFileTransport' to false and configure a transport
			// for the mailer to send real emails.
			'useFileTransport' => true 
		],
		'user' => [ 
			'identityClass' => 'yii\web\User',
			'enableAutoLogin' => true 
		],
		'log' => [ 
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [ 
				[ 
					'class' => 'yii\log\FileTarget',
					'levels' => [ 
						'error',
						'warning' 
					] 
				] 
			] 
		],
		'errorHandler' => [ 
			'errorAction' => 'site/error' 
		] 
	],
	'params' => [ 
		'adminEmail' => 'admin@example.com',
		'supportEmail' => 'support@example.com',
		'user.passwordResetTokenExpire' => 3600 
	]
];

// Se for desenvolvimento carregar ferramentas de depuração e criação
if (! YII_ENV_TEST) {
	$config ['bootstrap'] [] = 'debug';
	$config ['modules'] ['debug'] = 'yii\debug\Module';
	
	$config ['bootstrap'] [] = 'gii';
	$config ['modules'] ['gii'] = 'yii\gii\Module';
}

return $config;