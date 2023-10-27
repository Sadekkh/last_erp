<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Workshop') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }
    protected $fillable = [
        'name_ar',
        'name_en',
        'address_ar',
        'address_en',
    ];

    // Relationships
    public function maintenanceOrders()
    {
        return $this->hasMany(MaintenanceOrder::class);
    }
}
