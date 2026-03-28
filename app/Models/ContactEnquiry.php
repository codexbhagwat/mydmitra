<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactEnquiry extends Model
{
    protected $table = 'contact_enquiries';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'service',
        'type',
        'message',
    ];
}
