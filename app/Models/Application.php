<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['user_id', 'service_id', 'status', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'completed'   => 'badge-completed',
            'in_progress' => 'badge-progress',
            default       => 'badge-pending',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'completed'   => 'Completed',
            'in_progress' => 'In Progress',
            default       => 'Pending',
        };
    }
}
