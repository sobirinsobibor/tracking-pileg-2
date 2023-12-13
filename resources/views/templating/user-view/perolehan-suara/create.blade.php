@extends('templating.components.master')

@section('main-content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold">Perolehan Suara {{ $voting_places->voting_place_name }}
                {{ $voting_places->electoral_district_name }}</h5>
            <h5 class="card-title fw-light text-capitalize">{{ $voting_places->voting_place_address }}</h5>
            <h5 class="card-title fw-light text-capitalize  mb-4">{{ $voting_places->sub_district_name }},
                {{ $voting_places->district_name }}, {{ $voting_places->voting_place_city }},
                {{ $voting_places->voting_place_province }}</h5>

            @if (session('message'))
                <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show" role="alert">
                    {{ session('message')['text'] }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr class="mb-1">
                            <th>Nama Pengunggah</th>
                            <th>:</th>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr class="mb-1">
                            <th>NIK</th>
                            <th>:</th>
                            <td>{{ Auth::user()->nik }}</td>
                        </tr>
                        <tr class="mb-1">
                            <th>Telephone</th>
                            <th>:</th>
                            <td>{{ Auth::user()->telephone }}</td>
                        </tr>

                    </table>
                </div>
            </div>
            <form method="POST" action="{{ route('dashboard.user.perolehan-suara') }}">
                @csrf
                <input type="hidden" name="id_voting_place" required readonly
                    value="{{ $voting_places->voting_place_encrypted_id }}">
                <input type="hidden" name="id_user" required readonly value="{{ Auth::user()->id }}">
                <div class="row mb-3">
                    <label class="form-label">Suara Kandidat</label>
                    {{-- {{ !empty($candidate->candidate_name) ? $candidate->candidate_name : 'Kandidat Belum Ada' }} --}}
                    @foreach ($candidates as $item)
                        <div class="col-md-6 mb-3">
                            <label for="candidate_vote_vote_count" class=" col-form-label">
                                {{ $loop->index + 1 }}.{{ $item->candidate_name }}
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" name="id_candidate[]" required readonly
                                    value="{{ $item->candidate_encrypted_id }}">
                                <input type="number" name="candidate_vote_vote_count[]" class="form-control"
                                    id="candidate_vote_vote_count" required min="0">
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="row mb-3">
                    <label class="form-label">Suara Partai</label>
                    @foreach ($parties as $item)
                        <div class="col-md-4 mb-3">
                            <label for="total_vote_vote_count" class="col-form-label"> {{ $loop->index + 1 }}.
                                {{ $item->party_name }} ({{ $item->party_acronym }})</label>
                            <input type="hidden" name="id_party[]" id="id_party" value="{{ $item->party_encrypted_id }}"
                                readonly required>
                            <input type="number" class="form-control" id="total_vote_vote_count"
                                name="total_vote_vote_count[]" required min="0">
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="col-md-4 mb-3">
                            <label class="form-label">FILE</label>
                            <input type="file" class="form-control">
                        </div>
                    @endfor
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                    <label class="form-check-label" for="flexCheckDefault">
                        Pastikan data diisi sudah benar
                    </label>
                </div>
                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    </div>
@endsection
