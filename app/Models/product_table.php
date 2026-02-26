<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class product_table extends Model
{
    protected $guarded = [];

    protected $table = "product_tables";

    public function InsertDataTbl($incomingFields){
        return $this->create($incomingFields);
    }
}
