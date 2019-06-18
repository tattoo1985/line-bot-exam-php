<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
$channel_token =
'S7HZEX5LLMnX8k+/JiGZ+Coh0kBBX35vNDPUnXziWi5JFRxXq1xsRL2cgKDgpMxyw2/7c6zTAoIjssHVwY8sYkA5kOtKDbsXvlgDO3UZqlNFCaeduhjO7tgoY96bk7s4G1YJ3r6NnRZ3gv3Yt6fNJQdB04t89/1O/w1cDnyilFU=';
$channel_secret = '078a5fe04f800b4cbd40150f4c8fd1b9';
// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);
if (!is_null($events['events'])) {
// Loop through each event
foreach ($events['events'] as $event) {
// Line API send a lot of event type, we interested in message only.
if ($event['type'] == 'message') {
switch($event['message']['type']) {
case 'text':
// Get replyToken
$replyToken = $event['replyToken'];
// Reply message
$respMessage = 'Hello, your message is '. $event['message']['text'];
$httpClient = new CurlHTTPClient($channel_token);
$bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
$textMessageBuilder = new TextMessageBuilder($respMessage);
$response = $bot->replyMessage($replyToken, $textMessageBuilder);
break;
}
}
}
}
echo "OK"
