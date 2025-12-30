@extends('genie.genielayout')
@section('content')
<h2>Add Category</h2>

<form method="POST" action="/genie/category">
    @csrf

    <select name="name" required>
        <option value="">-- Select Category --</option>
        <option value="cosmetics">Cosmetics</option>
        <option value="jewellery">Jewellery</option>
    </select>

    <br><br>
    <button type="submit">Save Category</button>
</form>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

@endsection