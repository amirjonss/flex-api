<?php

declare(strict_types=1);

namespace App\Module\GymSubscriptionPurchase\Service;

use App\Module\GymSubscriptionPurchase\Entity\GymSubscriptionPurchase;
use DateInterval;

/**
 * Class GymSubscriptionPurchaseService
 *
 * GymSubscriptionPurchaseService
 *
 * @package App\Module\GymSubscriptionPurchase\Service
 */
class GymSubscriptionPurchaseService
{
    public function __invoke(GymSubscriptionPurchase $data): GymSubscriptionPurchase
    {
        $data->setPurchaseDate(new \DateTime());
        $endDate = clone $data->getStartDate();
        $data->setEndDate($endDate->add(new DateInterval('P' . $data->getGymSubscription()->getDuration() . 'D')));
        $data->setIsActive(true);
        $data->setCreatedAt(new \DateTime());

        return $data;
    }
}
