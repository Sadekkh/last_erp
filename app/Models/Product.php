<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Product') // Corrected method name for log name
            ->logAll(); // Log all attributes when changes occur
    }
    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'image',
        'type',
        'category_id',
        'code',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function productdetail()
    {
        return $this->hasMany(productdetail::class);
    }
    public function servicedetail()
    {
        return $this->hasMany(ServiceDetail::class);
    }
    public function media()
    {
        return $this->hasMany(media::class, 'entity_id')->where('entity_type', 'product');
    }

    public function stock()
    {
        return $this->hasMany(stock::class);
    }
    public function replaceditem()
    {
        return $this->hasMany(replaceditem::class);
    }
    public function stockeditem()
    {
        return $this->hasMany(stockeditem::class, 'product_id');
    }
    public function stockedquantity()
    {
        return $this->stockeditem()->selectRaw('product_id,count(*) as totalitem,sum(unit_storage) as stored, sum(unit_left) as unitleft')->groupBy('product_id');
    }
}
