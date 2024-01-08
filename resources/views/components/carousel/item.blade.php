<!-- Item 1 -->
<div {{ $attributes->merge(['class' => 'hidden ease-in-out duration-'.($duration??1000)]) }} data-carousel-item>
    <div>

        {{ $slot }}
    </div>
</div>
