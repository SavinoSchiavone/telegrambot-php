<?php

include("base.php");

if($message == "/start"){
  sendChatAction($chat_id, "typing");
  sendMessage($chat_id, "Hello! Welcome to the bot.");
}

//message with an inline keyboard
if($message == "/inlinek"){
  $button1 = [
      "text" => "Button text",
      "callback_data" => "button1"
   ];
  $structure = [
    [$button1]
    ];
  $menu = ["inline_keyboard" => $structure];
  $menu = json_encode($menu);
  sendMessage($chat_id, "Message with inline keyboard", $menu);
  //I have to improve inline keyboard use, to do more easy
}

if($cb_data == "button1"){
  $another_button = [
      "text" => "Another awesome button",
      "url" => "https://github.com/SavinoSchiavone/telegrambot-php"
  ];
  $structure = [
    [$another_button]
  ];
  $menu = ["inline_keyboard" => $structure];
  $menu = json_encode($menu);
  answerCallbackQuery($cb_id, "alert message", true);
  editMessageText($cb_chat_id, $cb_msg_id, "Edited message", $menu);
}

if($message == "/admins" && ($chat_type == "group" or $chat_type == "supergroup")){
  getChatAdministrators($chat_id);
}
