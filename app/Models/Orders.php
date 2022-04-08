<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'quantity', 'bulanTahun'];

    // public $timestamps = false;


    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function products() {
        return $this->belongsToMany(Products::class)->withPivot('quantity', 'delayed')->withTimestamps();
    }
}
