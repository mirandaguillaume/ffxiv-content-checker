<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterRepository::class)
 * @ORM\Table(name="`character`")
 */
class Character
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="CharacterJob", mappedBy="character")
     */
    private $jobs;

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getJobs(): ArrayCollection
    {
        return $this->jobs;
    }

    public function setJobs(ArrayCollection $jobs): self
    {
        $this->jobs = $jobs;

        return $this;
    }

    public function addJob(CharacterJob $characterJob)
    {
        $this->jobs->add($characterJob);
    }
}
