<?php

declare(strict_types=1);

namespace App\Module\Trainer\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Module\Common\Controller\Base\AbstractController;
use App\Module\Trainer\Entity\Trainer;
use App\Module\Trainer\Service\CreateTrainerService;
use App\Module\User\Component\CurrentUser;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class CreateTrainerAction
 *
 * CreateTrainerAction
 *
 * @package App\Module\Trainer\Controller
 */
class CreateTrainerAction extends AbstractController
{
    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        CurrentUser $currentUser,
        private CreateTrainerService $createTrainerService,
    ) {
        parent::__construct($serializer, $validator, $currentUser);
    }

    public function __invoke(Trainer $data): Trainer
    {
        return ($this->createTrainerService)($data);
    }
}
