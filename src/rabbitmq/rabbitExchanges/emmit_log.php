<?php

require_once '../../../vendor/autoload.php';


use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PkowerzMacwro\GitSandbox\rabbitmq\rabbitExchanges\Settings;

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


for ($i = 0; $i < 10000; $i++) {
    $msg = new AMQPMessage(
        json_encode(['id' => $i, 'msg' => $textMsg], JSON_THROW_ON_ERROR),
        ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT] // oznacza ze wiadomosc nie zniknie podczas wylozenia sie kolejki lub amqp
    );

    $channel->basic_publish(
        $msg,
        Settings::EXCHANGE_NAME
    );
    echo " [$i] Sent:  '$textMsg!'" . PHP_EOL;
}


$channel->close();
$connection->close();
