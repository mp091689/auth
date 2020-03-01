<?php
declare(strict_types=1);

namespace mp091689\UserBundle\Service;

use mp091689\UserBundle\Entity\User;
use mp091689\UserBundle\Exception\UserInvalidException;
use mp091689\UserBundle\Repository\UserRepository;
use RuntimeException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class UserService
 */
class UserService implements UserServiceInterface
{
    private UserRepository $userRepository;

    private ValidatorInterface $validator;

    public function __construct(UserRepository $userRepository, ValidatorInterface $validator)
    {
        $this->userRepository = $userRepository;
        $this->validator = $validator;
    }

    /**
     * @inheritDoc
     */
    public function register(string $firstName, string $lastName, string $nickName, int $age, string $password): User
    {
        $user = new User();
        $user->firstName = $firstName;
        $user->lastName = $lastName;
        $user->nickName = $nickName;
        $user->age = $age;
        $user->password = $password;

        $errors = $this->validator->validate($user);
        if (count($errors) > 0) {
            throw new UserInvalidException((string)$errors);
        }

        $user->password = md5($password);

        if (!$this->userRepository->save($user)) {
            throw new RuntimeException('Some sing went wrong, user was not saved');
        }

        return $user;
    }

    /**
     * @inheritDoc
     */
    public function login(string $nickName, string $password): bool
    {
        $user = $this->userRepository->findByNickName($nickName);
        if ($user === null) {
            return false;
        }

        if ($user->password !== md5($password)) {
            return false;
        }

        return true;
    }
}
