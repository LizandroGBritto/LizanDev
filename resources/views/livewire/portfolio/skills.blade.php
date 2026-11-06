<div>
    <section id="skills" class="tech on-deep bg-deep text-mint" data-tech
        data-label-uses="{{ __('Where I used it') }}" data-label-none="{{ __('No project associated in this selection.') }}">
        <div class="tech-layout mx-auto max-w-7xl px-5 pt-[26px] pb-[22px] lg:px-12 lg:py-[34px]">
            <div class="tech-head">
                <p class="eyebrow">{{ __('Skills') }}</p>
                <h2 class="mt-2 max-w-[22ch] text-[clamp(1.5rem,3vw,2.25rem)] leading-[1.1] font-bold text-white">
                    {{ __('Technologies I have worked with') }}
                </h2>
            </div>

            <div class="tech-side">
                <div class="tech-info" aria-live="polite">
                    <div class="tech-vacio">
                        <small class="tech-info__etiqueta">{{ __('Tap a technology') }}</small>
                        <p class="text-sm text-mint-soft">
                            {{ __('Pick one from the ring: the robot holds it and tells you where I used it.') }}</p>
                    </div>

                    <div class="tech-lleno">
                        <div class="flex items-center justify-between gap-2.5">
                            <small class="tech-info__etiqueta" data-tech-category></small>
                            <button type="button" class="tech-info__soltar" data-tech-release>{{ __('Release') }}</button>
                        </div>
                        <h3 class="text-2xl font-bold text-white" data-tech-name></h3>
                        <p class="text-sm text-mint-soft" data-tech-uses-label></p>
                        <ul class="tech-info__usos flex flex-wrap gap-1.5" data-tech-uses></ul>
                    </div>
                </div>
            </div>

            <div class="tech-stage">
                <x-three.robot>
                    <div class="bot-orbit" style="--n:{{ count($technologies) }}" role="group"
                        aria-label="{{ __('Technologies') }}">
                        @foreach ($technologies as $tech)
                            <div class="bot-chip" style="--i:{{ $loop->index }}" data-tech-chip>
                                <button type="button" class="bot-chip__btn" aria-pressed="false"
                                    data-tech-pick="{{ $tech['name'] }}" data-category="{{ $tech['category'] }}"
                                    data-uses="{{ implode('|', $tech['uses']) }}">{{ $tech['name'] }}</button>
                            </div>
                        @endforeach
                    </div>
                </x-three.robot>
            </div>
        </div>
    </section>
</div>
