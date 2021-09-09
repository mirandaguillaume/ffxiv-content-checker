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
    private $job;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\Character", inversedBy="jobs")
     * @ORM\JoinColumn(name="character_id", referencedColumnName="id")
     */
    private $character;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @param mixed $job
     *
     * @return CharacterJob
     */
    public function setJob($job)
    {
        $this->job = $job;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * @param mixed $character
     *
     * @return CharacterJob
     */
    public function setCharacter($character)
    {
        $this->character = $character;
        return $this;
    }
}
