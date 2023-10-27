<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Stock extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Stock') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }
    protected $fillable = [
        'product_id',
        'supplier_id',
        'request_id',
        'garage_id',
        'brands_id',
        'tax',
        'price',


        'rows',
        'columns',
        'reference',
        'purchase_date',
        'expiry_date',
        'guarantee_expiry_date'
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function requestedItem()
    {
        return $this->belongsTo(RequestedItem::class);
    }
    public function stocktransaction()
    {
        return $this->hasMany(stocktransaction::class);
    }
    public function stockeditem()
    {
        return $this->hasMany(stockeditem::class);
    }
    public function stockedquantity()
    {
        return $this->stockeditem()->selectRaw('stock_id,count(*) as totalitem,sum(unit_storage) as stored, sum(unit_left) as unitleft')->where('state', 'available')->groupBy('stock_id');
    }
}
