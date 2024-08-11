<?php

namespace App\Module\TrainerSubscription\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Module\Common\Entity\Trait\CreatedAtTrait;
use App\Module\Common\Entity\Trait\DeletedTrait;
use App\Module\Common\Entity\Trait\UpdatedTrait;
use App\Module\Trainer\Entity\Trainer;
use App\Module\TrainerSubscription\Repository\TrainerSubscriptionRepository;
use App\Module\TrainerSubscriptionPurchase\Entity\TrainerSubscriptionPurchase;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainerSubscriptionRepository::class)]
#[ApiResource]
class TrainerSubscription
{
    use CreatedAtTrait;
    use UpdatedTrait;
    use DeletedTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'trainerSubscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Trainer $trainer = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\OneToMany(mappedBy: 'trainerSubscription', targetEntity: TrainerSubscriptionPurchase::class, orphanRemoval: true)]
    private Collection $trainerSubscriptionPurchases;

    public function __construct()
    {
        $this->trainerSubscriptionPurchases = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrainer(): ?Trainer
    {
        return $this->trainer;
    }

    public function setTrainer(?Trainer $trainer): self
    {
        $this->trainer = $trainer;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection<int, TrainerSubscriptionPurchase>
     */
    public function getTrainerSubscriptionPurchases(): Collection
    {
        return $this->trainerSubscriptionPurchases;
    }

    public function addTrainerSubscriptionPurchase(TrainerSubscriptionPurchase $trainerSubscriptionPurchase): self
    {
        if (!$this->trainerSubscriptionPurchases->contains($trainerSubscriptionPurchase)) {
            $this->trainerSubscriptionPurchases->add($trainerSubscriptionPurchase);
            $trainerSubscriptionPurchase->setTrainerSubscription($this);
        }

        return $this;
    }

    public function removeTrainerSubscriptionPurchase(TrainerSubscriptionPurchase $trainerSubscriptionPurchase): self
    {
        if ($this->trainerSubscriptionPurchases->removeElement($trainerSubscriptionPurchase)) {
            // set the owning side to null (unless already changed)
            if ($trainerSubscriptionPurchase->getTrainerSubscription() === $this) {
                $trainerSubscriptionPurchase->setTrainerSubscription(null);
            }
        }

        return $this;
    }
}
