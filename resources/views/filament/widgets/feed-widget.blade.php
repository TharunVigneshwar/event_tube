@php
    $now = now();
    // Get all videos that have been approved and sort them by likes and creation time
    $videos = \App\Models\Video::where('status', 'Public')
        ->withCount('likes')
        ->orderByDesc('likes_count')
        ->orderByDesc('created_at')
        ->get()
        ->groupBy('event_id')
        // Filter out events that have a status of 'Inactive' or have ended
        ->filter(function ($event_videos, $event_id) use ($now) {
            $event = $event_videos->first()->event;
            if (!$event) {
                return false;
            }
            if ($event->status === 'Inactive') {
                return false;
            }
            $event_start_date = $event->start_date;
            $event_end_date = $event->end_date;
            if ($now->between($event_start_date, $event_end_date)) {
                // Event is ongoing, update its status to 'Active'
                $event->update(['status' => 'Active']);
            } else {
                // Event has ended, update its status to 'Inactive'
                $event->update(['status' => 'Inactive']);
                return false;
            }
            return true;
        });
@endphp
@if ($videos->isEmpty())
    <p class="text-center text-gray-500">No videos found.</p>
@else
    @foreach ($videos->sortByDesc(function ($event_videos, $event_id) {
        return $event_videos->first()->event->created_at;
    }) as $event_id => $event_videos)
        <p class="text-2xl font-medium tracking-wide">{{ optional($event_videos->first()->event)->name }}</p>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
          {{--  @foreach ($event_videos->take(6) as $video) --}}
		 @foreach ($event_videos as $video)
                <x-filament::widget>
                    <x-filament::card class="relative">
                        <script src="/js/htmx.min.js" defer></script>
                        <div class="flex flex-col space-y-2">
                            <div class="absolute top-0 left-0 h-52 w-full rounded-lg overflow-hidden">
                                <a href="{{ env('APP_URL') }}/video-player/{{ $video->id }}">
                                    <div class="relative h-52 w-full rounded-lg overflow-hidden">
                                        <img class="object-cover w-full h-full"
                                            src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}"
                                            hx-get="{{ route('video-api.view', $video) }}">
                                    </div>
                                </a>
                            </div>
                            <div class="flex flex-col justify-between pt-48">
                                <div class="flex flex-col">
                                    <a href="{{ env('APP_URL') }}/video-player/{{ $video->id }}">
                                        <div class="flex justify-between items-center">
                                            <h2 class="text-base font-medium tracking-wide sm:text-base truncate">
                                                {{ $video->title }}
                                            </h2>
                                        </div>
                                    </a>
                                    <div class="text-sm text-gray-500 pt-1">
                                        By <a href="#">{{ $video->user->name }}</a>
                                    </div>
                                </div>
                                <div class="flex pt-1">
                                    <div class="flex" hx-swap="outerHTML" hx-trigger="click">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            fill="{{ \App\Models\Like::where('user_id', auth()->user()->id)->where('video_id', $video->id)->exists()? '#448ee4': 'none' }}"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="w-6 h-6 cursor-pointer">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                                        </svg>
                                        <span class="text-gray-500 mx-2">
                                            {{ $video->likes->count() }}
                                        </span>
                                    </div>
                                    <div class="flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="text-gray-500 mx-2">
                                            {{ $video->views->count() }} views
                                            &#8226;
                                            {{ $video->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-filament::card>
                </x-filament::widget>
            @endforeach
        </div>
    {{--   @if ($event_videos->count() > 6)
            <div class="card-footer">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 show-more-button"
                    hx-swap="outerHTML" hx-trigger="click" hx-get="{{ route('video-api.index', $event_id) }}">
                    Show More
                </button>
            </div>
        @endif  --}}
    @endforeach
@endif
