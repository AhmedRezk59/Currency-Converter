<?php

namespace App\Controllers;

use App\Services\ConverterService;
use Core\Url\Url;

class ConversionController
{
    public function index()
    {
        $currencies = ConverterService::getCurrencies();
        return view('rates-converter', ['currencies' => $currencies]);
    }

    public function convert()
    {
        $bindings = ConverterService::getToRate();
        ConverterService::storeConvertedRate($bindings);
        return Url::redirect('/rates-converter');
    }

    public function getLatestConversions()
    {
        $latest_conversions = ConverterService::getLatestConversions(8);
        return view('latest-conversions', ['latest_conversions' => $latest_conversions]);
    }
}
