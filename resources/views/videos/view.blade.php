<h2 class="text-base font-medium tracking-wide sm:text-base line-clamp-2" hx-trigger="click"
    hx-get="{{ route('video-api.view', $video) }}">
    {{ $video->title }}
</h2>
