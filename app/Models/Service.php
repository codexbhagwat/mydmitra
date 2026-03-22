<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'description', 'price', 'icon', 'is_active'];

    protected $casts = ['is_active' => 'boolean', 'price' => 'decimal:2'];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
