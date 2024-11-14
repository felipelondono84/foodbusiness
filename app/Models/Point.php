<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'nombre', 'direccion', 'telefono'];

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
