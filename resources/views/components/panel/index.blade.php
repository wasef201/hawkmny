<x-base-layout>
    <div class="my-10" >
        <x-panel.toolbar :title="$title ?? null"
                         :create-label="$createLabel ?? null"
                         :create-route="$createRoute ?? null"
                         :href="$href ?? null">
            {{ $toolBarActions ?? null }}
        </x-panel.toolbar>
        <x-card {{ $attributes->class('mb-5 mb-xl-10 min-vh-70')->except(['title', 'href']) }} padding="{{ $padding ?? 'p-10' }}">
            {{ $slot }}
        </x-card>
    </div>
</x-base-layout>
