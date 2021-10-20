<?php

namespace Mdigi\PBB\Tests;

use Mdigi\PBB\PBBServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            PBBServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/../database/migrations/CreateTable.php';

        (new \CreateTable)->up();
    }
}