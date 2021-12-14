<?php

require_once __DIR__ . '/../../vendor/autoload.php';
$config = require_once __DIR__ . '/../../src/config/config.php';

use App\DbService;
use Illuminate\Database\Capsule\Manager as Capsule;

$dbService = new DbService();
$dbService->connect($config);

Capsule::schema()->create('users', function ($table) {
	$table->increments('id');
	$table->integer('chat_id')->unique();
	$table->string('youtrack_id')->unique();
	$table->timestamps();
});