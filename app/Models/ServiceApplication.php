<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'user_id',
        'field_data',
        'documents',
        'status',
    ];

    protected $casts = [
        'field_data' => 'array',
        'documents'  => 'array',
    ];

    // Statuses: pending | processing | completed | rejected
    const STATUS_PENDING    = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED  = 'completed';
    const STATUS_REJECTED   = 'rejected';

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
