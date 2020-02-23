<?php
declare(strict_types=1);

namespace mp091689\UserBundle\Tests;

use mp091689\UserBundle\Repository\UserRepository;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Get prepared for tests user repository
     *
     * @return UserRepository
     */
    protected function getUserRepository(): UserRepository
    {
        return new UserRepository('test_users.json');
    }

    /**
     * Remove test file storage
     *
     * @return void
     */
    protected function clearStorage(): void
    {
        $repository = $this->getUserRepository();
        if (file_exists($repository->getFullStoragePath())) {
            unlink($repository->getFullStoragePath());
        }
    }

    /**
     * @inheritDoc
     */
    protected function tearDown(): void
    {
        $this->clearStorage();
    }
}
