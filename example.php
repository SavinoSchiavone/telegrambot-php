<?php

include("base.php");

if($message == "/start" or $cb_data == "/start"){
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

//change button and message text
if($cb_data == "button1"){
  $new_button = [
    "text" => "Another button",
    "callback_data" => "/start"
   ];
  $structure = [
    [$new_button]
    ];
  $menu = ["inline_keyboard" => $structure];
  $menu = json_encode($menu);
  cb_reply($cb_id, "alert text", true, $cb_msg_id, "Another awesome button", $menu);
}
