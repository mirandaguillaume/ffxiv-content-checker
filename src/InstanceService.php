<?php

namespace App;

use App\Entity\Instance;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class InstanceService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createFromData(\stdClass $dungeonRaw, int $type)
    {
        $dungeon = new Instance($type);

        if (isset($dungeonRaw->ContentTargetID)) {
            $dungeon->setId($dungeonRaw->ContentTargetID);
            $dungeon->setName($dungeonRaw->Name);
            $dungeon->setClassJobRequired($dungeonRaw->ClassJobLevelRequired);
            $dungeon->setClassJobSync($dungeonRaw->ClassJobLevelSync);

            try {
                $this->entityManager->persist($dungeon);
                $this->entityManager->flush();
            } catch (UniqueConstraintViolationException $e) {
                $this->entityManager = EntityManager::create(
                    $this->entityManager->getConnection(),
                    $this->entityManager->getConfiguration()
                );
            }
        }
    }
}
