<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistItem extends Model
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
    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }
}
