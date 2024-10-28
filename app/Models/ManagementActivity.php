<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementActivity extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function activities(){
        return $this->belongsTo(Activity::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
    public function comanpanies(){
        return $this->belongsTo(Company::class);
    }
}
