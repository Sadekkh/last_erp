<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Driver extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Driver') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }
    protected $fillable = ['cin', 'name_ar', 'name_en', 'phone'];

    // Relationships
    public function maintenanceOrders()
    {
        return $this->hasMany(MaintenanceOrder::class);
    }

}
