<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alert extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function areas()
    {
        return $this->morphedByMany(Area::class, 'alert_tables');
    }

    public function devices()
    {
        return $this->morphedByMany(Device::class, 'alert_tables');
    }
}
