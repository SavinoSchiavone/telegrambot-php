<?php

include("base.php");

if($message == "/start"){
  sendMessage($chat_id, "Hello! Welcome to the bot.");
}

//message with an inline keyboard
if($message == "/inlinek"){
  $button1 = [
    [
      "text" => "Botton text",
      "callback_data" => "callback_data"
    ]
   ];
  $structure = [
    [$button1]
    ];
  $menu = ["inline_keyboard" => $structure];
  $menu = json_encode($menu);
  sendMessage($chat_id, "Message with inline keyboard", $menu);
  //I have to improve inline keyboard use, to do more easy
}
