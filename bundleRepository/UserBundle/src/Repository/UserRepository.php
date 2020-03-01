<?php
declare(strict_types=1);

namespace mp091689\UserBundle\Repository;

use mp091689\UserBundle\Entity\User;

/**
 * Class User
 *
 * The repository class provides functionality to work with users data such as find, save etc..
 *
 * @package Mykyta\UserBundle\Repository
 */
class UserRepository
{
    const STORAGE_PATH = __DIR__ . '/../../storage/';

    private string $storageName;

    public function __construct(string $storageName = 'users.json')
    {
        $this->storageName = $storageName;
    }

    /**
     * Find user with provided nickName
     *
     * @param string $nickName
     *
     * @return User|null
     */
    public function findByNickName(string $nickName): ?User
    {
        if (!file_exists($this->getFullStoragePath())) {
            return null;
        }

        $users = json_decode(file_get_contents($this->getFullStoragePath()), true);
        foreach ($users as $user) {
            if ($user['nickName'] === $nickName) {
                return new User($user);
            }
        }

        return null;
    }

    /**
     * Get glued storage path with storage name
     *
     * @return string
     */
    public function getFullStoragePath(): string
    {
        return self::STORAGE_PATH . $this->storageName;
    }

    /**
     * Write user data to the storage json file
     *
     * @param User $user
     *
     * @return bool
     */
    public function save(User $user): bool
    {
        $content[] = (array)$user;
        if (file_exists($this->getFullStoragePath())) {
            $fileContent = json_decode(file_get_contents($this->getFullStoragePath()), true);
            $content = array_merge($content, $fileContent);
        }

        return (bool)file_put_contents($this->getFullStoragePath(), json_encode($content), LOCK_EX);
    }
}
