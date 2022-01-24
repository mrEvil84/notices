<?php

require_once '../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


$connection = new AMQPStreamConnection('localhost', 5672, 'msgProducer', 'secret');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

echo "Write message and press ENTER:" . PHP_EOL;
$textMsg = (string)readline('');


$msg = new AMQPMessage($textMsg);
$channel->basic_publish($msg, '', 'hello');

echo " [x] Sent:  '$textMsg!'\n";

$channel->close();
$connection->close();