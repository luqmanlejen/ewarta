<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('booster', dirname(__FILE__) . DIRECTORY_SEPARATOR . '../extensions/yiibooster');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'theme' => 'public',
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => "e-Federal Gazette Official Portal",
    'defaultController' => 'portal/index',
    // preloading 'log' component
    'preload' => array('log', 'booster'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
        // If removed, Gii defaults to localhost only. Edit carefully to taste.
//			'ipFilters'=>array('127.0.0.1','::1', '192.168.0.*'),
        //'ipFilters' => array('127.0.0.1', '10.17.14.232', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        /*
          'urlManager'=>array(
          'urlFormat'=>'path',
          'rules'=>array(
          '<controller:\w+>/<id:\d+>'=>'<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
          '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
          ),
          ),
         */
//		'db'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=192.168.0.22;dbname=ewarta',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '[ost@vm]',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'portal/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
        'booster' => array(
            'class' => 'ext.yiibooster.components.Booster',
            'responsiveCss' => true,
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);
