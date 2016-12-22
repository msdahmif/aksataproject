@extends('app')

@section('content')

	<h2>Kepengurusan</h2>
    <hr/>

    <!-- Control Button -->
    @if ($role == 'admin')
        <div class="row">
            <div class="col-xs-offset-8 col-xs-4">
                <a class="btn btn-primary col-xs-12" href="{{ url('management/create') }}">
                    Ganti Kepengurusan
                </a>
            </div>
        </div>
    @endif
    <!-- /Control Button -->

    <!-- Management -->
    @foreach ($management as $key => $m)
        @if ($key == 0)
            <center>
                <h3>{{ $m->nama }}</h3>
            </center>

            <div class="row">
                <div class="col-xs-6">
                    Ketua: <a href="{!! url('profile', $m->nim_ketua) !!}">{{ $m->leader()->get()->first()->nama_lengkap }}</a>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    Mulai masa jabatan: {{ date("d M Y", strtotime($m->tanggal_mulai)) }}
                </div>
            </div>
            <br/>

            @foreach ($m->divisions()->where('id_super',null)->get() as $division)
                @include('management.item.view.division', ['division' => $division, 'role' => $role, 'depth' => 0])
            @endforeach

            <br/>
        @else
            <legend>{{ $m->nama }}</legend>

            <div class="row">
                <div class="col-xs-6">
                    Ketua: <a href="{!! url('profile', $m->nim_ketua) !!}">{{ $m->leader()->get()->first()->nama_lengkap }}</a>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    Mulai masa jabatan: {{ date("d M Y", strtotime($m->tanggal_mulai)) }}
                </div>
                <div class="col-xs-6">
                    Selesai masa jabatan: {{ date("d M Y", strtotime($m->tanggal_selesai)) }}
                </div>
            </div>
        @endif
        @if ($role == 'admin')
            <div class="row">
                <div class="col-xs-offset-8 col-xs-4">
                    <a class="btn btn-warning col-xs-12" href="{{ url('management/'. $m->id .'/edit') }}">
                        Edit Kepengurusan
                    </a>
                </div>
            </div>
        @endif
    @endforeach
    <!-- /Management -->

@endsection
