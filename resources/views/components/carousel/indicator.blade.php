<!-- Slider indicators -->
@if($count ?? 0)
    <div class="indicators absolute z-30 flex  -translate-x-1/2 bottom-5 left-1/2">
        @foreach(range(0, $count - 1) as $i)
            <button type="button" class="w-3 h-3 mx-2 rounded-full border-color_1 border" aria-current="false" aria-label="Slide {{ $i }}" data-carousel-slide-to="{{ $i }}"></button>
        @endforeach
    </div>
@endif
