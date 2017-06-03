@extends('app')

@section('content')
    <div class="row">
        <div>
            <h2>{{ $prestasi->title }}</h2>
            <h6>{{ $prestasi->tanggal->toDayDateTimeString() }}</h6>
        </div>
        {{ $prestasi->deskipsi }} {{-- Still not support for markdown! --}}
    </div>
@endsection