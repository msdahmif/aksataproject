@extends('app')

@section('content')

    {{-- NIM --}}
    <h2>{{ $user->nim }}</h2><hr>
    <div class="row">
        {{-- Make a Link to Profile and Divisions --}}

        {{-- Main Content --}}
        @if($achievements != null)
            @foreach($achievements as $achievement)
                <div class="achievement-card"> {{-- The class still not exist! --}}
                    <div class="achievement-card-meta"> {{-- The class still not exist! --}}
                        <h3><a href="achievement/{{ $achievement->id }}">{{ $achievement->title }}</a></h3>
                        <p>{{ $achievement->tanggal->toDayDateTimeString() }}</p>
                    </div>
                    {{ $achievement->deskripsi }}
                </div>
            @endforeach
        @else
            <h3>There's no achievement for {{ $user->nim }} yet.</h3>
        @endif
    </div>


@endsection