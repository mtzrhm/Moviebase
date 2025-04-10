<section class="relative">
    <div class="absolute inset-0 bg-black">
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="flex flex-col md:flex-row gap-8">
            <div class="flex-shrink-0 w-full md:w-1/3 lg:w-1/4">
                <div class="relative aspect-[2/3] rounded-xl overflow-hidden shadow-2xl">
                    <img
                        src="{{ $movie->poster }}"
                        alt="{{ $movie->title }} poster"
                        class="w-full h-full object-cover"
                    >
                </div>
            </div>

            <div class="flex-1">
                <div class="flex flex-col h-full justify-between">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">
                            {{ $movie->title }} <small>({{ $movie->year }})</small>
                        </h1>
                        <p class="text-muted-foreground mb-2">
                            {{ $movie->genre }} • {{ $movie->runtime }} min • {{ $movie->released_at?->format('d.m.Y') ?? 'Keine Angabe' }}
                        </p>
                        <p class="text-muted-foreground mb-2">
                            IMDb: ⭐ {{ $movie->imdb_rating }}
                        </p>
                        <p class="text-muted-foreground mb-6">
                            Moviebase: ⭐ {{ $this->averageRating }} ({{ $this->ratingCounter }} Stimme/n)
                        </p>
                        <p class="text-gray-300 text-lg mb-4"><b>Beschreibung:</b> <span class="italic">{{ $movie->plot }}</span></p>
                    </div>

                    @auth
                        <button wire:click="openModal"
                                class="px-4 py-2 bg-gradient-to-br from-purple-600 to-indigo-600 text-white rounded hover:cursor-pointer transition max-w-36">
                            Jetzt bewerten
                        </button>
                    @else
                        <div class="flex flex-col items-center p-4 rounded-xl w-full text-center">
                            <p class="mb-4 text-sm text-muted-foreground">Du musst eingeloggt sein, um eine Bewertung abzugeben.</p>
                            <flux:link class="text-sm cursor-pointer" :href="route('login')">
                                Jetzt anmelden
                            </flux:link>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        @if($showModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white dark:bg-gray-900 p-6 rounded-2xl w-full max-w-md shadow-xl relative min-w-[500px]">
                    <button wire:click="closeModal" class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                        ✕
                    </button>

                    <h2 class="text-xl font-bold mb-6 text-foreground">Wie fandest du "{{ $movie->title }}"?</h2>

                    <div class="flex space-x-2 justify-center my-5">
                        @for($i = 1; $i <= 5; $i++)
                            <button wire:click="$set('rating', {{ $i }})" class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 .587l3.668 7.431L24 9.748l-6 5.84 1.417 8.257L12 18.896l-7.417 4.949L6 15.588 0 9.748l8.332-1.73z"/>
                                </svg>
                            </button>
                        @endfor
                    </div>

                    <button wire:click="submitRating" class="w-full mt-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
                        Bewertung abgeben
                    </button>
                </div>
            </div>
        @endif
    </div>
</section>
