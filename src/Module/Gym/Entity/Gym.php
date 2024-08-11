<?php

namespace App\Module\Gym\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Module\Common\Entity\Trait\CreatedAtTrait;
use App\Module\Common\Entity\Trait\DeletedTrait;
use App\Module\Common\Entity\Trait\UpdatedTrait;
use App\Module\Gym\Repository\GymRepository;
use App\Module\GymSubscription\Entity\GymSubscription;
use App\Module\Media\Entity\MediaObject;
use App\Module\Trainer\Entity\Trainer;
use App\Module\User\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GymRepository::class)]
#[ApiResource]
class Gym
{
    use CreatedAtTrait;
    use UpdatedTrait;
    use DeletedTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne]
    private ?User $gymAdmin = null;

    #[ORM\ManyToOne]
    private ?MediaObject $photo = null;

    #[ORM\OneToMany(mappedBy: 'gym', targetEntity: GymSubscription::class, orphanRemoval: true)]
    private Collection $gymSubscriptions;

    #[ORM\OneToMany(mappedBy: 'gym', targetEntity: Trainer::class, orphanRemoval: true)]
    private Collection $trainers;

    public function __construct()
    {
        $this->gymSubscriptions = new ArrayCollection();
        $this->trainers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

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

    public function getGymAdmin(): ?User
    {
        return $this->gymAdmin;
    }

    public function setGymAdmin(?User $gymAdmin): self
    {
        $this->gymAdmin = $gymAdmin;

        return $this;
    }

    public function getPhoto(): ?MediaObject
    {
        return $this->photo;
    }

    public function setPhoto(?MediaObject $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, GymSubscription>
     */
    public function getGymSubscriptions(): Collection
    {
        return $this->gymSubscriptions;
    }

    public function addGymSubscription(GymSubscription $gymSubscription): self
    {
        if (!$this->gymSubscriptions->contains($gymSubscription)) {
            $this->gymSubscriptions->add($gymSubscription);
            $gymSubscription->setGym($this);
        }

        return $this;
    }

    public function removeGymSubscription(GymSubscription $gymSubscription): self
    {
        if ($this->gymSubscriptions->removeElement($gymSubscription)) {
            // set the owning side to null (unless already changed)
            if ($gymSubscription->getGym() === $this) {
                $gymSubscription->setGym(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Trainer>
     */
    public function getTrainers(): Collection
    {
        return $this->trainers;
    }

    public function addTrainer(Trainer $trainer): self
    {
        if (!$this->trainers->contains($trainer)) {
            $this->trainers->add($trainer);
            $trainer->setGym($this);
        }

        return $this;
    }

    public function removeTrainer(Trainer $trainer): self
    {
        if ($this->trainers->removeElement($trainer)) {
            // set the owning side to null (unless already changed)
            if ($trainer->getGym() === $this) {
                $trainer->setGym(null);
            }
        }

        return $this;
    }
}
