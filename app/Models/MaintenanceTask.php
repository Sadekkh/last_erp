<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class MaintenanceTask extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('MaintenanceTask') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }
    protected $fillable = [
        'maintenance_order_id',
        'worker_id',
        'product_id',
        'entry_time',
        'leaving_time',
        'status',
        'description',
    ];

    // Relationships
    public function maintenanceOrder()
    {
        return $this->belongsTo(MaintenanceOrder::class);
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function replaceditem()
    {
        return $this->hasMany(ReplacedProduct::class);
    }
}
