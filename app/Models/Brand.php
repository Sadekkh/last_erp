<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Brand extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Brand') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }
    protected $table = 'brands';

    protected $fillable = [
        'name_ar',
        'name_en',
    ];

    public function ProductDetail()
    {
        return $this->hasMany(ProductDetail::class);
    }
    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
