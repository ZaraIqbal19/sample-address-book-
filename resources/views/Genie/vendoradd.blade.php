@extends('genie.genielayout')

@section('page-name', 'Vendor Add')
@section('content')

<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="col-md-8 col-lg-6">

        <!-- CARD -->
        <div class="vendor-card p-5">
            <h2 class="text-center mb-4 vendor-title">
                Add New Vendor
            </h2>

            <form method="POST" action="{{ route('genie.vendor.store') }}">
                @csrf

                <!-- NAME -->
                <div class="mb-3">
                    <label class="form-label vendor-label">Vendor Name</label>
                    <input type="text"
                           name="name"
                           class="form-control vendor-input"
                           placeholder="Enter vendor name"
                           required>
                </div>

                <!-- EMAIL -->
                <div class="mb-3">
                    <label class="form-label vendor-label">Vendor Email</label>
                    <input type="email"
                           name="email"
                           class="form-control vendor-input"
                           placeholder="Enter vendor email"
                           required>
                </div>

                <!-- WHATSAPP -->
                <div class="mb-3">
                    <label class="form-label vendor-label">WhatsApp Number</label>
                    <input type="text"
                           name="whatsapp_number"
                           class="form-control vendor-input"
                           placeholder="+923001234567"
                           required>
                </div>

                <!-- SUBCATEGORY -->
                <div class="mb-4">
                    <label class="form-label vendor-label">Subcategory</label>
                    <select name="subcategory_id"
                            class="form-select vendor-select"
                            required>
                        <option value="">Select subcategory</option>
                        @foreach($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">
                                {{ ucfirst($subcategory->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- BUTTON -->
                <div class="d-grid">
                    <button class="btn vendor-btn btn-lg">
                        Save Vendor
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<style>
/* ===== CARD ===== */
.vendor-card {
    background: linear-gradient(180deg, #ffffff, #f8f7ff);
    border-radius: 22px;
    box-shadow: 0 22px 50px rgba(0,0,0,0.08);
    transition: all 0.4s ease;
}

.vendor-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 30px 70px rgba(233,30,99,0.2);
}

/* ===== TITLE (HOT PINK) ===== */
.vendor-title {
    font-weight: 700;
    color: #0a0a0aff; /* HOT PINK */
    letter-spacing: 0.4px;
}

/* ===== LABEL ===== */
.vendor-label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
}

/* ===== INPUTS ===== */
.vendor-input,
.vendor-select {
    border-radius: 14px;
    padding: 14px;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

.vendor-input:focus,
.vendor-select:focus {
    border-color: #e91e63;
    box-shadow: 0 0 0 4px rgba(233,30,99,0.22);
}

/* ===== BUTTON (PURE BLACK) ===== */
.vendor-btn {
    background: #000000; /* PURE BLACK */
    color: #ffffff;
    border: none;
    border-radius: 16px;
    font-weight: 600;
    letter-spacing: 0.4px;
    transition: all 0.3s ease;
}

.vendor-btn:hover {
    background: #111111;
    transform: translateY(-3px);
    box-shadow: 0 14px 35px rgba(0,0,0,0.5);
}
</style>

@endsection
