<?php

namespace App\Services;

use Core\Database\Database;
use Core\Http\Request;
use Core\Pagination\Pagination;
use Core\Session\Session;
use Core\Url\Url;

class ConverterService
{
    public function getCurrencies()
    {
        return  Database::query('SELECT code , currency FROM `exchange_rates`')->execute();
    }

    public function getToRate()
    {
        list($from_amount, $from_currency, $to_currency) = $this->validate();
        $rates = Database::query("SELECT `code` , `mid` FROM `exchange_rates` where code IN (? , ? )" , [
            $from_currency , $to_currency
        ])->execute();
        $from_rate = array_shift(array_filter($rates, fn ($rate) => $rate->code === $from_currency))->mid;
        $to_rate = array_shift(array_filter($rates, fn ($rate) => $rate->code === $to_currency))->mid;
        $to_amount = round((($from_amount * $from_rate) / $to_rate), 4);
        Session::set('msg', "$from_amount $from_currency is/are equal to $to_amount  $to_currency");
        return [$from_rate, $from_amount, $from_currency, $to_rate, $to_amount, $to_currency];
    }

    private function validate()
    {
        $errors = [];
        $from_amount = filter_var(Request::post('from_amount'), FILTER_VALIDATE_FLOAT);
        if (!$from_amount) {
            $errors[] = 'The From amount is not valid';
        }
        $from_currency = htmlspecialchars(Request::post('from_currency'));
        $to_currency = htmlspecialchars(Request::post('to_currency'));
        if (!is_string($from_currency) || $from_currency == false) {
            $errors[] = 'The from Currency is required';
        }
        if (!is_string($to_currency) || $to_currency == false) {
            $errors[] = 'The To Currency is required';
        }
        if (isset($errors[0])) {
            Session::set('errors', $errors);
            return Url::redirect('/rates-converter');
        }
        return [$from_amount, $from_currency, $to_currency];
    }

    public function storeConvertedRate(array $array)
    {
        Database::query('INSERT INTO `conversions` (`from_rate`  ,`from_amount`,`from_currency` , `to_rate` , `to_amount` , `to_currency`) VALUES (? , ? , ? , ? , ? , ?)', $array)->execute();
    }

    public function getLatestConversions(int $limit = 10)
    {
        $page = filter_var(Request::get('page'), FILTER_SANITIZE_NUMBER_INT) ?: 1;
        $page = ((int) $page - 1) * $limit;
        $sql = "SELECT * FROM `conversions` ORDER BY `converted_at` DESC LIMIT $limit OFFSET $page";
        $latest_conversions = Database::query($sql)->execute();
        Pagination::handle($latest_conversions , $page , $limit);
        return $latest_conversions;
    }
}
