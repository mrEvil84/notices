<?php

require_once '../../../vendor/autoload.php';


use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PkowerzMacwro\GitSandbox\rabbitmq\rabbitExchangesTopic\Settings;

$connection = new AMQPStreamConnection('localhost', 5672, 'msgProducer', 'secret');
$channel = $connection->channel();

$channel->exchange_declare(
    Settings::EXCHANGE_NAME,
    Settings::EXCHANGE_BROADCAST_TYPE,
    false,
    true,
    false
);


echo "Write message and press ENTER:" . PHP_EOL;
$textMsg = (string)readline('');


// origin

echo "Write origin: [anonymous,sys,server,kernel]" . PHP_EOL;
$origin = (string)readline('');
$acceptedOrigin = ['anonymous','sys','server','kernel'];

while (!in_array($origin, $acceptedOrigin)) {
    echo "Write severity: [anonymous,sys,server,kernel]" . PHP_EOL;
    $origin = (string)readline('');
}


// severity
echo "Write severity: [error,info,warning]" . PHP_EOL;
$severity = (string)readline('');
$acceptedSeverity = ['error', 'info', 'warning'];

while (!in_array($severity, $acceptedSeverity)) {
    echo "Write severity: [error,info,warning]" . PHP_EOL;
    $severity = (string)readline('');
}

$routingKey = $origin . '.' . $severity;




for ($i = 0; $i < 10000; $i++) {
    $msg = new AMQPMessage(
        json_encode(['id' => $i, 'msg' => $textMsg], JSON_THROW_ON_ERROR),
        ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT] // oznacza ze wiadomosc nie zniknie podczas wylozenia sie kolejki lub amqp
    );

    $channel->basic_publish(
        $msg,
        Settings::EXCHANGE_NAME,
        $routingKey
    );
    echo " [$i] Sent: $routingKey,  '$textMsg!'" . PHP_EOL;
}


$channel->close();
$connection->close();
