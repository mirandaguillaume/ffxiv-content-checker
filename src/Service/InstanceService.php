<?php

namespace App\Service;

use App\Entity\Instance;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use stdClass;

class InstanceService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {}

    public function createOrUpdate(stdClass $dungeonRaw, int $type): void
    {
        if (isset($dungeonRaw->ContentTargetID)) {
            $dungeon = $this->entityManager->getRepository(Instance::class)->find($dungeonRaw->ContentTargetID);

            if (!$dungeon) {
                $dungeon = new Instance($type);
            }

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
