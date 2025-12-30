@extends('user.layout')
@section('content')
<x-guest-layout>
    <x-authentication-card>
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

<x-validation-errors class="mb-4 bg-dark text-white" />

<div class="p-4 rounded" style="background:#111;">

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label" style="color:#ff2f92;">Name</label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="form-control bg-dark text-white border-secondary"
                   required autofocus>
        </div>

        <div class="mb-3">
            <label class="form-label" style="color:#ff2f92;">Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="form-control bg-dark text-white border-secondary"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label" style="color:#ff2f92;">Password</label>
            <input type="password"
                   name="password"
                   class="form-control bg-dark text-white border-secondary"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label" style="color:#ff2f92;">Confirm Password</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control bg-dark text-white border-secondary"
                   required>
        </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
        <div class="form-check mb-3">
            <input class="form-check-input"
                   type="checkbox"
                   id="terms"
                   required>
            <label class="form-check-label text-light small">
                I agree to the
                <a href="{{ route('terms.show') }}" style="color:#ff2f92;">Terms</a>
                &
                <a href="{{ route('policy.show') }}" style="color:#ff2f92;">Privacy Policy</a>
            </label>
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('login') }}"
               class="small text-secondary">
                Already registered?
            </a>

            <button type="submit"
                    class="btn btn-sm text-white"
                    style="background:#ff2f92;">
                Register
            </button>
        </div>

    </form>
</div>

    </x-authentication-card>
</x-guest-layout>
@endsection