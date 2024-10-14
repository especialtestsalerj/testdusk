@props([
    'id' => 'select',
    'name' => 'select',
    'label' => 'Selecione:',
    'options' => [],
    'placeholder' => 'Selecione uma opção',
    'selected' => null,
    'wireModel' => null,
    'wireChange' => null,
    'xRef' => null,
    'required' => false,
    'disabled' => false,
    'dusk' => null,
])

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    @if($label && !$attributes->has('no-label'))
        <label for="{{ $id }}"
               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            {{ $label }} @if($required)
                *
            @endif
        </label>
    @endif

    <select name="{{ $name }}" id="{{ $id }}" dusk="{{$id}}"
            @if($wireModel) wire:model="{{ $wireModel }}" @endif
            @if($wireChange) wire:change="{{ $wireChange }}" @endif
            @if($xRef) x-ref="{{ $xRef }}" @endif
            @if($disabled) disabled @endif
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                       focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                       dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $option)
            <option value="{{ $option['value'] ?? $option->id }}"
                {{ ($selected ?? '') == ($option['value'] ?? $option->id) ? 'selected' : '' }}>
                {{ mb_strtoupper($option['text'] ?? $option->name) }}
            </option>
        @endforeach
    </select>

    <div>
        @error($name)
        <small class="text-danger text-red-700">
            <i class="fas fa-exclamation-triangle"></i>
            {{ $message }}
        </small>
        @enderror
    </div>
</div>
