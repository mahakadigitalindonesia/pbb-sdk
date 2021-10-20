<?php

namespace Mdigi\PBB\Tests;

use Mdigi\PBB\PBBServiceProvider;
use Yajra\Oci8\Oci8ServiceProvider;

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
            Oci8ServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
//        include_once __DIR__ . '/../database/migrations/CreateTable.php';
//
//        (new \CreateTable)->up();
    }
}