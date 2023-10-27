<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Media extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Media') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }
    protected $table = 'medias';

    protected $fillable = [
        'file_name',
        'entity_id',
        'entity_type',
        'maintenance_orders_id',
    ];

    // Relationships
    public function maintenanceOrder()
    {
        return $this->belongsTo(MaintenanceOrder::class);
    }
}
