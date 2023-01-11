<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        "code",
        "name",
        "validation",
        "is_filterable",
        "is_required"
    ];

    /**
     * @var array<string, string>
     */
    protected $casts  = [
        "is_filterable" =>  "boolean",
        "is_required"   =>  "boolean",
    ];
}
