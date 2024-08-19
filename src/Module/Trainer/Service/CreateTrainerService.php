<?php

declare(strict_types=1);

namespace App\Module\Trainer\Service;

use App\Module\Trainer\Component\TrainerFactory;
use App\Module\Trainer\Component\TrainerManager;
use App\Module\Trainer\Entity\Trainer;
use App\Module\User\Component\UserManager;

/**
 * Class CreateTrainerService
 *
 * CreateTrainerService
 *
 * @package App\Module\Trainer\Service
 */
readonly class CreateTrainerService
{
    public function __construct(
        private TrainerFactory $trainerFactory,
        private TrainerManager $trainerManager
    ) {
    }

    public function __invoke(Trainer $data): Trainer
    {
        $trainer = $this->trainerFactory->create(
            $data->getGym(),
            $data->getUser(),
            $data->getSpecialization(),
            $data->getFirstName(),
            $data->getLastName(),
        );

        $this->trainerManager->save($trainer, true);

        return $trainer;
    }
}
