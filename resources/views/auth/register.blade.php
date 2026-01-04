@extends('user.layout')
@section('content')
<br>
<br>
<br>



<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center"
     style="background: linear-gradient(135deg, #fff1f7, #f8f9ff);">

    <div class="row w-100 shadow-lg rounded-4 overflow-hidden"
         style="max-width: 900px; background:#ffffff;">

        <!-- Image Section -->
        <div class="col-md-6 d-none d-md-block p-0">
            <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9"
                 class="img-fluid h-100 w-100"
                 style="object-fit: cover;">
        </div>

        <!-- Register Form -->
        <div class="col-md-6 p-5"
     style="
        padding-left:3rem;
        box-shadow: -15px 0 30px rgba(0,0,0,0.03);
     ">



            <h1 class="text-center mb-3"
                style="
                    font-family: 'Playfair Display', serif;
                    font-size: 34px;
                    font-weight: 600;
                    color: #ff2f92;
                ">
                Address Book
            </h1>

            <p class="text-center mb-4 text-muted">
                Create your account
            </p>

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger small">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label text-muted fw-semibold">Name</label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           class="form-control rounded-3"
                           required autofocus>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label text-muted fw-semibold">Email</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="form-control rounded-3"
                           required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label text-muted fw-semibold">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control rounded-3"
                           required>
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label class="form-label text-muted fw-semibold">Confirm Password</label>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control rounded-3"
                           required>
                </div>

                <!-- Terms -->
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="form-check mb-4 small text-muted">
                        <input class="form-check-input" type="checkbox" id="terms" required>
                        <label class="form-check-label">
                            I agree to the
                            <a href="{{ route('terms.show') }}" style="color:#ff2f92;">Terms</a>
                            &
                            <a href="{{ route('policy.show') }}" style="color:#ff2f92;">Privacy Policy</a>
                        </label>
                    </div>
                @endif

                <!-- Register Button -->
                <button type="submit"
                        class="btn w-100 text-white py-2"
                        style="
                            background:#ff2f92;
                            border-radius:30px;
                            font-weight:500;
                        ">
                    Register
                </button>

                <!-- Login Link -->
                <p class="text-center mt-4 mb-0" style="font-size:14px;">
                    Already registered?
                    <a href="{{ route('login') }}"
                       style="color:#ff2f92; font-weight:500;">
                        Log in
                    </a>
                </p>

            </form>
        </div>
    </div>
</div>

@endsection
