<?php

namespace PkowerzMacwro\GitSandbox\rabbitmq\rabbitExchangesTopic;

class Settings
{
    public const QUEUE_NAME = 'task_queue';
    public const EXCHANGE_NAME = 'topic_logs';
    public const EXCHANGE_BROADCAST_TYPE = 'topic'; // rozglasza do kazdego
}