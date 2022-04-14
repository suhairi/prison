<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'status'];

    // public $timestamps = false;

    public function orders() {
        return $this->belongsToMany(Orders::class)->withPivot('quantity', 'delayed')->withTimestamps();
    }
}
