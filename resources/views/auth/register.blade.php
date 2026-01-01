@extends('user.layout') {{-- Ye layout me navbar/footer already include hoga --}}
@section('content')

<div class="container py-5" style="max-width: 500px;">
    <h1 class="text-center mb-4" style="color:#ff2f92; font-family:'Playfair Display', serif;">Address Book</h1>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="mb-3 p-2 text-white bg-dark rounded">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="p-4 rounded" style="background:#111;">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label" style="color:#ff2f92;">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control bg-white text-dark" required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label" style="color:#ff2f92;">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control bg-white text-dark" required>
            </div>

            <div class="mb-3">
                <label class="form-label" style="color:#ff2f92;">Password</label>
                <input type="password" name="password" class="form-control bg-white text-dark" required>
            </div>

            <div class="mb-3">
                <label class="form-label" style="color:#ff2f92;">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control bg-white text-dark" required>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="form-check mb-3 text-white">
                <input class="form-check-input" type="checkbox" id="terms" required>
                <label class="form-check-label">
                    I agree to the
                    <a href="{{ route('terms.show') }}" style="color:#ff2f92;">Terms</a>
                    & 
                    <a href="{{ route('policy.show') }}" style="color:#ff2f92;">Privacy Policy</a>
                </label>
            </div>
            @endif

            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('login') }}" class="small text-white">Already registered?</a>
                <button type="submit" class="btn" style="background:#ff2f92; color:#fff;">Register</button>
            </div>
        </form>
    </div>
</div>

@endsection
