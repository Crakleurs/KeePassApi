<?php

namespace App\Entity;

use App\Repository\SubMainPasswordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubMainPasswordRepository::class)
 */
class SubMainPassword
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Password::class, mappedBy="subMainPassword", orphanRemoval=true)
     */
    private $passwords;

    /**
     * @ORM\OneToOne(targetEntity=Group::class, inversedBy="subMainPassword", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $groups;

    public function __construct()
    {
        $this->passwords = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Password[]
     */
    public function getPasswords(): Collection
    {
        return $this->passwords;
    }

    public function addPassword(Password $password): self
    {
        if (!$this->passwords->contains($password)) {
            $this->passwords[] = $password;
            $password->setSubMainPassword($this);
        }

        return $this;
    }

    public function removePassword(Password $password): self
    {
        if ($this->passwords->removeElement($password)) {
            // set the owning side to null (unless already changed)
            if ($password->getSubMainPassword() === $this) {
                $password->setSubMainPassword(null);
            }
        }

        return $this;
    }

    public function getGroups(): ?Group
    {
        return $this->groups;
    }

    public function setGroups(Group $groups): self
    {
        $this->groups = $groups;

        return $this;
    }
}
