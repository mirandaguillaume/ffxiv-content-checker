<?php

namespace App\Service;

use App\Entity\Job;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class JobService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createOrUpdate(\stdClass $rawJob): void
    {
        $job = $this->entityManager->getRepository(Job::class)->find($rawJob->ID);

        if (!$job) {
            $job = new Job();
        }

        $job->setName($rawJob->Name);

        try {
            $this->entityManager->persist($job);
            $this->entityManager->flush();
        } catch (UniqueConstraintViolationException $e) {
            $this->entityManager = EntityManager::create(
                $this->entityManager->getConnection(),
                $this->entityManager->getConfiguration()
            );
        }
    }
}
