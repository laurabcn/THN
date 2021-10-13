<?php

namespace App\Tests\Acceptance\Context\Shared;

use Behat\Behat\Context\Context;
use Symfony\Component\HttpKernel\KernelInterface;

final class SetupContext implements Context
{
    public function __construct(
        private KernelInterface $kernel
    )
    {
    }

    /** @BeforeSuite */
    public static function createDatabase()
    {
        $console = "php " . __DIR__ . '/../../../../bin/console';
        exec("$console doctrine:database:drop --force --no-interaction");
        exec("$console doctrine:database:create --no-interaction");
        exec("$console doctrine:schema:create --no-interaction");
    }

    /** @BeforeScenario */
    public function cleanTables()
    {
        $tablesToBeCleaned = ['information', 'rooms', 'userRoom'];
        $conn = $this->kernel->getContainer()->get('database_connection');
        foreach ($tablesToBeCleaned as $table) {
            $conn->executeQuery("TRUNCATE TABLE $table");
        }
    }
}