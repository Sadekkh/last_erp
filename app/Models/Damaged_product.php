<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Damaged_product extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Damaged_product') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }
    protected $fillable = [
        'product_id',
        'stock_item_id',
        'maintenance_order_id',
        'driver_id',
        'reason',
        'state',
        'description',
        'taken_actions',
        'date',

    ];

    // Relationships
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
