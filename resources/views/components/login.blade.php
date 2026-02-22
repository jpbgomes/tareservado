<?php

use Livewire\Component;

new class extends Component {
    public $email;
    public $password;
    public $remember = false;

    public function login()
    {
        dd('ABC');

        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $key = 'login:' . request()->ip() . '|' . $this->email;

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'general' => __('auth.login.errors.too_many_attempts', [
                    'seconds' => $seconds,
                ]),
            ]);
        }

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], (bool) $this->remember)) {
            RateLimiter::hit($key, 60);

            $this->addError('general', __('auth.login.errors.invalid_credentials'));
            return;
        }

        RateLimiter::clear($key);

        session()->regenerate();

        return redirect()->route('home');
    }
};
?>

<div>
    <h1>{{ __('auth.login.title') }}</h1>

    <p class="text-center text-white text-lg mb-10">
        {{ __('auth.login.description') }}
    </p>

    @if ($errors->any())
        <div
            {{ $attributes->merge([
                'class' => 'w-full rounded-lg border border-red-300 bg-red-200 text-white px-3 py-2 transition-all duration-1000',
            ]) }}>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li class="text-red-500 text-sm font-medium">
                        {{ ucfirst(strtolower($error)) }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <form wire:submit.prevent="login">
        @csrf

        <input placeholder="{{ __('auth.login.email_placeholder') }}" type="email" wire:model="email" id="email"
            name="email" autocomplete="email" />

        <input placeholder="{{ __('auth.login.password_placeholder') }}" type="password" wire:model="password"
            id="password" name="password" autocomplete="current-password" />

        <label class="mb-5 flex items-center gap-3 text-sm text-white">
            <input type="checkbox" wire:model="remember" id="remember" name="remember" class="w-4 h-4 ml-2" />
            <span>{{ __('auth.login.remember') }}</span>
        </label>

        <button type="submit" variant="primary">
            {{ __('auth.login.submit') }}
        </button>

        @if (Route::has('register'))
            <button href="{{ route('register') }}" variant="secondary">
                {{ __('auth.login.register_cta') }}
            </button>
        @endif

    </form>
</div>
