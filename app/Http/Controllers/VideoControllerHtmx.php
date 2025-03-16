<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Like;
use App\Models\Video;
use App\Models\View;
use Illuminate\Http\Request;

class VideoControllerHtmx extends Controller
{
    public function index(Request $request, $event_id)
    {
        $event = Event::findOrFail($event_id);
        $videos = $event->videos()->orderBy('created_at', 'desc')->skip(6)->get();

        return view('filament.pages.index', [
            'videos' => $videos,
        ]);
    }

    public function like(Request $request, Video $video)
    {

        $userLikes = Like::where('user_id', $request->user()->id)->where('video_id', $video->id);

        if ($userLikes->exists()) {
            $userLikes->delete();
        } else {
            $video->likes()->create([
                'user_id' => $request->user()->id,
            ]);
        }

        return view('videos.like', [
            'video' => $video,
        ]);
    }

    public function views(Request $request, Video $video)
    {

        $userViews = View::where('user_id', $request->user()->id)->where('video_id', $video->id);

        if (! $userViews->exists()) {
            $video->views()->create([
                'user_id' => auth()->id(),
            ]);
        }

        return view('videos.view', [
            'video' => $video,
        ]);
    }
}
