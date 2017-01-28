<?php


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
//callback (inline keyboards) variables
$cb_data = $updates['callback_query']['data'];
$cb_id = $update["callback_query"]["id"];
$cb_msg_id = $update["callback_query"]["message"]["message_id"];
$cb_chat_id = $update["callback_query"]["message"]["chat"]["id"];
$cb_user_id = $update["callback_query"]["from"]["id"];
$cb_first_name = $update["callback_query"]["from"]["first_name"];
$cb_last_name = $update["callback_query"]["from"]["last_name"];
$cb_username = $update["callback_query"]["from"]["username"];



/*
*Use the function sendMessage() to send a message
*in the chat you want (see example on file example.php)
*/
function sendMessage($chat_id, $message_text, $keyboard = null, $parse_mode = 'HTML')
{
	file_get_contents(telegram_api."sendMessage?chat_id=".urlencode($chat_id)."&text=".urlencode($message_text)."&parse_mode=".urlencode($parse_mode)."&disable_web_page_preview=true&disable_notification=false&reply_to_message_id=false&reply_markup=".urlencode($keyboard));
}

/*
*Use the function cb_reply() to edit a message when
*an inline button is pressed (see example on file example.php)
*/
function cb_reply($cb_id, $alert_text, $show_alert = false, $cb_msg_id = false, $new_message_text = false, $new_menu = false)
{
	global $cb_chat_id;

	file_get_contents(telegram_api."answerCallbackQuery?callback_query_id=$cb_id&text=$alert_text&show_alert=$show_alert");

	if($cb_msg_id)
	{
		if($new_menu)
		{
			
			$rm = ['inline_keyboard' => $new_menu];
			$reply_markup = json_encode($rm);
		
		}
		if ($new_menu) {
			file_get_contents(telegram_api."editMessageText?chat_id=$cb_chat_id&message_id=$cb_msg_id&text=$new_message_text&reply_markup=$reply_markup");
		}else{
			file_get_contents(telegram_api."editMessageText?chat_id=$cb_chat_id&message_id=$cb_msg_id&text=$new_message_text");
		}
	}
}


?>
