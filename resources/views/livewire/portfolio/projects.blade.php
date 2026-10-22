<div>
    <section id="projects" class="py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="mb-16 max-w-2xl">
                    <h2 class="text-4xl md:text-5xl font-semibold text-slate-900 mb-4">
                        {{ __('Projects') }}
                    </h2>
                    <p class="text-slate-600 text-lg">
                        {{ __("A selection of projects I've recently worked on") }}
                    </p>
                </div>

                @foreach ($groups as $group)
                    <div class="mb-16">
                        <div class="flex items-center gap-3 mb-8">
                            <x-portfolio.icon-badge :icon="$group['icon']" />
                            <h3 class="text-2xl md:text-3xl font-semibold text-slate-900">{{ $group['title'] }}</h3>
                        </div>

                        @foreach ($group['projects'] as $project)
                            <x-portfolio.project-card :project="$project" />
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div id="imageModal" data-image-modal hidden role="dialog" aria-modal="true" aria-label="{{ __('Image viewer') }}"
        class="fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4" data-modal-close>
        <button type="button" data-modal-close aria-label="{{ __('Close') }}"
            class="absolute top-4 right-4 text-white hover:text-brand-400 transition-colors z-10">
            <x-icon name="close" class="w-9 h-9" />
        </button>
        <div class="max-w-7xl max-h-full flex flex-col items-center">
            <img data-image-modal-img src="" alt="" class="max-w-full max-h-[85vh] object-contain rounded-md">
            <p data-image-modal-caption class="text-white text-lg mt-4 text-center"></p>
        </div>
    </div>
</div>
