<?php


namespace Mdigi\PBB\Tests\Unit;

use Illuminate\Support\Facades\App;
use Mdigi\PBB\Contracts\LookupItemService;
use Mdigi\PBB\Tests\TestCase;

class LookupItemServiceTest extends TestCase
{
    function test_pekerjaan()
    {
        $service = App::make(LookupItemService::class);
        $lookupItem = $service->pekerjaan();
        $this->assertNotNull($lookupItem);
    }
}