<?php

namespace Tests\Feature;

use App\Services\ConverterService;
use PHPUnit\Framework\TestCase;

class ConverterServiceTest extends TestCase {
    public function test_get_currencies_method ()
    {
        $converterService = new ConverterService();
        $currencies = $converterService->getCurrencies();
        $this->assertCount(149 , $currencies);
    }

    public function test_get_latest_conversions_method ()
    {
        $converterService = new ConverterService();
        $latest_conversions = $converterService->getLatestConversions(8);
        $this->assertCount(8 , $latest_conversions);   
    }
}