<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class MaintenanceOrder extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('MaintenanceOrder') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }
    protected $fillable = [
        'truck_id',
        'truck_trailer_id',
        'driver_id',
        'workshop_id',
        'diag_emp',
        'status',
        'entry_time',
        'approximate_leaving_time',
        'leaving_time',
        'complain',
        'reason',
        'source',
        'entry_state',
        'code',

    ];


    // Relationships
    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }
    public function trailer()
    {
        return $this->belongsTo(Truck::class, 'truck_trailer_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    public function mainteancetask()
    {
        return $this->hasMany(MaintenanceTask::class);
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }
    public function worker()
    {
        return $this->hasMany(worker::class);
    }
}
