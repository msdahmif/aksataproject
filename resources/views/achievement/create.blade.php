@extends('app')

@section('content')
    <form method="POST" action="{{ url('prestasi/create') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Insert title here...">
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal"> {{-- Not working with Firefox! --}}
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Insert text here..."></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Publish</button>
        </div>

        @include ('layouts.errors')
    </form>
@endsection