<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CheeseListingRepository")
 * @ApiResource()
 * @ApiFilter(BooleanFilter::class, properties={"isStinky"})
 * @ApiFilter(DateFilter::class, properties={"createdAt"})
 */
class CheeseListing
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isStinky;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="cheeseListings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Conversation", mappedBy="cheeseListing")
     */
    private $conversations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CheeseType", inversedBy="cheeseListing")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cheeseType;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->conversations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getIsStinky(): ?bool
    {
        return $this->isStinky;
    }

    public function setIsStinky(bool $isStinky): self
    {
        $this->isStinky = $isStinky;

        return $this;
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

    /**
     * @return Collection|Conversation[]
     */
    public function getConversations(): Collection
    {
        return $this->conversations;
    }

    public function addConversation(Conversation $conversation): self
    {
        if (!$this->conversations->contains($conversation)) {
            $this->conversations[] = $conversation;
            $conversation->setCheeseListing($this);
        }

        return $this;
    }

    public function removeConversation(Conversation $conversation): self
    {
        if ($this->conversations->contains($conversation)) {
            $this->conversations->removeElement($conversation);
            // set the owning side to null (unless already changed)
            if ($conversation->getCheeseListing() === $this) {
                $conversation->setCheeseListing(null);
            }
        }

        return $this;
    }

    public function getCheeseType(): ?CheeseType
    {
        return $this->cheeseType;
    }

    public function setCheeseType(?CheeseType $cheeseType): self
    {
        $this->cheeseType = $cheeseType;

        return $this;
    }
}