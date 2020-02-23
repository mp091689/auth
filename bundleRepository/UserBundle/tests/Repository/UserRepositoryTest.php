<?php
declare(strict_types=1);

namespace mp091689\UserBundle\Tests\Repository;

use mp091689\UserBundle\Entity\User;
use mp091689\UserBundle\Tests\TestCase;

/**
 * Class UserRepositoryTest
 */
class UserRepositoryTest extends TestCase
{
    public function testSaveSuccess(): void
    {
        $repository = $this->getUserRepository();

        $users = $this->getUserList();
        foreach ($users as $user) {
            $this->assertTrue($repository->save($user), 'User was not saved');
        }
        $this->assertFileExists($repository->getFullStoragePath());
        $users = json_decode(file_get_contents($repository->getFullStoragePath()), true);
        $this->assertEquals(count($users), count($users));
    }

    public function testFindByNickNameNotFound(): void
    {
        $repository = $this->getUserRepository();
        $users = $this->getUserList();
        foreach ($users as $user) {
            $repository->save($user);
        }
        $this->assertNull($repository->findByNickName('NotExistingNickName'));
    }

    public function testFindByNickName(): void
    {
        $repository = $this->getUserRepository();
        $users = $this->getUserList();
        foreach ($users as $user) {
            $repository->save($user);
        }
        foreach ($users as $user) {
            $foundUser = $repository->findByNickName($user->nickName);
            $this->assertEquals($user, $foundUser);
        }
    }

    /**
     * Get list of mocked user entities
     *
     * @return User[]
     */
    private function getUserList(): array
    {
        return [
            new User(
                [
                    'firstName' => 'John',
                    'lastName'  => 'Doe',
                    'nickName'  => 'JohnDoe',
                    'age'       => 30,
                    'password'  => md5('secret'),
                ]
            ),
            new User(
                [
                    'firstName' => 'Ralph',
                    'lastName'  => 'Roe',
                    'nickName'  => 'RalphRoe',
                    'age'       => 20,
                    'password'  => md5('qwerty'),
                ]
            ),
            new User(
                [
                    'firstName' => 'Tommy',
                    'lastName'  => 'Toe',
                    'nickName'  => 'TommyToe',
                    'age'       => 25,
                    'password'  => md5('abcdef'),
                ]
            ),
        ];
    }
}
