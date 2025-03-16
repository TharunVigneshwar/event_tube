<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class View extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['user_id', 'video_id'];

    /**
     * Relationship: Like belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Like belongs to a video.
     */
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
