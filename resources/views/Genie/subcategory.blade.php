@extends('genie.genielayout')
@section('page-name', 'Subcategory')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Add New Subcategory</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/genie/subcategory/store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Hidden Category ID -->
                        <input type="hidden" name="category_id" value="{{ $category_id }}">

                        <!-- Subcategory Name -->
                        <div class="mb-3">
                            <label class="form-label">Subcategory Name</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Enter subcategory name"
                                required
                            >
                        </div>

                        <!-- Subcategory Image -->
                        <div class="mb-3">
                            <label class="form-label">Subcategory Image</label>
                            <input
                                type="file"
                                name="image"
                                class="form-control"
                                required
                            >
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                Back
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Save Subcategory
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection