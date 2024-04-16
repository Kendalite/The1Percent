@props([
    'psVolumeId' => 'player-audio-container',
    'piPropId' => 0,
])

<div class="player-audio-container" id="{{ $psVolumeId }}" data-prop="{{ $piPropId }}" x-data="{
    duration: 0,
    volume: 100,
    active: -1,
    mute: -1,
}">
    <audio src="{{ asset('/storage/jukebox/The1Percent_Intro.mp3') }}" preload=”metadata” loop></audio>
    <p>Audio Player</p>
    <div class="flex flex-row items-center w-full gap-4">
        <div class="flex flex-row items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                id="play-icon-{{ $piPropId }}" stroke="currentColor" class="w-6 h-6 player-audio-start"
                x-on:click="active = 1" x-show="active < 0">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                id="pause-icon-{{ $piPropId }}" stroke="currentColor" class="w-6 h-6 player-audio-start"
                x-on:click="active = -1" x-show="active > 0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25v13.5m-7.5-13.5v13.5" />
            </svg>
        </div>
        <div class="flex flex-row items-center gap-4">
            <span class="player-audio-time" id="current-time-{{ $piPropId }}">0:00</span>
            <input type="range" class="player-time-slider" id="seek-slider-{{ $piPropId }}" max="100"
                value="0" step="1">
            <span class="player-audio-time" id="duration-{{ $piPropId }}">0:00</span>
        </div>
        <div class="flex flex-row items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6" x-on:click="active = -1" id="stop-icon-{{ $piPropId }}">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5.25 7.5A2.25 2.25 0 0 1 7.5 5.25h9a2.25 2.25 0 0 1 2.25 2.25v9a2.25 2.25 0 0 1-2.25 2.25h-9a2.25 2.25 0 0 1-2.25-2.25v-9Z" />
            </svg>
        </div>
    </div>
    <div class="flex flex-row items-center w-full gap-4">
        <div class="flex flex-row items-center">
            <output class="player-volume-output" id="volume-output-{{ $piPropId }}" x-text="volume">100</output>
        </div>
        <div class="flex flex-row items-center">
            <input type="range" class="player-audio-slider" id="volume-slider-{{ $piPropId }}" max="100" x-model="volume"
                value="100" step="1">
        </div>
        <div class="flex flex-row items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                id="mute-icon-{{ $piPropId }}" stroke="currentColor" class="w-6 h-6 player-mute-icon"
                x-on:click="mute = 1" x-show="mute < 0">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                id="unmute-icon-{{ $piPropId }}" stroke="currentColor" class="w-6 h-6 player-mute-icon"
                x-on:click="mute = -1" x-show="mute > 0">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.25 9.75 19.5 12m0 0 2.25 2.25M19.5 12l2.25-2.25M19.5 12l-2.25 2.25m-10.5-6 4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
            </svg>
        </div>
    </div>
</div>
