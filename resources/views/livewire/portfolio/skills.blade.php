<section id="skills" class="py-20 bg-slate-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">
                    Habilidades <span class="text-purple-600">&</span> Tecnologías
                </h2>
                <div class="w-24 h-1 bg-linear-to-r from-purple-500 to-pink-500 mx-auto rounded-full"></div>
            </div>

            <!-- Skills Grid -->
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($skills as $skillGroup)
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-12 h-12 bg-linear-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
                                @if($skillGroup['category'] === 'Frontend')
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                @elseif($skillGroup['category'] === 'Backend')
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">{{ $skillGroup['category'] }}</h3>
                        </div>

                        <div class="space-y-4">
                            @foreach($skillGroup['items'] as $skill)
                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm font-medium text-slate-700">{{ $skill['name'] }}</span>
                                        <span class="text-sm font-semibold text-purple-600">{{ $skill['level'] }}%</span>
                                    </div>
                                    <div class="h-2 bg-slate-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-linear-to-r from-purple-500 to-pink-500 rounded-full transition-all duration-1000 ease-out"
                                            style="width: {{ $skill['level'] }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Additional Skills -->
            <div class="mt-12 text-center">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">También trabajo con:</h3>
                <div class="flex flex-wrap justify-center gap-3">
                    @foreach(['Livewire', 'Alpine.js', 'Redis', 'GraphQL', 'Jest', 'Webpack', 'Vite', 'Figma'] as $tech)
                        <span
                            class="px-4 py-2 bg-white rounded-full text-sm font-medium text-slate-700 shadow-sm hover:shadow-md transition-shadow">
                            {{ $tech }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>