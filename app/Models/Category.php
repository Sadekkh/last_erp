<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Category') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }
    protected $fillable = [
        'name_ar',
        'name_en',
    ];

    // Relationships
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
