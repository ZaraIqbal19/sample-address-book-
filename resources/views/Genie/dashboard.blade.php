@extends('genie.genielayout')
@section('content')

<div class="container-fluid py-5" style="background-color:#121212; min-height:100vh;">

   
    <!-- Welcome Card -->
<div class="row mb-5 justify-content-center">
    <div class="col-md-8">
        <div class="card bg-dark text-center border-0 shadow-sm py-5">
            <h2 class="mb-2" style="color:#FF007F;">Welcome, {{ auth()->user()->name }}!</h2>
            <p class="mb-0 text-light">You're logged in as <strong>{{ ucfirst(auth()->user()->role) }}</strong></p>
        </div>
    </div>
</div>


</div>

@endsection
