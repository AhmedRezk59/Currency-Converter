<?php

namespace Tests\Feature;

use App\Services\HomeService;
use PHPUnit\Framework\TestCase;

class HomeServiceTest extends TestCase
{
    public function test_get_rates_method()
    {
        $rates = HomeService::getRates(8);
        $this->assertCount(8 , $rates);
    }
}
