<?php

namespace App\Entity;

use App\Repository\MainPasswordRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MainPasswordRepository::class)
 */
class MainPassword
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
    private $hashPassword;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHashPassword(): ?string
    {
        return $this->hashPassword;
    }

    public function setHashPassword(string $hashPassword): self
    {
        $this->hashPassword = $hashPassword;

        return $this;
    }
}
