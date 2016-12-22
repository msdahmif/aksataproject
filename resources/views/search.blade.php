@extends('app')

@section('stylesheet')
    <style>
        .search-item {
            margin-top: 20px;
        }
    </style>
@endsection

@section('content')
    @include('search.form')

    <p>Menemukan {{ count($result) }} hasil untuk <strong>{{ $q or '' }}</strong></p>

    <div class="container-fluid row">
        @foreach ($result as $profile)
            <div class="search-item col-xs-6">
                <div class="media-left">
                    <img class="media-object" src="{{ asset($profile->foto_url) }}" style="width: 50px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><a class="button" href="{{ url('profile/' . $profile->nim) }}">{{ $profile->nama_lengkap }}</a></h4>
                </div>
            </div>
        @endforeach
    </div>

@endsection
