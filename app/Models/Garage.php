<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Garage extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Garage') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }
    protected $fillable = [
        'name_ar',
        'name_en',
        'address_ar',
        'address_en',
        'rows',
        'columns',
        'plafon'
    ];

    // Relationships
    public function maintenanceOrders()
    {
        return $this->hasMany(MaintenanceOrder::class);
    }
    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
