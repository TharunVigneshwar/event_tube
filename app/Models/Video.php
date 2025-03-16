<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'event_id',
        'title',
        'thumbnail',
        'video',
        'status',
    ];

    /**
     * Relationship: Video has many likes.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Relationship: Video has many views.
     */
    public function views()
    {
        return $this->hasMany(View::class);
    }

    /**
     * Relationship: Video belongs to user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Video belongs to event.
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id')->withTrashed();
    }
}
