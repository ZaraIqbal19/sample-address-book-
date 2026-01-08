{{-- resources/views/contact.blade.php --}}
@extends('user.layout')

@section('content')
<div class="container my-5">

    {{-- PAGE HEADING --}}
    <h3 class="mb-4 text-center text-white wow fadeInDown" style="font-family:'Playfair Display', serif;">📬 Contact Us</h3>
    <p class="text-center text-white mb-5 wow fadeIn" data-wow-delay="0.2s" style="font-family:Poppins, sans-serif;">
        Have questions or suggestions? We’d love to hear from you! Fill out the form below and we’ll get back to you promptly.
    </p>

    <div class="row justify-content-center">
        <div class="col-lg-7 col-12">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show wow fadeIn" data-wow-delay="0.3s" style="background-color:#1b1b1b; color:#fff; border:1px solid #ff2a95;">
                    {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="wow fadeInUp" data-wow-delay="0.4s">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label text-white">Name *</label>
                    <input type="text" name="name" id="name"
                           class="form-control rounded-pill bg-dark text-white border border-secondary @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label text-white">Email *</label>
                    <input type="email" name="email" id="email"
                           class="form-control rounded-pill bg-dark text-white border border-secondary @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label text-white">Subject</label>
                    <input type="text" name="subject" id="subject"
                           class="form-control rounded-pill bg-dark text-white border border-secondary @error('subject') is-invalid @enderror"
                           value="{{ old('subject') }}">
                    @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label for="message" class="form-label text-white">Message *</label>
                    <textarea name="message" id="message" rows="6"
                              class="form-control rounded-3 bg-dark text-white border border-secondary @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-gradient-pink w-100 py-2 fw-bold">
                    Send Message
                </button>

            </form>

        </div>
    </div>

</div>

{{-- CUSTOM STYLES --}}
<style>
/* Buttons */
.btn-gradient-pink {
    background: linear-gradient(135deg,#ff2a95,#ff57b0);
    color: #fff;
    transition: all 0.3s;
    border-radius: 50px;
}
.btn-gradient-pink:hover {
    background: linear-gradient(135deg,#d31876,#ff2a95);
    box-shadow: 0 0 12px #ff2a95;
}

/* Form controls */
.form-control {
    transition: all 0.3s;
}
.form-control:focus {
    border-color: #ff2a95;
    box-shadow: 0 0 0 0.2rem rgba(255, 42, 149, 0.25);
    outline: none;
    background-color: #1b1b1b;
    color: #fff;
}

/* Rounded inputs */
.rounded-pill { border-radius: 50px !important; }
.rounded-3 { border-radius: 0.75rem !important; }

/* Alerts */
.alert { border-radius: 0.5rem; }

/* Text accent */
.text-pink { color: #ff2a95 !important; }
</style>

{{-- WOW.js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    new WOW().init();
</script>
@endsection
