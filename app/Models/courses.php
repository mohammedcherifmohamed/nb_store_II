<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class courses extends Model
{
    protected $fillable = [
        "title",
        "description",
        "price",
        "image",
        "duration",
        "start_date",
        "end_date",
        "status"
    ];
}
