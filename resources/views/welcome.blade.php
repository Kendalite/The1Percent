<x-app-layout>
    @include('layouts.bg-rings')
    @include('layouts.access-block')
    @include('layouts.credits-cta')
    <section class="flex flex-col w-full h-screen gap-8 lg:gap-32 items-center justify-around p-8 lg:p-12">
        <h1
            class="text-4xl lg:text-8xl text-white text-center font-extrabold font-sans bg-black border-bronze border-4 rounded-2xl p-6 max-w-screen-xl mx-auto w-full shadow-lg shadow-black">
            {{ __('t1c.welcome.The1Club') }}
        </h1>
        <section
            class="flex flex-col lg:flex-row justify-between items-center max-w-screen-xl mx-auto w-full h-full gap-8 border-2 border-taupe rounded-2xl bg-dark p-6 lg:p-12 shadow-lg shadow-black">
            <div class="flex flex-col gap-8 justify-between w-full h-full">
                <h2 class="text-center text-2xl lg:text-6xl text-white font-bold">{{ __('t1c.welcome.howto') }}</h2>
                <div class="border-2 border-taupe bg-black rounded-2xl flex-1 w-full h-[300px]"></div>
            </div>
            <hr class="max-lg:w-full lg:h-full border-2 border-taupe" />
            <form method="POST" action="#TODO" class="flex flex-col gap-8 justify-between w-full h-full">
                <h2 class="text-center text-2xl lg:text-6xl text-white font-bold">{{ __('t1c.welcome.join') }}</h2>
                <div class="flex flex-col gap-4">
                    <x-rounded-input name="room_code" label="{{ __('t1c.register.roomcode') }}" placeholder="{{ __('t1c.register.roomcode') }}" />
                    <x-rounded-input name="username" label="{{ __('t1c.register.username') }}" placeholder="{{ __('t1c.register.username') }}" />
                </div>
                <button type="submit"
                    class="w-full rounded-2xl border-0 p-3 bg-ocean text-white uppercase text-lg font-bold hover:bg-gold hover:text-black transition-all duration-250">
                    {{ __('t1c.register.join') }}
                </button>
            </form>
        </section>
    </section>
</x-app-layout>
