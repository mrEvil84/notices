<?php

require_once '../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PkowerzMacwro\GitSandbox\rabbitmq\rabbitWorkQueues\Settings;

$connection = new AMQPStreamConnection('localhost', 5672, 'msgConsumer', 'secret');
$channel = $connection->channel();

// rownomierne rodzielanie zadan pomiedzy workery

$channel->basic_qos(null, 1, null);

$channel->queue_declare(Settings::QUEUE_NAME, false, true, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C" . PHP_EOL;

$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
    $msg->ack();  // give ack to aqmp
};

// set no_ack to false , should wait for ack
$channel->basic_consume(Settings::QUEUE_NAME, '', false, false, false, false, $callback);




while ($channel->is_open()) {
    //sleep(1);
    $channel->wait();
}


$channel->close();
$connection->close();
