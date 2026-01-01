@extends('user.layout')
@section('content')
<x-guest-layout>
    <x-authentication-card>

        <!-- Logo -->
        <x-slot name="logo">
            <h1 class="text-center mb-3"
                style="
                    font-family: 'Playfair Display', serif;
                    font-size: 32px;
                    font-weight: 600;
                    letter-spacing: 1px;
                    color: #ff2f92;
                ">
                Address Book
            </h1>
        </x-slot>

        <!-- Validation Errors -->
        <x-validation-errors class="mb-3" />

        <!-- Status Message -->
        @session('status')
            <div class="mb-3 text-success small">
                {{ $value }}
            </div>
        @endsession

        <!-- Form Card -->
        <div class="p-4 rounded" style="background:#111;">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <x-label for="email"
                             value="Email"
                             class="fw-semibold"
                             style="color:#ff2f92;" />

                    <x-input id="email"
                             type="email"
                             name="email"
                             :value="old('email')"
                             required autofocus
                             class="block w-100 mt-1 bg-white text-dark border" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <x-label for="password"
                             value="Password"
                             class="fw-semibold"
                             style="color:#ff2f92;" />

                    <x-input id="password"
                             type="password"
                             name="password"
                             required
                             class="block w-100 mt-1 bg-white text-dark border" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-3">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm" style="color:#ffffff;">
                            Remember me
                        </span>
                    </label>
                </div>

                <!-- Actions -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <!-- Forgot Password -->
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           style="
                                color:#ff2f92;
                                font-size:14px;
                                font-weight:500;
                                text-decoration:underline;
                           ">
                            Forgot your password?
                        </a>
                    @endif
                    

                    <!-- Login Button -->
                    <button type="submit"
                            class="btn text-white px-4 ms-3"
                            style="background:#ff2f92;">
                        Log in
                    </button>
                </div>
            </form>
        </div>

    </x-authentication-card>
</x-guest-layout>
@endsection
