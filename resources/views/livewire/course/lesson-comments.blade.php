<div class="space-y-6">
    <!-- Comment Form -->
    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Add a comment
            </label>
            <textarea wire:model.defer="body" 
                id="comment"
                rows="4"
                placeholder="Share your thoughts or ask a question..."
                class="block w-full px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors"></textarea>
            @error('body')
                <span class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" 
            wire:loading.attr="disabled"
            wire:target="save"
            class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
            <span wire:loading wire:target="save" class="flex items-center">
                <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                Posting...
            </span>
            <span wire:loading.remove wire:target="save" class="flex items-center">
                <i class="fa-solid fa-paper-plane mr-2"></i>
                Post Comment
            </span>
        </button>
    </form>

    <!-- Comments List -->
    <div class="space-y-4 pt-4 border-t border-gray-200 dark:border-gray-700">
        @forelse ($comments as $comment)
            <div wire:key="comment-{{ $comment->id }}" 
                class="bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-lg p-4 md:p-5">
                <!-- Comment Header -->
                <div class="flex items-start gap-3 mb-3">
                    <div class="flex items-center justify-center w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-full flex-shrink-0">
                        <i class="fa-solid fa-user text-primary-600 dark:text-primary-500"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <a href="{{ route('user.profile', ['username' => $comment->user->username]) }}"
                            class="font-semibold text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                            {{ $comment->user->name }}
                        </a>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            {{ $comment->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>

                <!-- Comment Body -->
                <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed mb-3 ml-13">
                    {{ $comment->body }}
                </p>

                <!-- Reply Button -->
                <button wire:click="replyTo({{ $comment->id }})"
                    class="ml-13 inline-flex items-center text-xs font-medium text-primary-600 dark:text-primary-500 hover:text-primary-700 dark:hover:text-primary-400 transition-colors">
                    <i class="fa-solid fa-reply mr-1"></i>
                    Reply
                </button>

                <!-- Reply Form -->
                @if ($parentId === $comment->id)
                    <form wire:submit.prevent="save" class="mt-4 ml-13 space-y-3 p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg">
                        <textarea wire:model.defer="body" 
                            rows="3"
                            placeholder="Write a reply..."
                            class="block w-full px-3 py-2 text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500 focus:border-transparent transition-colors"></textarea>
                        @error('body')
                            <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                        <div class="flex gap-2">
                            <button type="submit"
                                wire:loading.attr="disabled"
                                wire:target="save"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-lg transition-colors disabled:opacity-50">
                                <span wire:loading wire:target="save" class="flex items-center">
                                    <i class="fa-solid fa-spinner fa-spin mr-1"></i>
                                    Posting...
                                </span>
                                <span wire:loading.remove wire:target="save">
                                    Post Reply
                                </span>
                            </button>
                            <button type="button" wire:click="$set('parentId', null)"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg transition-colors">
                                Cancel
                            </button>
                        </div>
                    </form>
                @endif

                <!-- Replies -->
                @if ($comment->replies->count())
                    <div class="mt-4 ml-13 pl-4 space-y-3 border-l-2 border-primary-200 dark:border-primary-800">
                        @foreach ($comment->replies as $reply)
                            <div wire:key="reply-{{ $reply->id }}" 
                                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-3 md:p-4">
                                <div class="flex items-start gap-3 mb-2">
                                    <div class="flex items-center justify-center w-8 h-8 bg-primary-100 dark:bg-primary-900/30 rounded-full flex-shrink-0">
                                        <i class="fa-solid fa-user text-sm text-primary-600 dark:text-primary-500"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('user.profile', ['username' => $reply->user->username]) }}"
                                            class="font-semibold text-sm text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-500 transition-colors">
                                            {{ $reply->user->name }}
                                        </a>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $reply->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed ml-11">
                                    {{ $reply->body }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <!-- Empty State -->
            <div class="text-center py-12">
                <i class="fa-solid fa-comments text-4xl text-gray-300 dark:text-gray-600 mb-3"></i>
                <p class="text-sm text-gray-600 dark:text-gray-400">No comments yet. Be the first to comment!</p>
            </div>
        @endforelse
    </div>
</div>
