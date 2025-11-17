@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/plyr@3.7.8/dist/plyr.css" />
    <style>
        :root {
            --plyr-color-main: #22c55e;
        }

        .plyr--video .plyr__controls {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        }

        .plyr__control--overlaid {
            background: rgba(34, 197, 94, 0.9);
        }

        .plyr__control--overlaid:hover {
            background: rgba(34, 197, 94, 1);
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
                playerInstance = new Plyr(videoElement, {
                    controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'settings', 'pip', 'airplay', 'fullscreen'],
                    settings: ['captions', 'quality', 'speed'],
                });
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

<div class="relative bg-black">
    @if ($currentLesson->video_url && filter_var($currentLesson->video_url, FILTER_VALIDATE_URL))
        @php
            $videoUrl = str_replace('youtube.com/embed', 'youtube-nocookie.com/embed', $currentLesson->video_url);
            $videoUrl .= (str_contains($videoUrl, '?') ? '&' : '?') . 'rel=0&modestbranding=1&showinfo=0';
            $isEmbed = str_contains($videoUrl, 'youtube-nocookie.com/embed') || str_contains($videoUrl, 'player.vimeo.com/video');
        @endphp

        @if ($isEmbed)
            <div class="relative aspect-video w-full">
                <!-- Watermark -->
                <div class="absolute z-10 bottom-16 right-4 text-xs sm:text-sm pointer-events-none select-none text-white/40 font-mono bg-black/20 px-2 py-1 rounded backdrop-blur-sm">
                    {{ Auth::user()->email }}
                </div>
                
                <!-- Video Player -->
                <div wire:key="player-{{ $currentLesson->id }}" class="w-full h-full">
                    <iframe id="plyr-video" 
                        src="{{ $videoUrl }}" 
                        class="absolute top-0 left-0 w-full h-full" 
                        allowfullscreen
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        frameborder="0">
                    </iframe>
                </div>
            </div>
        @else
            <!-- Invalid Video URL -->
            <div class="flex items-center justify-center aspect-video bg-gray-900">
                <div class="text-center px-4">
                    <i class="fa-solid fa-video-slash text-5xl text-red-400 mb-4"></i>
                    <h3 class="text-lg font-semibold text-white mb-2">Video Cannot Be Embedded</h3>
                    <p class="text-sm text-gray-400">Please use a valid YouTube or Vimeo embed URL.</p>
                </div>
            </div>
        @endif
    @else
        <!-- No Video Available -->
        <div class="flex items-center justify-center aspect-video bg-gray-900">
            <div class="text-center px-4">
                <i class="fa-solid fa-photo-video text-5xl text-gray-600 mb-4"></i>
                <h3 class="text-lg font-semibold text-white mb-2">No Video Available</h3>
                <p class="text-sm text-gray-400">Video not available for this lesson.</p>
            </div>
        </div>
    @endif
</div>
