<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Service extends Model
{
    use HasFactory;

protected $fillable = [
    'name',
    // 'form_title',
    'description',
    'price',
    'icon',
    'is_active',
    'fields_json',    // ✅ DB column
    'documents_json', // ✅ DB column
];

    /**
     * Cast JSON columns to arrays automatically.
     * This is the KEY fix — without this, $service->fields is a plain
     * string and @foreach fails silently (or throws).
     */
protected $casts = [
    'fields_json'    => 'json',  // ✅ 'array' ki jagah 'json' use karo
    'documents_json' => 'json',  // ✅ string bhi handle karega, array bhi
    'price'          => 'decimal:2',
    'is_active'      => 'boolean',
];

    // ── Scopes ────────────────────────────────────────────────

    /** Only services marked active (used in frontend query). */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ── Relationships ─────────────────────────────────────────

    /** All applications submitted for this service. */
    public function applications()
    {
        return $this->hasMany(ServiceApplication::class);
    }
}
