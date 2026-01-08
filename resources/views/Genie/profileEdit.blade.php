@extends('genie.genielayout')

@section('page-name', 'Edit Profile')
@section('content')

<div class="container-fluid py-5" style="background:#f7f8fc; min-height:100vh;">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-9 col-md-10">

            <div class="card border-0 p-5"
                 style="
                    background:#ffffff; /* keep form background white */
                    border-radius:20px;
                    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
                    transition: all 0.3s ease;
                 "
                 class="wow fadeInUp">

                <!-- Accent -->
                <div style="
                    width:60px;
                    height:4px;
                    background:#ff4f9a;
                    border-radius:10px;
                    margin-bottom:24px;">
                </div>

                <h2 class="fw-semibold mb-4 text-uppercase" style="color:#2b2b2b;">
                    Edit Profile
                </h2>

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success wow fadeIn">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Validation Errors --}}
                @if($errors->any())
                    <div class="alert alert-danger wow fadeIn">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Profile Edit Form -->
                <form method="POST" action="{{ route('genie.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">

                        <!-- Name -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label fw-medium">Full Name</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   class="form-control p-3 pe-5 rounded-3 form-shadow"
                                   required>
                            <i class="bi bi-pencil position-absolute edit-icon"></i>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label fw-medium">Email Address</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   class="form-control p-3 pe-5 rounded-3 form-shadow"
                                   required>
                            <i class="bi bi-pencil position-absolute edit-icon"></i>
                        </div>

                        <!-- Password -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label fw-medium">
                                New Password <span class="text-muted">(optional)</span>
                            </label>
                            <input type="password"
                                   name="password"
                                   class="form-control p-3 pe-5 rounded-3 form-shadow"
                                   placeholder="Leave blank to keep current">
                            <i class="bi bi-pencil position-absolute edit-icon"></i>
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6 position-relative">
                            <label class="form-label fw-medium">Confirm Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control p-3 pe-5 rounded-3 form-shadow">
                            <i class="bi bi-pencil position-absolute edit-icon"></i>
                        </div>

                    </div>

                    <!-- Submit / Cancel -->
                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4 btn-lg shadow-sm"
                                style="background:#2b2b2b; color:#fff; border-color:#ff4f9a; transition: all 0.3s;">
                            Update Profile
                        </button>
                        <a href="{{ route('genie.profile') }}" class="btn btn-outline-light px-4 btn-lg shadow-sm"
                           style="border-color:#ff4f9a; color:#2b2b2b; transition: all 0.3s;">
                            Cancel
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

{{-- Custom styles --}}
<style>
    .btn-outline-light:hover {
        background:#ff4f9a !important;
        color:#fff !important;
        border-color:#ff4f9a !important;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(255,79,154,0.25);
        border-color:#ff4f9a;
    }

    .edit-icon {
        right:15px;
        top:50%;
        transform: translateY(-50%);
        color:#aaa;
        cursor:pointer;
        font-size:1.1rem;
    }

    .edit-icon:hover {
        color:#ff4f9a;
    }

    /* Rounded inputs with subtle shadow */
    .form-shadow {
        border-radius: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .form-shadow:focus {
        box-shadow: 0 4px 12px rgba(255,79,154,0.25);
    }
</style>

{{-- Focus input when pencil icon clicked --}}
<script>
    document.querySelectorAll('.edit-icon').forEach(icon => {
        icon.addEventListener('click', () => {
            icon.previousElementSibling.focus();
        });
    });

    // WOW.js for animation
    new WOW().init();
</script>

@endsection
