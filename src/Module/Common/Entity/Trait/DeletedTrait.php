<?php

declare(strict_types=1);

namespace App\Module\Common\Entity\Trait;

use App\Module\User\Entity\User;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait DeletedTrait
{
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $deletedAt = null;
    #[ORM\ManyToOne]
    private ?User $deletedBy = null;

    /**
     * @return DateTimeInterface|null
     */
    public function getDeletedAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }

    /**
     * @return User|null
     */
    public function getDeletedBy(): ?User
    {
        return $this->deletedBy;
    }

    /**
     * @param DateTimeInterface|null $deletedAt
     */
    public function setDeletedAt(?DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

    /**
     * @param User $deletedBy
     */
    public function setDeletedBy(User $deletedBy): self
    {
        $this->deletedBy = $deletedBy;
        return $this;
    }
}