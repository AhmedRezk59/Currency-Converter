<?php

namespace Tests\Feature;

use App\Services\ConverterService;
use PHPUnit\Framework\TestCase;

class ConverterServiceTest extends TestCase {
    public function test_get_currencies_method ()
    {
        $currencies = ConverterService::getCurrencies();
        $this->assertCount(149 , $currencies);
    }

    public function test_get_latest_conversions_method ()
    {
        $latest_conversions = ConverterService::getLatestConversions(8);
        $this->assertCount(8 , $latest_conversions);   
    }
}