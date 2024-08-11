<?php

declare(strict_types=1);

namespace App\Module\Common\Component\Core;

use App\Module\Common\Entity\Interfaces\DeletedAtSettableInterface;
use App\Module\Common\Entity\Interfaces\DeletedBySettableInterface;
use App\Module\User\Component\CurrentUser;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class MarkEntityAsDeleted extends AbstractManager
{
    public function __construct(EntityManagerInterface $entityManager, private CurrentUser $currentUser)
    {
        parent::__construct($entityManager);
    }

    public function mark(DeletedAtSettableInterface|DeletedBySettableInterface $entity, bool $needToFlush = false): void
    {
        if ($entity instanceof DeletedAtSettableInterface) {
            $entity->setDeletedAt(new DateTime());
        }

        if ($entity instanceof DeletedBySettableInterface) {
            $entity->setDeletedBy($this->currentUser->getUser());
        }

        $this->save($entity, $needToFlush);
    }
}
