<?php

namespace App\Module\TrainerSubscriptionPurchase\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Module\Common\Entity\Trait\CreatedAtTrait;
use App\Module\Common\Entity\Trait\DeletedTrait;
use App\Module\Common\Entity\Trait\UpdatedTrait;
use App\Module\TrainerSubscription\Entity\TrainerSubscription;
use App\Module\TrainerSubscriptionPurchase\Controller\CreateTrainerSubscriptionPurchaseAction;
use App\Module\TrainerSubscriptionPurchase\Repository\TrainerSubscriptionPurchaseRepository;
use App\Module\User\Entity\User;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TrainerSubscriptionPurchaseRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(
            controller: CreateTrainerSubscriptionPurchaseAction::class,
            securityPostDenormalize: "is_granted('ROLE_ADMIN') || object.getTrainerSubscription().getTrainer().getUser() == user"
        )
    ],
    normalizationContext: ['groups' => ['trainer-subscription-purchase:read']],
    denormalizationContext: ['groups' => ['trainer-subscription-purchase:write']],
)]
class TrainerSubscriptionPurchase
{
    use CreatedAtTrait;
    use UpdatedTrait;
    use DeletedTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["trainer-subscription-purchase:read"])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'trainerSubscriptionPurchases')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["trainer-subscription-purchase:read", "trainer-subscription-purchase:write"])]
    #[Assert\NotBlank]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'trainerSubscriptionPurchases')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["trainer-subscription-purchase:read", "trainer-subscription-purchase:write"])]
    #[Assert\NotBlank]
    private ?TrainerSubscription $trainerSubscription = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(["trainer-subscription-purchase:read", "trainer-subscription-purchase:write"])]
    #[Assert\NotBlank]
    #[Assert\DateTime]
    private ?\DateTimeInterface $purchaseDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(["trainer-subscription-purchase:read", "trainer-subscription-purchase:write"])]
    #[Assert\NotBlank]
    #[Assert\Date]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(["trainer-subscription-purchase:read"])]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?bool $isActive = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTrainerSubscription(): ?TrainerSubscription
    {
        return $this->trainerSubscription;
    }

    public function setTrainerSubscription(?TrainerSubscription $trainerSubscription): self
    {
        $this->trainerSubscription = $trainerSubscription;

        return $this;
    }

    public function getPurchaseDate(): ?\DateTimeInterface
    {
        return $this->purchaseDate;
    }

    public function setPurchaseDate(\DateTimeInterface $purchaseDate): self
    {
        $this->purchaseDate = $purchaseDate;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        if (new \DateTime() > $this->getEndDate()) {
            return false;
        }

        return true;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
}
