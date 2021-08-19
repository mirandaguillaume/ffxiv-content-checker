<?php

namespace App\Entity;

use App\Repository\InstanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InstanceRepository::class)
 */
class Instance
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $classJobRequired;

    /**
     * @ORM\Column(type="integer")
     */
    private $classJobSync;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    public function __construct(int $type)
    {
        $this->type = $type;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getClassJobRequired(): int
    {
        return $this->classJobRequired;
    }

    public function setClassJobRequired(int $classJobRequired): self
    {
        $this->classJobRequired = $classJobRequired;

        return $this;
    }

    public function getClassJobSync(): int
    {
        return $this->classJobSync;
    }

    public function setClassJobSync(int $classJobSync): self
    {
        $this->classJobSync = $classJobSync;

        return $this;
    }

    public function getType(): int
    {
        return $this->type;
    }
}
