<?php

require_once __DIR__ . '/../../vendor/autoload.php';
$config = require_once __DIR__ . '/../../src/config/config.php';

use App\DbService;
use Illuminate\Database\Capsule\Manager as Capsule;

$dbService = new DbService();
$dbService->connect($config);

Capsule::schema()->create('messages', function ($table) {
	$table->increments('id');
	$table->string('task_id');
	$table->string('task_short_name');
	$table->integer('task_number_in_project');
	$table->string('task_updated_at');
	$table->timestamps();
});