<?php

declare(strict_types=1);

namespace App\Module\TrainerSubscriptionPurchase\Filter;

use ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Validator\ValidatorInterface;
use App\Module\Common\Controller\Base\AbstractController;
use App\Module\GymSubscriptionPurchase\Entity\GymSubscriptionPurchase;
use App\Module\TrainerSubscriptionPurchase\Entity\TrainerSubscriptionPurchase;
use App\Module\User\Component\CurrentUser;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class TrainerSubscriptionPurchaseFilter
 *
 * TrainerSubscriptionPurchaseFilter
 *
 * @package App\Module\TrainerSubscriptionPurchase\Filter
 */
class TrainerSubscriptionPurchaseFilter extends AbstractController implements QueryCollectionExtensionInterface
{
    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        CurrentUser $currentUser
    ) {
        parent::__construct($serializer, $validator, $currentUser);
    }

    public function applyToCollection(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        Operation $operation = null,
        array $context = []
    ): void {
        $rootTable = $queryBuilder->getRootAliases()[0];

        if ($resourceClass === TrainerSubscriptionPurchase::class && !$this->getUser()->isAdmin()) {
            $queryBuilder->leftJoin("{$rootTable}.trainerSubscription", "ts");
            $queryBuilder->leftJoin("ts.trainer", "tst");
            $queryBuilder->andWhere('tst.user = :user');
            $queryBuilder->orWhere("{$rootTable}.user = :user");
            $queryBuilder->setParameter('user', $this->getUser());
        }
    }
}
