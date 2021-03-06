<?php

require "class-http-request.php";
define('telegram_api', "https://api.telegram.org/botTOKEN/");
$input = file_get_contents('php://input');
$updates = json_decode($input, true);


//main variables
$message = $updates['message']['text'];
$user_id = $updates['message']['from']['id'];
$chat_id = $updates['message']['chat']['id'];
$first_name = $updates['message']['from']['first_name'];
$last_name = $updates['message']['from']['last_name'];
$username = $updates['message']['from']['username'];
$chat_username = $updates['message']['chat']['username'];
$chat_type = $updates['message']['chat']['type'];
//callback (inline keyboards) variables
$cb_data = $updates['callback_query']['data'];
$cb_id = $updates["callback_query"]["id"];
$cb_msg_id = $updates["callback_query"]["message"]["message_id"];
$cb_chat_id = $updates["callback_query"]["message"]["chat"]["id"];
$cb_user_id = $updates["callback_query"]["from"]["id"];
$cb_first_name = $updates["callback_query"]["from"]["first_name"];
$cb_last_name = $updates["callback_query"]["from"]["last_name"];
$cb_username = $updates["callback_query"]["from"]["username"];



/*
*Use the function sendMessage() to send a message
*in the chat you want (see example on file example.php)
*/
function sendMessage($chat_id, $message_text, $keyboard = null, $parse_mode = 'HTML')
{
	$args = [
		"chat_id" => $chat_id,
		"text" => $message_text,
		"parse_mode" => $parse_mode,
		"reply_markup" => $keyboard,
		"disable_web_page_preview" => true
	];
	$r = new HttpRequest("get", telegram_api."sendMessage", $args);
}

//answerCallbackQuery (an alert text)
function answerCallbackQuery($cb_id, $alert_text, $show_alert = false)
{
	$args = [
		"callback_query_id" => $cb_id,
		"text" => $alert_text,
		"show_alert" => $show_alert
	];
	$r = new HttpRequest("get", telegram_api."answerCallbackQuery", $args);
}

//editMessageText
function editMessageText($chat_id, $message_id, $text,  $keyboard = null, $parse_mode = 'HTML')
{
	$args = [
		"chat_id" => $chat_id,
		"message_id" => $message_id,
		"text" => $text,
		"parse_mode" => $parse_mode,
		"reply_markup" => $keyboard
	];
	$r = new HttpRequest("get", telegram_api."editMessageText", $args);
}

/*
*sendChatAction 
*Available action (must be a string) :
*typing, upload_photo, record_video, upload_video, record_audio, upload_audio, upload_document, find_location
*/
function sendChatAction($chat_id, $action)
{
	$args = [
		"chat_id" => $chat_id,
		"action" => $action
	];
	$r = new HttpRequest("get", telegram_api."sendChatAction", $args);
}

//getChatAdministrator
function getChatAdministrators($chat_id){
	$args = [
		'chat_id' => $chat_id
	];
	$request = new HttpRequest("get", telegram_api."getChatAdministrators", $args);
	$result = $request->getResponse();
	$admins = json_decode($result, true);
	$text = "Group's staff:";
	foreach($admins[result] as $admins_list)
	{
		if($admins_list[status] == "creator")
		{
			$text .= "
			@".$admins_list[user][username]." [Creator]";
		}else{
			$text .= "
			@".$admins_list[user][username];
		}
	}
	sendMessage($chat_id, $text);
}


?>
