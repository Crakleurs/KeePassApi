<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 */
class Group
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
    private $groupName;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="groups")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity=Password::class, mappedBy="groups")
     */
    private $passwords;

    /**
     * @ORM\OneToOne(targetEntity=SubMainPassword::class, mappedBy="groups", cascade={"persist", "remove"})
     */
    private $subMainPassword;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->passwords = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroupName(): ?string
    {
        return $this->groupName;
    }

    public function setGroupName(string $groupName): self
    {
        $this->groupName = $groupName;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addGroup($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeGroup($this);
        }

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
            $password->addGroup($this);
        }

        return $this;
    }

    public function removePassword(Password $password): self
    {
        if ($this->passwords->removeElement($password)) {
            $password->removeGroup($this);
        }

        return $this;
    }

    public function getSubMainPassword(): ?SubMainPassword
    {
        return $this->subMainPassword;
    }

    public function setSubMainPassword(SubMainPassword $subMainPassword): self
    {
        // set the owning side of the relation if necessary
        if ($subMainPassword->getGroups() !== $this) {
            $subMainPassword->setGroups($this);
        }

        $this->subMainPassword = $subMainPassword;

        return $this;
    }
}
