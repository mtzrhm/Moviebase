<div class="max-w-5xl mx-auto p-6 space-y-6">
    <h2 class="text-2xl font-bold text-foreground mb-4">Meine Bewertungen</h2>

    @forelse($ratings as $rating)
        <div class="flex items-start p-4 rounded-xl shadow-md gap-4 dark:border-zinc-700 dark:bg-zinc-900">
            <img src="{{ $rating['movie']->poster }}" alt="" class="w-24 h-auto rounded-lg shadow">

            <div class="flex-1">
                <h3 class="text-xl font-semibold text-foreground">
                    {{ $rating['movie']->title }} ({{ $rating['movie']->year }})
                </h3>

                <p class="text-sm text-muted-foreground">{{ $rating['movie']->genre }}</p>

                <div class="mt-2 flex items-center gap-4 text-sm">
                    <span>⭐ <strong>{{ $rating['average_rating'] }}</strong> Durchschnitt</span>
                    <span>👥 {{ $rating['total_votes'] }} Bewertungen</span>
                </div>

                <div class="mt-2">
                    <span class="text-sm text-muted-foreground">Meine Bewertung:</span>
                    <div class="flex flex-row mt-2">
                        <div class="flex space-x-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $rating['user_rating'] ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.518 4.674h4.92c.969 0 1.371 1.24.588 1.81l-3.977 2.89 1.518 4.674c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.978 2.89c-.784.57-1.838-.197-1.539-1.118l1.518-4.674-3.977-2.89c-.783-.57-.38-1.81.588-1.81h4.92l1.518-4.674z"/>
                                </svg>
                            @endfor
                        </div>
                        <button
                            wire:click="deleteRating({{ $rating['user_rating_id'] }})"
                            class="text-sm text-red-600 hover:underline cursor-pointer ms-5"
                        >
                            ❌ Löschen
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted-foreground">Du hast bisher noch keine Filme bewertet.</p>
    @endforelse
</div>
