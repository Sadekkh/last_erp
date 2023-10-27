<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ServiceDetail extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('ServiceDetail') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }
    protected $table = 'services_details';

    protected $fillable = [
        'product_id',
        'unit',
        'price',
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
