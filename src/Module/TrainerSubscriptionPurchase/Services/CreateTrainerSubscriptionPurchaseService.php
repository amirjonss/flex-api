<?php

declare(strict_types=1);

namespace App\Module\TrainerSubscriptionPurchase\Services;

use App\Module\TrainerSubscriptionPurchase\Entity\TrainerSubscriptionPurchase;
use DateInterval;

/**
 * Class CreateTrainerSubscriptionPurchaseService
 *
 * CreateTrainerSubscriptionPurchaseService
 *
 * @package App\Module\TrainerSubscriptionPurchase\Services
 */
class CreateTrainerSubscriptionPurchaseService
{
    public function __invoke(TrainerSubscriptionPurchase $data): TrainerSubscriptionPurchase
    {
        $data->setPurchaseDate(new \DateTime());
        $endDate = clone $data->getStartDate();
        $data->setEndDate($endDate->add(new DateInterval('P' . $data->getTrainerSubscription()->getDuration() . 'D')));
        $data->setIsActive(true);
        $data->setCreatedAt(new \DateTime());

        return $data;
    }
}
