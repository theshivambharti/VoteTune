<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'group',
        'key',
        'value',
        'type',
        'description',
        'is_public',
        'is_encrypted',
        'autoload',
        'sort_order',
        'updated_by',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'is_encrypted' => 'boolean',
        'autoload' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Scope a query to only include autoloaded settings.
     */
    public function scopeAutoload($query)
    {
        return $query->where('autoload', true);
    }

    /**
     * Scope a query to only include settings for a specific group.
     */
    public function scopeGroup($query, $group)
    {
        return $query->where('group', $group);
    }
}
