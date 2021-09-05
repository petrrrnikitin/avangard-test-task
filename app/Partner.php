<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Partner extends Model
{
    public function getList()
    {
        return Partner::all()->pluck(
            'name',
            'id'
        )->all();
    }
}
