@extends('genie.genielayout')
@section('content')
<br>
<br>
<br>

<div class="container py-5" style="max-width: 600px;">
    <div class="card shadow-sm rounded-4 border-0 p-4" style="background: #fff8ff;">
        <h2 class="text-center mb-4" style="color: #ff2f92; font-family: 'Playfair Display', serif;">
            Add New Category
        </h2>

        <form method="POST" action="/genie/category">
            @csrf

            {{-- Category Select --}}
            <div class="mb-4">
                <label for="name" class="form-label fw-semibold" style="color:#333;">Select Category</label>
                <select id="name" name="name" class="form-select form-select-lg shadow-sm" required>
                    <option value="">-- Select Category --</option>
                    <option value="cosmetics">Cosmetics</option>
                    <option value="jewellery">Jewellery</option>
                </select>
            </div>

            {{-- Submit Button --}}
            <div class="d-grid">
                <button type="submit" class="btn btn-lg text-white" style="background:#ff2f92; transition: all 0.3s;">
                    Save Category
                </button>
            </div>
        </form>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success mt-4 text-center shadow-sm rounded-3">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>

<style>
/* Card hover effect */
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    transition: all 0.3s ease-in-out;
}

/* Select hover/focus */
select.form-select:focus {
    border-color: #ff2f92;
    box-shadow: 0 0 0 0.2rem rgba(255, 47, 146, 0.25);
}

/* Button hover */
button.btn:hover {
    background: #ff63b0 !important;
    transform: translateY(-2px);
}
</style>

@endsection
