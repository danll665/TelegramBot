<?php
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Request;
require 'vendor/autoload.php';

$bot_api_key  = '5130660985:AAEq7LDGjxbeBDoreEnPoltPEVCX7NSRfHw';
$bot_username = 'FreyaRogue_bot';


try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
    while (true){
    $telegram->useGetUpdatesWithoutDatabase();
    $telegram->handleGetUpdates();
        $telegram->setUpdateFilter(function (Update $update, Telegram $telegram, &$reason = 'Update denied by update_filter') {
            $user_id = $update->getMessage()->getFrom()->getId();
            $chat_id = $update->getMessage()->getChat()->getId();
            if ($user_id === 428) {
                return true;
            }
            $reason = "Invalid user with ID {$user_id}";

            $result = Request::sendMessage([
                'chat_id' => $chat_id,
                'text'    => 'Hello!',
            ]);
        });

    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // log telegram errors
   // echo $e->getMessage();
}