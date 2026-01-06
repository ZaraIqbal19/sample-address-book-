@extends('genie.genielayout')

@section('page-name', 'Profile')
@section('content')

<div class="container-fluid py-5" style="background:#f7f8fc; min-height:100vh;">

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-9 col-md-10">

            <div class="card border-0 p-5"
                 style="
                    background:#ffffff;
                    border-radius:18px;
                    box-shadow: 0 15px 35px rgba(0,0,0,0.06);
                 ">

                <!-- Subtle Accent -->
                <div style="
                    width:60px;
                    height:4px;
                    background:#ff4f9a;
                    border-radius:10px;
                    margin-bottom:24px;">
                </div>

                <!-- Welcome Text -->
                <h1 class="fw-semibold mb-2 text-uppercase" style="color:#2b2b2b;">
                    Welcome {{ auth()->user()->name }},
                </h1>
                <hr>

                <p class="fs-5 mb-4" style="color:#6b7280;">
                    We're glad to see you on your profile page.
                </p>

                <!-- Role Info -->
                <div class="d-inline-flex align-items-center px-4 py-2"
                     style="
                        background:#fff1f7;
                        color:#ff4f9a;
                        border-radius:30px;
                        font-weight:500;
                        font-size:15px;
                     ">
                    {{ ucfirst(auth()->user()->role) }} Access
                </div>

            </div>

        </div>
    </div>

</div>

@endsection
