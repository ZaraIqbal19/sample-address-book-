@extends('genie.genielayout')

@section('page-name', 'Category')
@section('content')

<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="col-md-7 col-lg-6">

        <!-- CARD -->
        <div class="category-card p-5">
            <h2 class="text-center mb-4 category-title">
                Add New Category
            </h2>

            <form method="POST" action="/genie/category" id="categoryForm">
                @csrf

                <!-- SELECT -->
                <div class="mb-4">
                    <label class="form-label category-label">
                        Select Category
                    </label>
                    <select name="name"
                            id="categorySelect"
                            class="form-select form-select-lg category-select"
                            required>
                        <option value="">Choose category</option>
                        <option value="cosmetics">Cosmetics</option>
                        <option value="jewellery">Jewellery</option>
                    </select>
                </div>

                <!-- BUTTON -->
                <div class="d-grid">
                    <button type="submit"
                            class="btn category-btn btn-lg"
                            id="saveBtn"
                            disabled>
                        Save Category
                    </button>
                </div>
            </form>

            <!-- SUCCESS -->
            @if(session('success'))
                <div class="alert success-alert text-center mt-4">
                    {{ session('success') }}
                </div>
            @endif
        </div>

    </div>
</div>

<style>
/* ===== CARD ===== */
.category-card {
    background: linear-gradient(180deg, #ffffff, #f9fafb);
    border-radius: 22px;
    box-shadow: 0 24px 55px rgba(0,0,0,0.08);
    transition: all 0.4s ease;
}

.category-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 34px 80px rgba(0,0,0,0.15);
}

/* ===== TITLE ===== */
.category-title {
    font-weight: 700;
    color: #e91e63; /* HOT PINK */
    letter-spacing: 0.4px;
}

/* ===== LABEL ===== */
.category-label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
}

/* ===== SELECT ===== */
.category-select {
    border-radius: 14px;
    padding: 16px;
    border: 1px solid #e5e7eb;
    background-color: #fff;
    transition: all 0.3s ease;
}

.category-select:focus {
    border-color: #e91e63;
    box-shadow: 0 0 0 4px rgba(233,30,99,0.25);
}

/* ===== BUTTON ===== */
.category-btn {
    background: #000000; /* PURE BLACK */
    color: #ffffff;
    border: none;
    border-radius: 16px;
    font-weight: 600;
    letter-spacing: 0.4px;
    transition: all 0.3s ease;
}

.category-btn:hover:not(:disabled) {
    background: #111111; /* slightly lighter black on hover */
    transform: translateY(-3px);
    box-shadow: 0 14px 35px rgba(0,0,0,0.45);
}

.category-btn:disabled {
    background: #9ca3af;
    color: #ffffff;
    cursor: not-allowed;
    box-shadow: none;
}

/* ===== SUCCESS ===== */
.success-alert {
    background: #fff1f7;
    color: #ad1457;
    border-radius: 14px;
    font-weight: 500;
    padding: 14px;
}
</style>

<script>
const select = document.getElementById('categorySelect');
const btn = document.getElementById('saveBtn');

select.addEventListener('change', () => {
    btn.disabled = !select.value;
});
</script>

@endsection
