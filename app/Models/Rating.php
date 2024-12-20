<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function companies(){
        return $this->belongsTo(Company::class);
    }
    public function description(){
        return $this->belongsTo(ConditionPoint::class);
    }

    public function punto()
    {
        return $this->belongsTo(Point::class);
    }
    public static function getAverageRatingByUser($userId)
    {
        return self::where('user_id', $userId)->avg('rating');
    }

}
