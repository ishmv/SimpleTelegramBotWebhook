<?php

define("BOT_KEY", "[BOT_KEY]");
define("SECRET_KEY", "[SECRET_KEY]");


if(!isset($_GET["t"]) || $_GET["t"] != SECRET_KEY)
{
    //avoid invalid access
    echo "Error!";
    die;
}

function Send_Telegram_Message($chatId, $text)
{
	$postdata = http_build_query(
	    array(
		"text" => $text,
		"chat_id" => $chatId
	    )
	);
	$opts = array("http" =>
	    array(
		"method"  => "POST",
		"header"  => "Content-type: application/x-www-form-urlencoded",
		"content" => $postdata
	    )
	);
	$context  = stream_context_create($opts);
	$result = file_get_contents("https://api.telegram.org/bot".BOT_KEY."/sendMessage", false, $context);
}


function Send_Telegram_Message_CURL($chatId, $text)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"https://api.telegram.org/bot".BOT_KEY."/sendMessage");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"text=$text&chat_id=$chatId");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec ($ch);
	curl_close ($ch);
	return $server_output;
}

//Extract posted data
$data = json_decode(file_get_contents("php://input"));

//Find text of message
$messageText = $data->message->text;
//Find Chat id
$chatId      = $data->message->chat->id;

//Reply to Telegram: It's OK!
echo json_encode(array("ok"=> true));

//Send_Telegram_Message_CURL($chatId,$messageText);
Send_Telegram_Message($chatId,$messageText);
?>
