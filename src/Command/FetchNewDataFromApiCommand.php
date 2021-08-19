<?php

namespace App\Command;

use App\InstanceService;
use App\FFXIVApiClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use XIVAPI\Api\SearchFilters;

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

    /**
     * @var SymfonyStyle
     */
    private $io;

    /**
     * @var FFXIVApiClient
     */
    private $client;

    /**
     * @var InstanceService
     */
    private $dungeonService;

    public function __construct(FFXIVApiClient $client, InstanceService $dungeonService)
    {
        parent::__construct();
        $this->client = $client;
        $this->dungeonService = $dungeonService;
    }

    public function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach (self::contentTypesToGet as $contentTypeId) {
            $contentType = $this->client->getClient()->content->ContentType()->one($contentTypeId);

            $dungeonIds = $contentType->GameContentLinks->ContentFinderCondition->ContentType;

            foreach ($dungeonIds as $dungeonId) {
                $this->dungeonService->createFromData(
                    $this->client->getClient()->content->ContentFinderCondition()->one($dungeonId),
                    $contentTypeId
                );
            }

            $this->io->success("Finished contentType {$contentType->Name}");
        }

        return 0;
    }
}
