<?php declare(strict_types=1);

namespace App\Module\Common\Entity\Interfaces;

use Symfony\Component\Security\Core\User\UserInterface;

interface UpdatedBySettableInterface
{
    public function setUpdatedBy(UserInterface $user);
}
