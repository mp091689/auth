<?php
declare(strict_types=1);

namespace mp091689\AnalyticsBundle\Service;

use DateTime;

/**
 * Interface AnalyticsServiceInterface
 */
interface AnalyticsServiceInterface
{
    /**
     * Log the passed data to the storage
     *
     * @param int      $userId
     * @param string   $sourceLabel
     * @param DateTime $dateCreated
     * @param string   $ip
     */
    public function log(int $userId, string $sourceLabel, DateTime $dateCreated, string $ip): void;

    public function save(string $body);
}
