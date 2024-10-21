@props([
    'id' => 'input',
    'name' => 'input',
    'label' => 'Campo:',
    'type' => 'text',
    'wireModel' => null,
    'xRef' => null,
    'placeholder' => 'Digite aqui...',
    'value' => '',
    'required' => false,
    'readonly' => false,
    'disabled' => false,
    'autocomplete' => 'off',
    'maxlength' => null,
    'minlength' => null,
    'pattern' => null,
    'step' => null,
    'dusk' => null,
])

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    @if($label && !$attributes->has('no-label'))
        <label for="{{ $id }}"
               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            {{ $label }} @if($required) * @endif
        </label>
    @endif
    <input id="{{ $id }}"
           type="{{ $type }}"
           name="{{ $name }}"
           dusk="{{ $id }}"
           @if($wireModel) wire:model="{{ $wireModel }}" @endif
           @if($xRef) x-ref="{{ $xRef }}" @endif
           @if($placeholder) placeholder="{{ $placeholder }}" @endif
           @if($value) value="{{ $value }}" @endif
           @if($required) required @endif
           @if($readonly) readonly @endif
           @if($disabled) disabled @endif
           @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
           @if($maxlength) maxlength="{{ $maxlength }}" @endif
           @if($minlength) minlength="{{ $minlength }}" @endif
           @if($pattern) pattern="{{ $pattern }}" @endif
           @if($step) step="{{ $step }}" @endif
           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                  focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <div>
        @error($name)
        <small class="text-danger text-red-700">
            <i class="fas fa-exclamation-triangle"></i>
            {{ $message }}
        </small>
        @enderror
    </div>
</div>
