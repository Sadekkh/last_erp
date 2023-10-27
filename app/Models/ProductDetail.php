<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductDetail extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('ProductDetail') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }
    protected $fillable = [

        'product_id',
        'model',
        'min_quantity_stored',
        'max_quantity_stored',
        'min_purchase_price',
        'max_purchase_price',
        'selling_price',
        'transport_price',
        'weight',
        'virtual_quantity',
        'request_type',
        'unit',
        'state',
    ];

    // Relationships
    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
