<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use  HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }

}
