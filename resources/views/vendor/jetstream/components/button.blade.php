<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-blue text-uppercase']) }} title="Acessar área restrita">
    {{ $slot }}
</button>
