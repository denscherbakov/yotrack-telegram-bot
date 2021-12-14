<?php

use App\models\Message;
use App\models\User;
use App\TelegramService;
use App\YoutrackService;
use App\DbService;

require_once __DIR__ . '/vendor/autoload.php';

$config = require_once __DIR__ . '/src/config/config.php';
$routes = require_once __DIR__ . '/src/config/routes.php';

$dbService = new DbService();
$dbService->connect($config);

$telegramService = new TelegramService($config);
$chatID = $telegramService->getChatID($telegramService->getUpdates());

$youtrackService = new YoutrackService($config, $routes);
$youtrackUser = $youtrackService->getCurrentUserData();
$user = User::firstOrCreate(['chat_id' => $chatID, 'youtrack_id' => $youtrackUser['id']]);

$tasks = $youtrackService->getIssues($youtrackUser);

foreach ($tasks as $task)
{
	$message = Message::where('task_id', $task['id'])->first();

	if (!$message->task_id)
	{
		$message = new Message();
		$message->task_id = $task['id'];
		$message->task_short_name = $task['project']['shortName'];
		$message->task_number_in_project = $task['numberInProject'];
		$message->task_updated_at = $task['updated'];
		$message->save();
	}

	if ($task['updated'] > $message->task_updated_at)
	{
		$telegramService->sendMessage($user->chat_id,
			$config['youtrack']['url'] . 'issue/' . $message['task_short_name'].'-'.$message['task_number_in_project']
		);

		$message->task_updated_at = $task['updated'];
		$message->save();
	}
}