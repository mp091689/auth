<?php
declare(strict_types=1);

namespace mp091689\AnalyticsBundle\Consumer;

use mp091689\AnalyticsBundle\Service\AnalyticsServiceInterface;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class LogSenderConsumer
 */
class AnalyticsConsumer implements ConsumerInterface
{
    private AnalyticsServiceInterface $analyticsService;

    public function __construct(AnalyticsServiceInterface $analyticsService)
    {
        $this->analyticsService = $analyticsService;
    }

    /**
     * @inheritDoc
     */
    public function execute(AMQPMessage $msg): void
    {
        $this->analyticsService->save($msg->body);
        echo 'Analytics data was saved' . PHP_EOL;
    }
}
