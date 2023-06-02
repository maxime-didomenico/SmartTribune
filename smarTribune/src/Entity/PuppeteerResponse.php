<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PuppeteerResponseRepository::class)
 */
class PuppeteerResponse
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
    private $lien;

    /**
     * @ORM\Column(type="boolean")
     */
    private $error1;

    /**
     * @ORM\Column(type="boolean")
     */
    private $error2;

    /**
     * @ORM\Column(type="boolean")
     */
    private $error3;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }

    public function getError1(): ?bool
    {
        return $this->error1;
    }

    public function setError1(bool $error1): self
    {
        $this->error1 = $error1;

        return $this;
    }

    public function getError2(): ?bool
    {
        return $this->error2;
    }

    public function setError2(bool $error2): self
    {
        $this->error2 = $error2;

        return $this;
    }

    public function getError3(): ?bool
    {
        return $this->error3;
    }

    public function setError3(bool $error3): self
    {
        $this->error3 = $error3;

        return $this;
    }
}


?>