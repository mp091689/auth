<?php
declare(strict_types=1);

namespace mp091689\UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueUser extends Constraint
{
    public string $message = 'Nickname already exists: {{ value }}';
}