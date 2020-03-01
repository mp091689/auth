<?php
declare(strict_types=1);

namespace mp091689\AnalyticsBundle\Dto;

use DateTime;

class AnalyticsTdo
{
    public int $id;

    public int $userId;

    public string $sourceLabel;

    public DateTime $createdAt;

    public string $userIp;
}
