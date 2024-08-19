<?php

declare(strict_types=1);

namespace App\Module\TrainerSubscriptionPurchase\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Module\Common\Controller\Base\AbstractController;
use App\Module\TrainerSubscriptionPurchase\Entity\TrainerSubscriptionPurchase;
use App\Module\TrainerSubscriptionPurchase\Services\CreateTrainerSubscriptionPurchaseService;
use App\Module\User\Component\CurrentUser;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class CreateTrainerSubscriptionPurchaseAction
 *
 * CreateTrainerSubscriptionPurchaseAction
 *
 * @package App\Module\TrainerSubscriptionPurchase\Controller
 */
class CreateTrainerSubscriptionPurchaseAction extends AbstractController
{
    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        CurrentUser $currentUser,
        private CreateTrainerSubscriptionPurchaseService $service
    ) {
        parent::__construct($serializer, $validator, $currentUser);
    }

    public function __invoke(TrainerSubscriptionPurchase $data): TrainerSubscriptionPurchase
    {
        $this->validate($data);
        return ($this->service)($data);
    }
}
