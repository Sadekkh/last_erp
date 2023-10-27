<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Request extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Request') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }
    protected $fillable = [
        'garage_id',
        'deal_id',
        'date',
        'payment',
        'delay_to',
        'currency',
        'announcement',
        'cash_account',
        'refrence',
        'refrence_number',
        'refrence_date',
        'supply',
        'sales_emp',
        'side_project',
        'delay',
        'state',
        'code',
        'manager_decision',
        'accounts_decision',
    ];

    // Relationships
    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }
    public function requested_item()
    {
        return $this->hasMany(RequestedItem::class);
    }
    public function totalQuantity()
    {
        return $this->requested_item()->selectRaw('request_id,sum(approx_price) as totalprice')->groupBy('request_id');
    }
    public function totalitems()
    {
        return $this->requested_item()->selectRaw('request_id,count(*) as totalitem')->groupBy('request_id');
    }


    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }

}
