<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
