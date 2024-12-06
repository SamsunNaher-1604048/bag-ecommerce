<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function scopeOfActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeOfVisible($query)
    {
        return $query->where('is_home_page', 1);
    }
}
