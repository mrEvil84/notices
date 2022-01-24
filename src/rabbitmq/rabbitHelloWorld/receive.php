<?php

require_once '../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


$connection = new AMQPStreamConnection('localhost', 5672, 'msgConsumer', 'secret');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C" . PHP_EOL;

$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
};

$channel->basic_consume('hello', '', false, true, false, false, $callback);

while ($channel->is_open()) {
    $channel->wait();
}