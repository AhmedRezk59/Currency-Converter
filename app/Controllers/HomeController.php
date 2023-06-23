<?php

namespace App\Controllers;

use App\Services\HomeService;
use Core\Url\Url;

class HomeController
{
    public function index(HomeService $homeService)
    {
        $rates = $homeService->getRates(8);
        return view('rates', ['result' => $rates]);
    }

    public function update(HomeService $homeService)
    {
        $homeService->updateRates();
        return Url::redirect('/');
    }
}
