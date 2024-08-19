<?php

declare(strict_types=1);

namespace App\Module\Trainer\Component;

use App\Module\Gym\Entity\Gym;
use App\Module\Trainer\Entity\Trainer;
use App\Module\User\Entity\User;

/**
 * Class TrainerFactory
 *
 * TrainerFactory
 *
 * @package App\Module\Trainer\Component
 */
class TrainerFactory
{
    public function create(
        Gym $gym,
        User $user,
        string $firstName,
        string $specialization,
        string $lastName = null
    ): Trainer {
        $trainer = new Trainer();
        $trainer->setGym($gym);
        $trainer->setUser($user);
        $trainer->setFirstName($firstName);
        $trainer->setLastName($lastName);
        $trainer->setSpecialization($specialization);

        return $trainer;
    }
}
