@extends('app')

@section('content')

	<h2>Edit Kepengurusan</h2>
    <hr/>

    <form method="POST" action="{{ url(Request::url()) }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @include('management.item.edit.single', ['label' => 'Nama Kepengurusan', 'id' => 'nama', 'value' => $management->nama])
        @include('management.item.edit.single', ['label' => 'NIM Ketua', 'id' => 'nim_ketua', 'value' => $management->nim_ketua])
        @include('management.item.edit.single', ['label' => 'Tanggal Mulai', 'id' => 'tanggal_mulai', 'value' => $management->tanggal_mulai->format('m/d/Y')])

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

    <hr/>

    @foreach ($management->divisions()->where('id_super',null)->get() as $division)
        @include('management.item.edit.division', ['division' => $division, 'depth' => 0])
    @endforeach            

@endsection

@section('script')
    <!-- JQuery UI -->
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap Datepicker -->
    <script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
    <script>$('#tanggal_mulai').datepicker({autoclose: true})</script>
@endsection

