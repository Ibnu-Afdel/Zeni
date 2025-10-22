@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/plyr@3.7.8/dist/plyr.css" />
    <style>
        :root {
            --plyr-color-main: #4f46e5;
        }

        .plyr--video .plyr__controls {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/plyr@3.7.8/dist/plyr.min.js"></script>
    <script>
        let playerInstance = null;

        function initializePlayer() {
            const videoElement = document.querySelector('#plyr-video');
            if (videoElement) {
                if (playerInstance) {
                    playerInstance.destroy();
                }
                playerInstance = new Plyr(videoElement);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            initializePlayer();
        });

        Livewire.on('player-reload', () => {
            setTimeout(() => {
                initializePlayer();
            }, 150);
        });
    </script>
@endpush

<div class="mb-8 overflow-hidden bg-black rounded-lg shadow-lg">
    @if ($currentLesson->video_url && filter_var($currentLesson->video_url, FILTER_VALIDATE_URL))
        @php
            $videoUrl = str_replace('youtube.com/embed', 'youtube-nocookie.com/embed', $currentLesson->video_url);
            $videoUrl .= (str_contains($videoUrl, '?') ? '&' : '?') . 'rel=0&modestbranding=1&showinfo=0';
            $isEmbed = str_contains($videoUrl, 'youtube-nocookie.com/embed') || str_contains($videoUrl, 'player.vimeo.com/video');
        @endphp

        @if ($isEmbed)
            <div class="relative aspect-[16/9] w-full">
                <div class="absolute z-10 text-xs pointer-events-none select-none text-white/50 sm:text-sm bottom-3 right-3">
                    {{ Auth::user()->email }}
                </div>
                <div wire:key="player-{{ $currentLesson->id }}" class="w-full h-full">
                    <iframe id="plyr-video" src="{{ $videoUrl }}" class="absolute top-0 left-0 w-full h-full" allowfullscreen
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        frameborder="0">
                    </iframe>
                </div>
            </div>
        @else
            <div class="flex items-center justify-center text-center text-white bg-gray-800 aspect-[16/9]">
                <div>
                    <i class="mb-2 text-4xl text-red-400 fas fa-video-slash"></i>
                    <p class="text-lg">Video cannot be embedded.</p>
                    <p class="text-sm text-gray-300">Please use a valid YouTube or Vimeo embed URL.</p>
                </div>
            </div>
        @endif
    @else
        <div class="flex items-center justify-center text-gray-500 bg-gray-200 rounded aspect-[16/9]">
            <div class="text-center">
                <i class="mb-2 text-4xl text-gray-400 fas fa-photo-video"></i>
                <p>Video not available for this lesson.</p>
            </div>
        </div>
    @endif
</div>

