<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ReplacedProduct extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Request') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }
    protected $fillable = [
        'maintenance_task_id',
        'product_id',
        'old_item_id',
        'new_item_id',
        'truck_id',
        'old_serial_num',
        'oil_amount',
        'wheel_position',
        'old_prod_desc',

    ];
    public function maintenancetask()
    {
        return $this->belongsTo(MaintenanceTask::class, 'maintenance_task_id');
    }
    public function product()
    {
        return $this->belongsTo(product::class);
    }
    public function olditem()
    {
        return $this->belongsTo(StockedItem::class, 'old_item_id');
    }
    public function newitem()
    {
        return $this->belongsTo(StockedItem::class, 'new_item_id');
    }
}
