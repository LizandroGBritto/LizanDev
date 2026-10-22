@props(['lines' => 3])

<div {{ $attributes->class(['robot-container']) }}>
    <div class="robot-head">
        <div class="antenna antenna-left">
            <div class="antenna-ball"></div>
        </div>
        <div class="antenna antenna-right">
            <div class="antenna-ball"></div>
        </div>

        <div class="robot-eyes">
            <div class="eye eye-left">
                <div class="pupil"></div>
            </div>
            <div class="eye eye-right">
                <div class="pupil"></div>
            </div>
        </div>

        <div class="robot-mouth"></div>
    </div>

    <div class="robot-body">
        <div class="control-panel">
            <div class="indicator"></div>
            <div class="indicator indicator-delay-1"></div>
            <div class="indicator indicator-delay-2"></div>
        </div>

        <div class="code-lines">
            @for ($i = 0; $i < $lines; $i++)
                <div class="code-line"></div>
            @endfor
        </div>
    </div>

    @foreach (['left', 'right'] as $side)
        <div class="robot-arm robot-arm-{{ $side }}">
            <div class="arm-upper"></div>
            <div class="arm-lower"></div>
            <div class="hand">
                <div class="finger"></div>
                <div class="finger"></div>
                <div class="finger"></div>
            </div>
        </div>
    @endforeach

    <div class="robot-legs">
        @foreach (['left', 'right'] as $side)
            <div class="leg leg-{{ $side }}">
                <div class="leg-upper"></div>
                <div class="leg-lower"></div>
                <div class="foot"></div>
            </div>
        @endforeach
    </div>
</div>
