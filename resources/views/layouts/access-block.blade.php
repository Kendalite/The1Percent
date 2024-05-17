<section class="absolute right-8 top-8 flex flex-col gap-4" x-data="{volume: 100, contrast: 0}">
    <section class="border-2 border-taupe bg-black hover:bg-dark rounded-2xl p-4 shadow-lg shadow-black" x-on:click="volume = ((volume > 0) ? 0 : 100)">
        <img src="{{ asset('assets/volume-on.svg') }}" alt="Volume - ON" class="w-8 h-8" x-show="volume > 0">
        <img src="{{ asset('assets/volume-off.svg') }}" alt="Volume - OFF" class="w-8 h-8" x-show="volume <= 0">
    </section>
    <section class="border-2 border-taupe bg-black hover:bg-dark rounded-2xl p-4 shadow-lg shadow-black" x-on:click="contrast = ((contrast > 0) ? 0 : 1)">
        <img src="{{ asset('assets/eye-on.svg') }}" alt="Contrast - ON" class="w-8 h-8" x-show="contrast <= 0">
        <img src="{{ asset('assets/eye-off.svg') }}" alt="Contrast - OFF" class="w-8 h-8" x-show="contrast > 0">
    </section>
</section>