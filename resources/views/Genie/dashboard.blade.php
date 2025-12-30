@extends('genie.genielayout')
@section('content')

<div class="container-fluid py-4" style="background-color:#121212; min-height:100vh;">

    <!-- Stats Cards -->
    <div class="row mb-4">
        @php
            $cards = [
                ['title'=>"Today's Money",'value'=>'$53k','icon'=>'weekend','color'=>'#FF007F','change'=>'+55% than last week'],
                ['title'=>"Today's Users",'value'=>'2,300','icon'=>'person','color'=>'#FF007F','change'=>'+3% than last month'],
                ['title'=>"New Clients",'value'=>'3,462','icon'=>'person','color'=>'#FF007F','change'=>'-2% than yesterday'],
                ['title'=>"Sales",'value'=>'$103,430','icon'=>'weekend','color'=>'#FF007F','change'=>'+5% than yesterday']
            ];
        @endphp

        @foreach ($cards as $card)
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card bg-dark text-white border-0">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape" style="background: {{$card['color']}}; text-align:center; border-radius:12px; width:50px; height:50px; line-height:50px; position:absolute; top:-20px; left:15px;">
                        <i class="material-icons opacity-10">{{$card['icon']}}</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">{{$card['title']}}</p>
                        <h4 class="mb-0">{{$card['value']}}</h4>
                    </div>
                </div>
                <hr class="horizontal dark my-0">
                <div class="card-footer p-3">
                    <p class="mb-0" style="color:#FF007F;">{{$card['change']}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Simplified Projects Table -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card bg-dark text-white border-0">
                <div class="card-header pb-0">
                    <h6 style="color:#FF007F;">Projects Overview</h6>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0 text-white">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Project</th>
                                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-7">Budget</th>
                                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-7">Completion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Redesign Website</td>
                                    <td class="text-center">$14,000</td>
                                    <td class="text-center">
                                        <div class="progress" style="height:8px; background:#333;">
                                            <div class="progress-bar" role="progressbar" style="width:60%; background:#FF007F;"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Mobile App Launch</td>
                                    <td class="text-center">$20,500</td>
                                    <td class="text-center">
                                        <div class="progress" style="height:8px; background:#333;">
                                            <div class="progress-bar" role="progressbar" style="width:100%; background:#FF007F;"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>New Pricing Page</td>
                                    <td class="text-center">$500</td>
                                    <td class="text-center">
                                        <div class="progress" style="height:8px; background:#333;">
                                            <div class="progress-bar" role="progressbar" style="width:25%; background:#FF007F;"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
