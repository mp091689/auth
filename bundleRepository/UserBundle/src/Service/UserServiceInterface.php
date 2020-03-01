<?php
declare(strict_types=1);

namespace mp091689\UserBundle\Service;

use mp091689\UserBundle\Entity\User;
use mp091689\UserBundle\Exception\UserInvalidException;

/**
 * Interface UserServiceInterface
 */
interface UserServiceInterface
{
    /**
     * Register new user with provided data
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $nickName
     * @param int    $age
     * @param string $password
     *
     * @return User
     * @throws UserInvalidException
     */
    public function register(string $firstName, string $lastName, string $nickName, int $age, string $password): User;

    /**
     * Log in user with provided nickName and password
     *
     * @param string $nickName
     * @param string $password
     *
     * @return bool
     */
    public function login(string $nickName, string $password): bool;
}
