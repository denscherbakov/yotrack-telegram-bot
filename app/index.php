<?php

use App\TelegramService;
use App\YoutrackService;
use TelegramBot\Api\BotApi;

require_once __DIR__ . '/vendor/autoload.php';

$config = require_once __DIR__ . '/src/config/config.php';
$routes = require_once __DIR__ . '/src/config/routes.php';

/*use App\DbService;
DbService::connect();*/

$youtrackService = new YoutrackService($config, $routes);
$result = $youtrackService->getCurrentUserID();

$telegramService = new TelegramService($config);
$res = $telegramService->getUpdates();
$chatID = $telegramService->getChatID($res);

$bot = new BotApi($config['telegram']['token']);
$bot->sendMessage($chatID, $result);
//var_dump($result);die;
