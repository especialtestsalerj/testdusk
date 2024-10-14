@props([
    'id' => 'textarea', // ID padrão
    'name' => 'textarea', // Nome padrão
    'label' => 'Texto:', // Label padrão
    'rows' => 4, // Número de linhas padrão
    'wireModel' => null, // wire:model padrão
    'xRef' => null, // x-ref padrão
    'placeholder' => 'Digite seu texto aqui...', // Placeholder padrão
    'value' => '', // Valor inicial padrão
    'required' => false, // Campo obrigatório padrão
    'dusk' => null,
])


<div {{ $attributes->merge(['class' => 'w-full']) }}>
    <label for="{{ $id }}"
           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        {{ $label }} @if($required) * @endif
    </label>
    <textarea id="{{ $id }}" rows="{{ $rows }}" dusk="{{$id}}"
              name="{{ $name }}"
              @if($wireModel) wire:model="{{ $wireModel }}" @endif
              @if($xRef) x-ref="{{ $xRef }}" @endif
              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300
                     focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                     dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="{{ $placeholder }}">
        {{ old($name, $value) }}
    </textarea>
    <div>
        @error($name)
        <small class="text-danger text-red-700">
            <i class="fas fa-exclamation-triangle"></i>
            {{ $message }}
        </small>
        @enderror
    </div>
</div>

