<?php declare(strict_types=1);

namespace App\Module\Common\Entity\Interfaces;

use DateTimeInterface;

interface CreatedAtSettableInterface
{
    public function setCreatedAt(DateTimeInterface $createdAt);
}
