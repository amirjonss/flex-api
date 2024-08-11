<?php

namespace App\Module\Trainer\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Module\Common\Entity\Trait\CreatedAtTrait;
use App\Module\Common\Entity\Trait\DeletedTrait;
use App\Module\Common\Entity\Trait\UpdatedTrait;
use App\Module\Gym\Entity\Gym;
use App\Module\Media\Entity\MediaObject;
use App\Module\Trainer\Repository\TrainerRepository;
use App\Module\TrainerSubscription\Entity\TrainerSubscription;
use App\Module\User\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: TrainerRepository::class)]
class Trainer
{
    use CreatedAtTrait;
    use UpdatedTrait;
    use DeletedTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $specialization = null;

    #[ORM\ManyToOne(inversedBy: 'trainers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Gym $gym = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne]
    private ?MediaObject $photo = null;

    #[ORM\OneToMany(mappedBy: 'trainer', targetEntity: TrainerSubscription::class, orphanRemoval: true)]
    private Collection $trainerSubscriptions;

    public function __construct()
    {
        $this->trainerSubscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getSpecialization(): ?string
    {
        return $this->specialization;
    }

    public function setSpecialization(?string $specialization): self
    {
        $this->specialization = $specialization;

        return $this;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

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
     * @return Collection<int, TrainerSubscription>
     */
    public function getTrainerSubscriptions(): Collection
    {
        return $this->trainerSubscriptions;
    }

    public function addTrainerSubscription(TrainerSubscription $trainerSubscription): self
    {
        if (!$this->trainerSubscriptions->contains($trainerSubscription)) {
            $this->trainerSubscriptions->add($trainerSubscription);
            $trainerSubscription->setTrainer($this);
        }

        return $this;
    }

    public function removeTrainerSubscription(TrainerSubscription $trainerSubscription): self
    {
        if ($this->trainerSubscriptions->removeElement($trainerSubscription)) {
            // set the owning side to null (unless already changed)
            if ($trainerSubscription->getTrainer() === $this) {
                $trainerSubscription->setTrainer(null);
            }
        }

        return $this;
    }
}
