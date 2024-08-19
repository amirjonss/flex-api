<?php

namespace App\Module\GymSubscriptionPurchase\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Module\Common\Entity\Trait\CreatedAtTrait;
use App\Module\Common\Entity\Trait\DeletedTrait;
use App\Module\Common\Entity\Trait\UpdatedTrait;
use App\Module\GymSubscription\Entity\GymSubscription;
use App\Module\GymSubscriptionPurchase\Controller\GymSubscriptionPurchaseCreateAction;
use App\Module\GymSubscriptionPurchase\Repository\GymSubscriptionPurchaseRepository;
use App\Module\User\Entity\User;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GymSubscriptionPurchaseRepository::class)]
#[ApiResource(
    operations: [
        new Post(
            controller: GymSubscriptionPurchaseCreateAction::class,
            securityPostDenormalize: "is_granted('ROLE_ADMIN') || object.getGymSubscription().getGym().getGymAdmin() == user",
        ),
        new Get(),
        new GetCollection()
    ],
    normalizationContext: ['groups' => ['gym-subscription-purchase:read']],
    denormalizationContext: ['groups' => ['gym-subscription-purchase:write']],
)]
class GymSubscriptionPurchase
{
    use CreatedAtTrait;
    use UpdatedTrait;
    use DeletedTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['gym-subscription-purchase:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'gymSubscriptionPurchases')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['gym-subscription-purchase:read', 'gym-subscription-purchase:write'])]
    #[Assert\NotBlank]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'gymSubscriptionPurchases')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['gym-subscription-purchase:read', 'gym-subscription-purchase:write'])]
    #[Assert\NotBlank]
    private ?GymSubscription $gymSubscription = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['gym-subscription-purchase:read', 'gym-subscription-purchase:write'])]
    #[Assert\DateTime]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $purchaseDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['gym-subscription-purchase:read', 'gym-subscription-purchase:write'])]
    #[Assert\Date]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['gym-subscription-purchase:read'])]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\Column]
    #[Groups(['gym-subscription-purchase:read'])]
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

    public function getGymSubscription(): ?GymSubscription
    {
        return $this->gymSubscription;
    }

    public function setGymSubscription(?GymSubscription $gymSubscription): self
    {
        $this->gymSubscription = $gymSubscription;

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
