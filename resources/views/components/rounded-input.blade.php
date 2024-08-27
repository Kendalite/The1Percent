@props([
    'readonly' => false,
    'label' => false,
    'labelClass' => '',
    'name' => false,
    'type' => 'text',
    'disabled' => null,
    'iconInput' => null,
    'parentClasses' => '',
])

<div class="w-full flex flex-col gap-2 {{ $parentClasses }}">
    @if (!empty($label))
        <label for="{{ $name }}" class="font-bold py-2 text-3xl text-white/50 {{ $labelClass }}">{{ $label }}</label>
    @endif
    <div class="relative ">
        @if (!empty($iconInput))
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <img src="{{ $iconInput }}" class="w-5 h-5" alt="Icon">
            </div>
        @endif
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} {!! $attributes->class([
                    'w-full bg-black text-white block border border-2 border-gold placeholder-white/25 px-4 py-2 rounded-2xl leading-6 focus:border-lightOcean focus:ring focus:ring-ocean focus:ring-opacity-50 appearance-none' .
                    ($iconInput ? ' pl-10' : ''),
                    (isset($disabled) && $disabled) ? 'bg-gray-800' : '',
                ])->merge(['type' => 'text']) !!}>
        <x-input-error class="mt-1" :messages="$errors->get('siret')" />
    </div>
</div>
