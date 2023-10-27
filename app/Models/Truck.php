<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Truck extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Truck') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }
    protected $fillable = [
        'model',
        'year',
        'number_wheels',
        'oil_change',
        'vin',
        'mileage',
        'last_check',
        'next_check',
        'type',
        'source',
    ];

    // Relationships
    public function maintenanceOrders()
    {
        return $this->hasMany(MaintenanceOrder::class);
    }

    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }
}
