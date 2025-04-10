<div>
    <section class="relative py-20 bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-purple-800 dark:to-indigo-900 mb-2"
             x-data="{
                    showResults: @js(count($movies) > 0 && strlen($search) > 0),
                    hasResults: @js(count($movies) > 0),
                    hasSearched: @js($hasSearched)
                }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6">Entdecke deinen nächsten Lieblingsfilm</h1>
            <p class="text-xl text-purple-100 mb-8 max-w-3xl mx-auto">
                Durchsuche tausende Filme and bewerte diese nach deinem Geschmack!
            </p>
            <div
                class="max-w-6xl mx-auto relative z-20"
            >
                <div class="flex items-center bg-white/10 backdrop-blur-md border border-white/20 rounded-xl shadow-lg overflow-hidden transition-all duration-300" :class="{ 'rounded-b-none border-b-0': showResults && @js(count($movies) > 0) }">
                    <div class="pl-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                    <input
                        type="text"
                        placeholder="Suche nach Filmen..."
                        class="w-full py-4 px-3 text-white bg-transparent placeholder-white/70 focus:outline-none"
                        wire:model.live.debounce.500ms="search"
                        x-on:focus="showResults = true"
                        autocomplete="off"
                    >

                    <div class="px-3" wire:loading>
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>

                    <button
                        class="px-3 text-white/70 hover:text-white transition-colors"
                        wire:click="clearMovieSearch"
                        x-show="@js(strlen($search) > 0 && $hasSearched)"
                        x-cloak
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                @if(count($movies) > 0 && strlen($search) >= 3 && $hasSearched)
                    <div
                        x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-4"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-4"
                        class="bg-white/10 backdrop-blur-md border border-white/20 border-t-0 rounded-b-xl shadow-lg overflow-hidden"
                    >
                        <div class="max-h-[70vh] overflow-y-auto">
                            <div class="px-6 py-3 border-b border-white/10 flex justify-between items-center">
                                <h3 class="font-medium text-white">
                                    {{ count($movies) }} Ergebnis(e)
                                </h3>
                                <a href="#" class="text-sm text-purple-300 hover:text-purple-200 transition-colors">Alle Anzeigen</a>
                            </div>

                            <div class="p-4">
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                                    @foreach($movies as $movie)
                                        <div class="group relative rounded-lg overflow-hidden bg-white/5 hover:bg-white/10 transition-all duration-300">
                                            <div class="aspect-[2/3] relative overflow-hidden">
                                                <img src="{{ $movie['poster'] }}" alt="{{ $movie['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                                    <div class="p-3 w-full">
                                                        <div class="flex justify-between items-center">
                                                            <div class="bg-yellow-400 text-yellow-900 px-1.5 py-0.5 rounded text-xs font-medium">
                                                                {{ $movie['ratings_avg_rating'] }}
                                                            </div>
                                                            <button class="p-1.5 rounded-full bg-white/20 text-white hover:bg-white/30 transition-colors">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="p-3">
                                                <h4 class="font-medium text-white text-sm truncate" title="{{ $movie['title'] }}">
                                                    {{ $movie['title'] }}
                                                </h4>
                                                <p class="text-xs text-white/70 mt-1">{{ $movie['year'] }}</p>
                                            </div>

                                            <a href="{{ route('movie.show', $movie['imdb_id']) }}" class="absolute inset-0" aria-label="View {{ $movie['title'] }}"></a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($hasSearched && count($movies) === 0 && strlen($search) >= 3)
                    <div
                        x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-4"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-4"
                        class="bg-white/10 backdrop-blur-md border border-white/20 border-t-0 rounded-b-xl shadow-lg overflow-hidden p-6 text-center"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-white/50 mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            <line x1="11" y1="8" x2="11" y2="14"></line>
                            <line x1="8" y1="11" x2="14" y2="11"></line>
                        </svg>
                        <h3 class="text-lg font-medium text-white mb-1">Keine Ergebnisse gefunden</h3>
                        <p class="text-white/70">Wir konnten keine Filme finden, nach dem Suchkriterium: "{{ $search }}"</p>
                    </div>
                @endif
            </div>

        </div>
    </section>
</div>
