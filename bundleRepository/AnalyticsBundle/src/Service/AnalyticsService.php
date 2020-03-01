<?php
declare(strict_types=1);

namespace mp091689\AnalyticsBundle\Service;

use mp091689\AnalyticsBundle\Dto\AnalyticsTdo;
use mp091689\AnalyticsBundle\Producer\AnalyticsProducer;
use SocialTech\StorageInterface;

/**
 * Class AnalyticsService
 */
class AnalyticsService implements AnalyticsServiceInterface
{

    private StorageInterface $storage;

    private AnalyticsProducer $producer;

    private string $fullStoragePath = __DIR__ . '/../../storage/logs.json';

    /**
     * AnalyticsService constructor.
     *
     * @param AnalyticsProducer $producer
     * @param StorageInterface  $storage
     */
    public function __construct(StorageInterface $storage, AnalyticsProducer $producer)
    {
        $this->storage = $storage;
        $this->producer = $producer;
    }

    /**
     * @inheritDoc
     */
    public function log(int $idUser, string $sourceLabel, \DateTime $createdAt, string $ipUser): void
    {
        $analyticsDto = new AnalyticsTdo();
        $analyticsDto->userId = $idUser;
        $analyticsDto->sourceLabel = $sourceLabel;
        $analyticsDto->createdAt = $createdAt;
        $analyticsDto->userIp = $ipUser;

        $this->producer->publish(serialize($analyticsDto));
    }

    public function save(string $body)
    {
        /** @var AnalyticsTdo $analyticsDto */
        $analyticsDto = unserialize($body);
        $logs = $this->getLogs();
        $analyticsDto->id = count($logs) + 1;
        $logs[] = $this->formatToStorage($analyticsDto);
        $this->storage->store($this->fullStoragePath, json_encode($logs));
    }

    /**
     * Get logs from the storage
     *
     * @return array
     */
    private function getLogs(): array
    {
        if (!$this->storage->exists($this->fullStoragePath)) {
            return [];
        }

        return json_decode($this->storage->load($this->fullStoragePath), true);
    }

    private function formatToStorage(AnalyticsTdo $analyticsDto): array
    {
        return [
            'id'           => $analyticsDto->id,
            'id_user'      => $analyticsDto->userId,
            'source_label' => $analyticsDto->sourceLabel,
            'date_created' => $analyticsDto->createdAt->format('Y-m-d H:i:s'),
            'ip_user'      => $analyticsDto->userIp,
        ];
    }
}
