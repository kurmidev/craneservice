<?php

use yii\helpers\ArrayHelper;

$confLocal = [];

if(file_exists(__DIR__.'/db.local.php')){
    $confLocal = include 'db.local.php'; 
}

$config= [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=craneservice',
    'username' => 'root',
    'password' => 'apple',
    'charset' => 'utf8',
    'attributes' => [PDO::ATTR_CASE => PDO::CASE_LOWER],
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache'
];


return ArrayHelper::merge($config,$confLocal);
