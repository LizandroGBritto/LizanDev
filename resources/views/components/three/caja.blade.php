@props(['w', 'h', 'd', 'color', 'x' => 0, 'y' => 0, 'z' => 0])

{{-- Caja de seis caras para armar el robot. Medidas y posición viajan como variables CSS. --}}
<div class="bot-box"
    style="--w:{{ $w }}px;--h:{{ $h }}px;--d:{{ $d }}px;--c:{{ $color }};--x:{{ $x }}px;--y:{{ $y }}px;--z:{{ $z }}px">
    <i class="fr"></i><i class="bk"></i><i class="lf"></i><i class="rt"></i><i class="tp"></i><i class="bt"></i>
</div>
