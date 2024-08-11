<?php

namespace App\Module\GymSubscription\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Module\Common\Entity\Trait\CreatedAtTrait;
use App\Module\Common\Entity\Trait\DeletedTrait;
use App\Module\Common\Entity\Trait\UpdatedTrait;
use App\Module\Gym\Entity\Gym;
use App\Module\GymSubscription\Repository\GymSubscriptionRepository;
use App\Module\GymSubscriptionPurchase\Entity\GymSubscriptionPurchase;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GymSubscriptionRepository::class)]
#[ApiResource]
class GymSubscription
{
    use CreatedAtTrait;
    use UpdatedTrait;
    use DeletedTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'gymSubscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Gym $gym = null;

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

    #[ORM\OneToMany(mappedBy: 'gymSubscription', targetEntity: GymSubscriptionPurchase::class, orphanRemoval: true)]
    private Collection $gymSubscriptionPurchases;

    public function __construct()
    {
        $this->gymSubscriptionPurchases = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGym(): ?Gym
    {
        return $this->gym;
    }

    public function setGym(?Gym $gym): self
    {
        $this->gym = $gym;

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
     * @return Collection<int, GymSubscriptionPurchase>
     */
    public function getGymSubscriptionPurchases(): Collection
    {
        return $this->gymSubscriptionPurchases;
    }

    public function addGymSubscriptionPurchase(GymSubscriptionPurchase $gymSubscriptionPurchase): self
    {
        if (!$this->gymSubscriptionPurchases->contains($gymSubscriptionPurchase)) {
            $this->gymSubscriptionPurchases->add($gymSubscriptionPurchase);
            $gymSubscriptionPurchase->setGymSubscription($this);
        }

        return $this;
    }

    public function removeGymSubscriptionPurchase(GymSubscriptionPurchase $gymSubscriptionPurchase): self
    {
        if ($this->gymSubscriptionPurchases->removeElement($gymSubscriptionPurchase)) {
            // set the owning side to null (unless already changed)
            if ($gymSubscriptionPurchase->getGymSubscription() === $this) {
                $gymSubscriptionPurchase->setGymSubscription(null);
            }
        }

        return $this;
    }
}
