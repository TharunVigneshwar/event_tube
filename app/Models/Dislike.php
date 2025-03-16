<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dislike extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'video_id'];

    /**
     * Relationship: Dislike belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Dislike belongs to a video.
     */
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
