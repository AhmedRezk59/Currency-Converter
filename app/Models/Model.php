<?php

namespace App\Models;

use Core\Database\Database;

class Model
{
    public array $attributes = [];

    public function __get($key)
    {
        return $this->attributes[$key] ?? '';
    }
    public function find($id)
    {
        $res = Database::query('Select * FROM ' . $this->table . ' Where `id` = ?' , [$id])->execute();
        if(isset($res[0])) $this->attributes = (array) $res;         
        return $this;        
    }
}
