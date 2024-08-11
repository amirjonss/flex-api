<?php

declare(strict_types=1);

namespace App\Module\User\Component;

use App\Module\Common\Component\Core\AbstractManager;
use App\Module\User\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class UserManager
 *
 * @method save(User $entity, bool $needToFlush = false): void
 * @package App\Component\User
 */
class UserManager extends AbstractManager
{
    public function __construct(
        EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordEncoder
    ) {
        parent::__construct($entityManager);
    }

    public function hashPassword(User $user, string $plainPassword): void
    {
        $user->setPassword(
            $this->passwordEncoder->hashPassword($user, $plainPassword)
        );
    }
}
