<?php

namespace App\Controllers;

use App\Services\ConverterService;
use Core\Url\Url;

class ConversionController
{
    public function index(ConverterService $converterService)
    {
        $currencies = $converterService->getCurrencies();
        return view('rates-converter', ['currencies' => $currencies]);
    }

    public function convert(ConverterService $converterService)
    {
        $bindings = $converterService->getToRate();
        $converterService->storeConvertedRate($bindings);
        return Url::redirect('/rates-converter');
    }

    public function getLatestConversions(ConverterService $converterService)
    {
        $latest_conversions = $converterService->getLatestConversions(8);
        return view('latest-conversions', ['latest_conversions' => $latest_conversions]);
    }
}
