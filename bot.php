<?php

$update = json_decode(file_get_contents("php://input"));

if (isset($update->message)) {
    $message = $update->message;
    $text    = $message->text;
    $from_id = $message->from->id;
}

const API_KEY = '7364555370:AAEbam1pT_msTdepVCGroRw5ZwMEM-rtm_E';
function TelegramRequest(string $method, array $data)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.telegram.org/bot' . API_KEY . '/' . $method);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_ENCODING, '');
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);
    return json_decode($response);
}

if ($text == '/start') {
    TelegramRequest('sendMessage', [
        'chat_id' => $from_id,
        'text' => 'Hello, welcome to my bot! Send me a message to get started.'
    ]);
}
