@extends('genie.genielayout')
@section('content')
<form method="POST" action="{{ route('genie.vendor.store') }}">
@csrf

<input type="text" name="name" class="form-control mb-3" placeholder="Vendor Name" required>

<input type="email" name="email" class="form-control mb-3" placeholder="Vendor Email" required>

<input type="text"
       name="whatsapp_number"
       class="form-control mb-3"
       placeholder="WhatsApp Number (e.g. +923001234567)"
       required>

<select name="subcategory_id" class="form-select mb-3" required>
    <option value="">— Select Subcategory —</option>
    @foreach($subcategories as $subcategory)
        <option value="{{ $subcategory->id }}">
            {{ ucfirst($subcategory->name) }}
        </option>
    @endforeach
</select>

<button class="btn btn-dark">Save Vendor</button>
</form>
@endsection