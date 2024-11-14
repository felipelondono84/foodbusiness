<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Log extends Model
{
    // use HasFactory;

    use LogsActivity;

    // Define qué atributos deseas registrar en los logs
    protected static $logAttributes = ['user_id', 'action', 'model', 'record_id', 'changes'];
    protected static $logName = 'log';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['user_id', 'action', 'model', 'record_id', 'changes']) // Define los atributos a registrar
            ->useLogName(self::$logName);
    }
}
