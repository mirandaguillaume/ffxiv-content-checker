<?php

namespace App\Command;

use App\FFXIVApiClient;
use App\Service\InstanceService;
use App\Service\JobService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FetchNewDataFromApiCommand extends Command
{
    private const contentTypesToGet = [
        2,
        3,
        4,
        5,
        6,
        21,
        26,
        28,
    ];

    protected static $defaultName = 'fetch:new-data';

    private SymfonyStyle $io;

    public function __construct(
        private FFXIVApiClient $client,
        private InstanceService $dungeonService,
        private JobService $jobService
    ) {
        parent::__construct();
    }

    public function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach (self::contentTypesToGet as $contentTypeId) {
            $contentType = $this->client->getClient()->content->ContentType()->one($contentTypeId);

            $dungeonIds = $contentType->GameContentLinks->ContentFinderCondition->ContentType;

            foreach ($dungeonIds as $dungeonId) {
                $this->dungeonService->createOrUpdate(
                    $this->client->getClient()->content->ContentFinderCondition()->one($dungeonId),
                    $contentTypeId
                );
            }

            $this->io->success("Finished loading contentType $contentType->Name.");
        }

        $classJobs = $this->client->getClient()->content->ClassJob()->list();

        foreach ($classJobs->Results as $classJob) {
            $this
                ->jobService
                ->createOrUpdate($this->client->getClient()->content->ClassJob()->one($classJob->ID))
            ;
        }

        $this->io->success('Finished loading jobs.');

        return 0;
    }
}
