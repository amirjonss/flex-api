<?php

declare(strict_types=1);

namespace App\Module\Trainer\Component;

use App\Module\Common\Component\Core\AbstractManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class TrainerManager
 *
 * TrainerManager
 *
 * @package App\Module\Trainer\Component
 */
class TrainerManager extends AbstractManager
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }
}
