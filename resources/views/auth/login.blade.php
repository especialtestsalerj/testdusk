<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    {{--<x-jet-label for="email" value="{{ __('Login ALERJ') }}" />--}}

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" :value="old('email')" placeholder="{{ __('Login ALERJ') }}" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    {{--<x-jet-label for="password" value="{{ __('Password') }}" />--}}

                    <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                 id="password" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <div class="custom-control custom-checkbox">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <label class="custom-control-label" for="remember_me">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-end align-items-baseline">
                        @if (Route::has('password.request'))
                            <a class="text-muted me-3" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-jet-button>
                            {{ __('Entrar') }}
                        </x-jet-button>
                    </div>
                </div>

                <div class="mb-0 text-center">
                    <span class="mb-3 mb-md-0 text-muted">Copyright © 2023 Intranet - {{ config('app.owner') }}</span>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
