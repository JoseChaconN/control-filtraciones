<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    /**
     * Obtener los dispositivos asociados con el área.
     */
    public function devices()
    {
        return $this->hasMany(Device::class);
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
