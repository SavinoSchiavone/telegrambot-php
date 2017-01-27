<?php

//replace TOKEN with your @botfather token
define('telegram_api', "https://api.telegram.org/botTOKEN/");
$input = file_get_contents('php://input');
$update = json_decode($input, true);


//main variables
$message = $update['message']['text'];
$user_id = $update['message']['from']['id'];
$chat_id = $update['message']['chat']['id'];
$first_name = $update['message']['from']['first_name'];
$last_name = $update['message']['from']['last_name'];
$username = $update['message']['from']['username'];
$chat_username = $update['message']['chat']['username'];


/*
*Use the function sendMessage to send a message
*in the chat you want (see example on file bot.php)
*/
function sendMessage($chat_id, $message_text, $keyboard = null, $parse_mode = 'HTML')
{
	file_get_contents(telegram_api."sendMessage?chat_id=$chat_id&text=$message_text&parse_mode=$parse_mode&disable_web_page_preview=true&disable_notification=false&reply_to_message_id=false&reply_markup=$keyboard");
}


?>
