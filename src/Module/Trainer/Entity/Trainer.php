<?php

namespace App\Module\Trainer\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Module\Common\Controller\DeleteAction;
use App\Module\Common\Entity\Interfaces\CreatedAtSettableInterface;
use App\Module\Common\Entity\Interfaces\DeletedAtSettableInterface;
use App\Module\Common\Entity\Interfaces\DeletedBySettableInterface;
use App\Module\Common\Entity\Interfaces\UpdatedAtSettableInterface;
use App\Module\Common\Entity\Trait\CreatedAtTrait;
use App\Module\Common\Entity\Trait\DeletedTrait;
use App\Module\Common\Entity\Trait\UpdatedTrait;
use App\Module\Gym\Entity\Gym;
use App\Module\Media\Entity\MediaObject;
use App\Module\Trainer\Controller\CreateTrainerAction;
use App\Module\Trainer\Repository\TrainerRepository;
use App\Module\TrainerSubscription\Entity\TrainerSubscription;
use App\Module\User\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(
            controller: CreateTrainerAction::class,
            securityPostDenormalize: "is_granted('ROLE_ADMIN') || object.getGym().getGymAdmin() == user",
        ),
        new Put(
            denormalizationContext: ['groups' => ['trainer:put']],
            security: "is_granted('ROLE_ADMIN') || object.getUser() == user || object.getGym().getGymAdmin() == user",
        ),
        new Delete(
            controller: DeleteAction::class,
            security: "is_granted('ROLE_ADMIN') || object.getUser() == user || object.getGym().getGymAdmin() == user"
        ),
    ],
    normalizationContext: ['groups' => ['trainer:read']],
    denormalizationContext: ['groups' => ['trainer:write']],
)]
#[ORM\Entity(repositoryClass: TrainerRepository::class)]
class Trainer implements
    CreatedAtSettableInterface,
    UpdatedAtSettableInterface,
    DeletedAtSettableInterface,
    DeletedBySettableInterface
{
    use CreatedAtTrait;
    use UpdatedTrait;
    use DeletedTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["trainer:read"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["trainer:read", "trainer:write", "trainer:put"])]
    #[Assert\Length(min: 3, max: 255)]
    #[Assert\NotBlank]
    private ?string $firstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["trainer:read", "trainer:write", "trainer:put"])]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["trainer:read", "trainer:write", "trainer:put"])]
    private ?string $specialization = null;

    #[ORM\ManyToOne(inversedBy: 'trainers')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["trainer:read", "trainer:write"])]
    #[Assert\NotBlank]
    private ?Gym $gym = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["trainer:read", "trainer:write"])]
    #[Assert\NotBlank]
    private ?User $user = null;

    #[ORM\ManyToOne]
    #[Groups(["trainer:read", "trainer:write", "trainer:put"])]
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
