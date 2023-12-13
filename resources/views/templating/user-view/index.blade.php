@extends('templating.components.master')

@section('main-content')
    @php
        $isRegisteredToTPS = App\Models\DetailLocationOfVotingPlace::where('id_user', Auth::user()->id)->count();
    @endphp
    @if( $isRegisteredToTPS > 0) {{-- kl sudah ada tpsnya  --}}
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold">Selamat Datang di {{ $voting_places->voting_place_name }},
                    {{ $voting_places->electoral_district_name }} </h5>
                <h5 class="card-title fw-light text-capitalize mb-4">{{ $voting_places->sub_district_name }},
                    {{ $voting_places->district_name }}, {{ $voting_places->voting_place_city }},
                    {{ $voting_places->voting_place_province }}
                </h5>
            </div>
        </div>
    @else
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold">Anda Belum Terdaftar Dalam TPS Manapun, Silakan Hubungi Admin</h5>
        </div>
    </div>
    @endif
@endsection
@section('js-page')
   
@endsection
