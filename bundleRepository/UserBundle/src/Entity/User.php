<?php
declare(strict_types=1);

namespace mp091689\UserBundle\Entity;

use mp091689\UserBundle\Validator\Constraints\UniqueUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 *
 * The representation of user entity
 *
 * @package Mykyta\UserBundle\Entity
 */
class User
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=50)
     * @Assert\Regex("/^\w+/")
     */
    public string $firstName;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=50)
     * @Assert\Regex("/^\w+/")
     */
    public string $lastName;

    /**
     * @UniqueUser
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=50)
     * @Assert\Regex("/^\w+/")
     */
    public string $nickName;

    /**
     * @Assert\NotBlank()
     * @Assert\Range(min = 14, max = 100)
     */
    public int $age;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=6, max=24)
     */
    public string $password;

    public function __construct(array $properties = [])
    {
        foreach ($properties as $key => $value) {
            if (!property_exists($this, $key)) {
                throw new \RuntimeException('Property does not exists: ' . $key);
            }

            $this->$key = $value;
        }
    }
}