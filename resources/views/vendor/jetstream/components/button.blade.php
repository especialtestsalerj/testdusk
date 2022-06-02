<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary text-uppercase']) }} title="Acessar área restrita">
    {{ $slot }}
</button>
