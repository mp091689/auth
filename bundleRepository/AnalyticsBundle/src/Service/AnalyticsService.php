<?php
declare(strict_types=1);

namespace mp091689\AnalyticsBundle\Service;

use SocialTech\StorageInterface;

/**
 * Class AnalyticsService
 */
class AnalyticsService implements AnalyticsServiceInterface
{

    private StorageInterface $storage;

    private string $fullStoragePath = __DIR__ . '/../../storage/logs.json';

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @inheritDoc
     */
    public function log(int $idUser, string $sourceLabel, \DateTime $dateCreated, string $ipUser): void
    {
        $logs = $this->getLogs();
        $content = [
            'id'           => count($logs) + 1,
            'id_user'      => $idUser,
            'source_label' => $sourceLabel,
            'date_created' => $dateCreated->format('Y-m-d H:i:s'),
            'ip_user'      => $ipUser,
        ];
        $logs[] = $content;
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
}
