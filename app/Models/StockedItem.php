<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class StockedItem extends Model
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
        'stock_id',
        'serial_num',
        'unit_storage',
        'unit_left',
        'state',
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
    public function replaceditem()
    {
        return $this->hasMany(replaceditem::class);
    }
}
