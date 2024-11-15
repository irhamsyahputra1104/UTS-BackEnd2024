<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Covid extends Model
{
    protected $table = "covids";
    protected $fillable = [
        "name",
        "phone",
        "address",
        "status",
        "in_date_at",
        "out_date_at",
    ];
}
