@extends('layouts.admin')

@section('title', __('Admin sign in'))

@section('body')
    <main class="grid min-h-screen place-items-center px-4 py-10">
        <div class="w-full max-w-sm">
            <a href="{{ route('inicio') }}" class="mb-6 flex items-center justify-center gap-2.5 font-display text-lg font-bold">
                <span class="grid h-[30px] w-[30px] place-items-center rounded-full bg-deep text-mint" aria-hidden="true">L</span>
                LizanDev
            </a>

            <form method="POST" action="{{ route('login.store') }}"
                class="grid gap-5 rounded-2xl border border-line bg-card p-6">
                @csrf
                <h1 class="text-2xl font-bold">{{ __('Admin panel') }}</h1>

                <div>
                    <label for="email" class="mb-1.5 block text-sm font-medium">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        autocomplete="username" class="form-field">
                    @error('email')
                        <span class="mt-1 block text-sm text-red-700" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="mb-1.5 block text-sm font-medium">{{ __('Password') }}</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password"
                        class="form-field">
                </div>

                <label class="flex items-center gap-2 text-sm text-muted">
                    <input type="checkbox" name="recordar" value="1" class="h-4 w-4 accent-brand-700">
                    {{ __('Remember me') }}
                </label>

                <button type="submit"
                    class="rounded-full bg-deep px-6 py-3 font-semibold text-white transition-colors hover:bg-brand-800">
                    {{ __('Sign in') }}
                </button>
            </form>
        </div>
    </main>
@endsection
