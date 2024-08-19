<?php

declare(strict_types=1);

namespace App\Module\GymSubscriptionPurchase\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Module\Common\Controller\Base\AbstractController;
use App\Module\GymSubscriptionPurchase\Entity\GymSubscriptionPurchase;
use App\Module\GymSubscriptionPurchase\Service\GymSubscriptionPurchaseService;
use App\Module\User\Component\CurrentUser;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class GymSubscriptionPurchaseCreateAction
 *
 * GymSubscriptionPurchaseCreateAction
 *
 * @package App\Module\GymSubscriptionPurchase\Controller
 */
class GymSubscriptionPurchaseCreateAction extends AbstractController
{
    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        CurrentUser $currentUser,
        private GymSubscriptionPurchaseService $gymSubscriptionPurchaseService
    ) {
        parent::__construct($serializer, $validator, $currentUser);
    }

    public function __invoke(GymSubscriptionPurchase $data): GymSubscriptionPurchase
    {
        $this->validate($data);
        ($this->gymSubscriptionPurchaseService)($data);

        return $data;
    }
}
