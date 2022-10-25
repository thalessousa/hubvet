<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Store extends Model
{
    use  HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function sector(): HasMany
    {
        return $this->hasMany(Sector::class);
    }

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
    
}