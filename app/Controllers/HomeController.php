<?php

namespace App\Controllers;

use App\Services\HomeService;
use Core\Url\Url;

class HomeController
{
    public function index()
    {
        $rates = HomeService::getRates(8);
        return view('rates', ['result' => $rates]);
    }

    public function update()
    {
        HomeService::updateRates();
        return Url::redirect('/');
    }
}
