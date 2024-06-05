<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TempData extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
