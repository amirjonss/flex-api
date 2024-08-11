<?php declare(strict_types=1);

namespace App\Module\Common\Entity\Interfaces;

use DateTimeInterface;

interface DeletedAtSettableInterface
{
    public function setDeletedAt(DateTimeInterface $deletedAt): self;
}
