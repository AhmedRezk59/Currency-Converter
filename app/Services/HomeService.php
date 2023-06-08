<?php

namespace App\Services;

use Core\Database\Database;
use Core\Http\Http;
use Core\Http\Request;
use Core\Pagination\Pagination;

class HomeService
{
    public static function getRates()
    {
        $page = filter_var(Request::get('page'), FILTER_SANITIZE_NUMBER_INT) ?: 1;
        $limit = 8;
        $page = ((int) $page - 1) * $limit;
        $sql = "SELECT * FROM `exchange_rates` LIMIT $limit OFFSET $page";
        $result = Database::query($sql)->execute();
        if (count($result) == 0) {
            static::store();
            $result = Database::query($sql)->execute();
        }
        Pagination::handle($result, $page, $limit);
        return $result;
    }

    public static function updateRates ()
    {
        list($keys, $values, $toBeReplaced) = static::prepare();
        Database::query('TRUNCATE TABLE `exchange_rates`')->execute();
        $query = "INSERT INTO `exchange_rates` ($keys) VALUES $toBeReplaced";
        Database::query($query, $values)->execute();
    }
    private static function store()
    {
        list($keys, $values, $toBeReplaced) = static::prepare();
        $query = "INSERT INTO `exchange_rates` ($keys) VALUES $toBeReplaced";
        $result = Database::query($query, $values)->execute();
        return $result;
    }

    private static function prepare()
    {
        $tableB =  Http::init('http://api.nbp.pl/api/exchangerates/tables/b/')->get();
        $tableA =  Http::init('http://api.nbp.pl/api/exchangerates/tables/a/')->get();
        $rates = array_merge($tableA[0]->rates, $tableB[0]->rates);
        $keys = implode(' , ', array_keys((array) $rates[0]));
        $values = [];
        $toBeReplaced = array_map(function ($rate) use (&$values) {
            $values[] = $rate->currency;
            $values[] = $rate->code;
            $values[] = $rate->mid;
            return "(?, ? , ?)";
        }, $rates);
        $toBeReplaced = implode(' , ', $toBeReplaced);
        return [$keys, $values, $toBeReplaced];
    }
}
