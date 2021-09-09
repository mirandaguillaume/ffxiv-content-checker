<?php

namespace App\Entity;

use App\Repository\CharacterJobRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterJobRepository::class)
 */
class CharacterJob
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\Job")
     * @ORM\JoinColumn(name="job_id", referencedColumnName="id")
     */
    private Job $job;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\Character", inversedBy="jobs")
     * @ORM\JoinColumn(name="character_id", referencedColumnName="id")
     */
    private Character $character;

    /**
     * @ORM\Column(type="integer")
     */
    private int $level;

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getJob(): Job
    {
        return $this->job;
    }

    public function setJob(Job $job): CharacterJob
    {
        $this->job = $job;

        return $this;
    }

    public function getCharacter(): Character
    {
        return $this->character;
    }

    public function setCharacter(Character $character): CharacterJob
    {
        $this->character = $character;

        return $this;
    }
}
