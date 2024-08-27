<x-app-layout>
    @include('layouts.session-storage', ['poData' => $aaQuestions, 'poType' => 'insert'])
    @include('layouts.access-block')
    @include('layouts.soundboard')
    @include('layouts.bg-rings', ['psClass' => 'bg-rings-ocean', 'psOpacity' => 'opacity-25'])
    <section class="flex flex-col w-full h-screen max-h-screen gap-4 items-center justify-between text-white p-2 lg:p-4 pb-8">
        <div class="relative flex flex-row w-full h-full max-h-[200px] max-sm:max-h-[156px] max-w-screen-2xl items-center max-lg:pt-8 pb-0">
            <div class="absolute w-28 h-28 md:w-48 md:h-48">
                <aside class="absolute rounded-full shrink-0 grow-0 w-28 h-28 md:w-48 md:h-48 bg-transparent border-4 border-transparent px-12 py-8 flex items-center z-30">
                    <p class="text-gold text-2xl md:text-4xl font-bold text-center w-full flex items-baseline justify-center">
                        <span id="t1pPercentBox" class="text-4xl md:text-7xl">100</span>%
                    </p>
                </aside>
                <aside id="radialTimer" class="absolute rounded-full shrink-0 grow-0 w-28 h-28 md:w-48 md:h-48 z-20 customTimerRadial">

                </aside>
            </div>
            <h1 id="t1pQuestionBox"
                class="text-sm md:text-xl lg:text-2xl text-white text-center font-bold font-sans bg-black border-taupe border-4 rounded-xl pl-16 md:pl-32 pr-4 py-2 lg:py-6 mx-auto w-full shadow-lg shadow-black ml-12 md:ml-24 z-20">
                XXX
            </h1>
            <aside class="absolute flex rounded-2xl w-32 bg-dark items-end justify-center border-gold border-4 left-12 max-sm:left-0 md:left-48 lg:left-96 right-auto py-0 pt-4 -top-8 lg:-top-10 z-10">
                <p class="text-white text-2xl">0</p>
            </aside>
            <aside class="absolute flex rounded-2xl max-sm:w-fit w-96 bg-dark items-end justify-center border-gold border-4 left-auto right-0 py-0 pt-4 -top-8 lg:-top-10 z-10">
                <p class="text-white text-xs max-sm:px-4 max-sm:py-2 sm:text-2xl">Username</p>
            </aside>
        </div>
        <section id="t1pIlluBox"
            class="w-full h-full system-dynamic-height flex-initial inline-flex max-w-screen-2xl bg-black border-taupe border-4 rounded-xl items-center justify-center">
            <img src="https://placehold.co/10x10" alt="Question" class="w-full h-fit max-h-full object-contain p-2 lg:p-8" /> 
        </section>
        <form method="POST" id="answerBox" action="{{ route('quiz.checkAnswer') }}" data-retrieveData="{{ route('quiz.retrieveQuestion') }}" data-checkData="{{ route('quiz.checkAnswer') }}"
        class="flex flex-row w-full h-full max-h-[60px] max-w-screen-2xl gap-4 lg:gap-8 items-center justify-between">
            <x-rounded-input name="player_answer" label="" placeholder="{{ __('t1c.game.answer_placeholder') }}" readonly="true" />
            <button type="submit"
                class="w-1/3 md:w-1/4 rounded-2xl border-2 border-emerald px-2 bg-black text-white text-lg font-bold hover:bg-emerald hover:text-black transition-all duration-250">
                {{ __('t1c.game.confirm') }}
            </button>
        </form>
        <section id="controlsShows" class="flex flex-row align-center justify-center gap-4 w-full max-w-screen-2xl">
            <button id="nextQuestion"
            class="rounded-2xl border-2 border-indigo-900 px-8 bg-black text-white text-lg font-bold hover:border-indigo-500 hover:text-gold transition-all duration-250">
            Next Question
            </button>
            <button id="endShow"
            class="rounded-2xl border-2 border-red-900 px-8 bg-black text-white text-lg font-bold hover:border-red-500 hover:text-gold transition-all duration-250">
            endShow
            </button>
        </section>
    </section>
    @pushOnce('head')
        <script type="module" src="{{ asset('js/the1percentLogic.js')}}"></script>
    @endPushOnce
</x-app-layout>
