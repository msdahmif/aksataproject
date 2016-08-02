@extends('app')

@section('content')

	<h2>Edit Kepengurusan</h2>
    <hr/>

    @include('management.item.edit.single', ['label' => 'Nama Kepengurusan', 'id' => 'nama', 'value' => $management->nama])
    @include('management.item.edit.single', ['label' => 'NIM Ketua', 'id' => 'nim_ketua', 'value' => $management->nim_ketua])
    @include('management.item.edit.single', ['label' => 'Tanggal Mulai', 'id' => 'tanggal_mulai', 'value' => $management->tanggal_mulai])

    <br/>

    @foreach ($management->divisions()->where('id_super',null)->get() as $division)
        @include('management.item.edit.division', ['division' => $division, 'depth' => 0])
    @endforeach            

    <br/>
    <!-- /Management -->

@endsection

@section('script')
    <!-- JQuery UI -->
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap Datepicker -->
    <script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
    <script>$('#tanggal_mulai').datepicker({autoclose: true})</script>
@endsection

