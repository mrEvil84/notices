<?php

// listen messages baes od routing key


require_once '../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PkowerzMacwro\GitSandbox\rabbitmq\rabbitExchangesTopic\Settings;



$severities = array_slice($argv, 1);
if (empty($severities)) {
    file_put_contents('php://stderr', "Usage: $argv[0] [info] [warning] [error]\n");
    exit(1);
}


class AmqpTestWorker
{
    public $consumedMessages = [];

    public function consume($severities): void
    {
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

        foreach ($severities as $severity) {
            $channel->queue_bind($queue_name, Settings::EXCHANGE_NAME, $severity);
        }



//        $process = function (AMQPMessage $msg) {
//
//            //echo ' [x] ', $msg->getRoutingKey(), ':', $msg->body, "\n";
//            $msg->ack();  // give ack to aqmp
//            $this->consumedMessages [] = $msg->body;
//        };

// set no_ack to false , should wait for ack
        $channel->basic_consume($queue_name, '', false, false, false, false, [$this, 'process']);


        while (count($channel->callbacks)) {
            echo " [*] Message processed." . PHP_EOL;
            $channel->wait();
        }



        $channel->close();
        $connection->close();
    }

    public function process(AMQPMessage $msg)
    {
        $this->consumedMessages [] = $msg->getBody();

        $file = fopen('log.txt', 'a');
        fwrite($file, $msg->getBody() . PHP_EOL);
        fclose($file);

        $msg->ack();  // give ack to aqmp
    }
}


$test = new AmqpTestWorker();
$test->consume($severities);

var_dump($test->consumedMessages);







