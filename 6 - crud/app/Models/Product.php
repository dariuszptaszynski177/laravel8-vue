<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producer;

class Product extends Model
{
    use HasFactory;

    public function producer()
    {
        return $this->belongsTo(Producer::class, 'producer_id', 'id');
    }
}
