<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class StockTransaction extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('StockTransaction') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }
    protected $fillable = [
        'garage_id',
        'workshop_id',
        'maintenance_orders_id',
        'truck_id',
        'stocked_item_id',
        'stock_employee_id',
        'worker_id',
        'quantity_taken',
        'transaction_date',
    ];

    // Relationships
    public function garage()
    {
        return $this->belongsTo(Garage::class, 'garage_id');
    }
    public function workshop()
    {
        return $this->belongsTo(Workshop::class, 'workshop_id');
    }
    public function maintenanceOrder()
    {
        return $this->belongsTo(MaintenanceOrder::class, 'maintenance_orders_id');
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }

    public function stocked_item()
    {
        return $this->belongsTo(StockedItem::class);
    }

    public function stockEmployee()
    {
        return $this->belongsTo(User::class, 'stock_employee_id');
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}
