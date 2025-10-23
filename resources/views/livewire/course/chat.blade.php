<div class="flex flex-col h-screen md:max-w-2xl md:mx-auto bg-white">
    <div class="flex-1 overflow-y-auto px-4 py-4 bg-gray-50" id="chat-messages">
        <div class="flex flex-col space-y-2">
            @foreach ($convo as $message)
                @php
                    $isMe = Auth::check() && isset($message['user_id']) && ($message['user_id'] === Auth::id());
                @endphp
                <div class="flex w-full {{ $isMe ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[75%] px-3 py-2 rounded-2xl shadow-sm {{ $isMe ? 'bg-green-600 text-white rounded-br-none' : 'bg-gray-100 text-gray-800 border border-gray-200 rounded-bl-none' }}">
                        @unless($isMe)
                            <div class="mb-0.5 text-xs font-medium text-gray-600">{{ $message['username'] }}</div>
                        @endunless
                        <div class="text-sm leading-relaxed break-words">{{ $message['message'] }}</div>
                        <div class="mt-1 text-[11px] {{ $isMe ? 'text-green-100' : 'text-gray-500' }}">
                            {{ \Carbon\Carbon::parse($message['created_at'])->diffForHumans() }}
                        </div>
                    </div>
                </div>
            @endforeach
            <div id="scroll-anchor"></div>
        </div>
    </div>

    @if ($isEnrolled)
        <form wire:submit.prevent="sendMessage" class="border-t border-gray-200 px-4 py-3 bg-white">
            <div class="flex items-center gap-2">
                <input type="text" wire:model="message" placeholder="Type your message..."
                    class="flex-1 px-3 py-2 text-sm bg-gray-50 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-full hover:bg-indigo-700 disabled:opacity-60"
                    wire:loading.attr="disabled" wire:target="sendMessage">
                    <span wire:loading.remove wire:target="sendMessage">Send</span>
                    <span wire:loading wire:target="sendMessage">Sending…</span>
                </button>
            </div>
        </form>
    @else
        <div class="border-t border-gray-200 px-4 py-3">
            <p class="p-3 text-center text-sm text-red-600 bg-red-50 border border-red-200 rounded">
                You must be enrolled in this course to participate in the chat.
            </p>
        </div>
    @endif
</div>

<script>
    document.addEventListener('livewire:load', function() {
        const scrollAnchor = document.getElementById('scroll-anchor');

        function scrollToBottom() {
            scrollAnchor?.scrollIntoView({ behavior: 'smooth' });
        }

        // Initial scroll to bottom
        scrollToBottom();

        // After every Livewire DOM update
        Livewire.hook('message.processed', () => {
            scrollToBottom();
        });

        // After local send
        Livewire.on('message-sent', scrollToBottom);
    });
</script>
