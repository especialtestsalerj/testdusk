{{-- resources/views/components/select2.blade.php --}}
@props([
    'name',
    'id',
    'options',
    'selected' => null,
    'placeholder' => 'Selecione',
    'multiple' => false,
    'class' => '',
    'label' => null,
    'required' => false,
    'wireChange' => null,
    'dusk' => null,
])

<div class="relative">
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-1">
            {{ $label }} @if($required) * @endif
        </label>
    @endif
    <select
        name="{{ $name }}"
        dusk="{{$id}}"
        id="{{ $id }}"
        {{ $multiple ? 'multiple' : '' }}
        x-ref={{ $name }}
        @if($wireChange) wire:change="{{$wireChange}}" @endif
        {{ $attributes->merge(['class' => "select2 form-select block w-full mt-1 rounded-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 $class"]) }}
    >
        @if (!$multiple)
            <option value="">{{ $placeholder }}</option>
        @endif
        @foreach($options as $option)
            <option
                value="{{ $option['value'] }}" {{ (is_array($selected) && in_array($option['value'], $selected)) || ($option['value'] == $selected) ? 'selected' : '' }}>
                {{ $option['text'] }}
            </option>
        @endforeach
    </select>
</div>
