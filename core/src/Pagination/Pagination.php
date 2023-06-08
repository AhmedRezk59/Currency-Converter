<?php

namespace Core\Pagination;

use Core\Session\Session;

class Pagination
{
    /**
     * Private Constructor
     */
    private function __construct()
    {
    }
    public static function handle(array $data, int $page, int $limit = 10)
    {
        $count = count($data);
        Session::set('paginated_data', [
            'data' => $data,
            'total_rows' => $count,
            'page' => $page,
            'limit' => $limit,
        ]);
    }
}
