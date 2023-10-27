<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ColorVariation extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('ColorVariation') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }

    protected $table = 'colorvariations';

    protected $fillable = [
        'product_id',
        'color',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
