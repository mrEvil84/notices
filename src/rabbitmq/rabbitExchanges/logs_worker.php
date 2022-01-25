<?php

require_once '../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PkowerzMacwro\GitSandbox\rabbitmq\rabbitWorkQueues\Settings;

$connection = new AMQPStreamConnection('localhost', 5672, 'msgConsumer', 'secret');
$channel = $connection->channel();


$channel->exchange_declare(
    Settings::EXCHANGE_NAME,
    Settings::EXCHANGE_BROADCAST_TYPE,
    false,
    true,
    false
);

list($queue_name, ,) = $channel->queue_declare("", false, true, true, false); // utworzenie losowej nazwy kolejki zeby podlaczyc sie do brokera

$channel->queue_bind($queue_name, Settings::EXCHANGE_NAME);

echo " [*] Waiting for messages. To exit press CTRL+C" . PHP_EOL;

$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
    $msg->ack();  // give ack to aqmp
};

// set no_ack to false , should wait for ack
$channel->basic_consume($queue_name, '', false, false, false, false, $callback);




while ($channel->is_open()) {
    //sleep(1);
    $channel->wait();
}


$channel->close();
$connection->close();
