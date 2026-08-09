<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_code',
        'name',
        'status',
    ];

    public function host()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
