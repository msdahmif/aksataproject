@extends('app')

@section('content')

	<h2>Edit Divisi</h2>
    <hr/>

    <form method="POST" action="{{ url(Request::url()) }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @include('management.item.edit.single', ['label' => 'Nama Divisi', 'id' => 'nama', 'value' => $division->nama])
        @include('management.item.edit.single', ['label' => 'NIM Ketua', 'id' => 'nim_ketua', 'value' => $division->nim_ketua])

        <!-- Buttons -->
        <div class="row">
            <div class="col-xs-6">
                <button class="btn btn-primary col-xs-12">
                    Simpan
                </button>
            </div>
            <div class="col-xs-6">
                <a class="btn btn-danger col-xs-12" id="_batal_button"
                   href="{{ url('management') }}">
                    Batal
                </a>
            </div>
        </div>
        <!-- /Buttons -->
    </form>


@endsection
