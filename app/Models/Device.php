<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Device extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens;
    protected $guarded = [];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function alerts()
    {
        return $this->morphToMany(Alert::class, 'alert_tables');
    }
    public function flowData()
    {
        return $this->hasMany(FlowData::class);
    }
    public function tempData()
    {
        return $this->hasMany(TempData::class);
    }
}
