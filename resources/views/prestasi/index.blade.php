@extends('app')

@section('content')

    {{-- NIM --}}
    <h2>{{ $user->nim }}</h2><hr>
    <div class="row">
        {{-- Make a Link to Profile and Divisions --}}

        {{-- Main Content --}}
        @if($prestasis != null)
            @foreach($prestasis as $prestasi)
                <div class="prestasi-card"> {{-- The class still not exist! --}}
                    <div class="prestasi-card-meta"> {{-- The class still not exist! --}}
                        <h3><a href="prestasi/{{ $prestasi->id }}">{{ $prestasi->title }}</a></h3>
                        <p>{{ $prestasi->tanggal->toDayDateTimeString() }}</p>
                    </div>
                    {{ $prestasi->deskripsi }}
                </div>
            @endforeach
        @else
            <h3>There's no achievement for {{ $user->nim }} yet.</h3>
        @endif
    </div>


@endsection