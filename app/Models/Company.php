<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function activity(){
        return $this->belongsTo(Activity::class);
    }

    public function supervisor(){
        return $this->belongsTo(User::class);
    }

    public function puntosDeVenta()
    {
        return $this->hasMany(Point::class);
    }

    protected $attributes = [
        'points' => 0,
    ];
}
