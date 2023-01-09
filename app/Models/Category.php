<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function childs()
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'id') ;
    }

    public function childrenCategories()
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'id')->with('childs');
    }
}
