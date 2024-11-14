<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amount extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function companies(){
        return $this->belongsTo(Company::class);
    }
    
    public function punto()
    {
        return $this->belongsTo(Point::class);
    }
}
