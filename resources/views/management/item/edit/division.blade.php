<div class="row item">
    <div class="col-xs-3">
        @for($i=0; $i<$depth; $i++)
            &emsp;
        @endfor
        {{ $division->nama }}
    </div>
    <div class="col-xs-3">
        <a href="{!! url('profile', $division->nim_ketua) !!}">{{ $division->leader()->get()->first()->nama_lengkap }}</a>
    </div>
    <div class="col-xs-2">
        <a class="btn btn-primary col-xs-12" href="{{ url('division/'. $division->id .'/create') }}">
            + Sub
        </a>
    </div>
    <div class="col-xs-2">
        <a class="btn btn-warning col-xs-12" href="{{ url('division/'. $division->id .'/create') }}">
            Edit
        </a>
    </div>
    <div class="col-xs-2">
        <a class="btn btn-danger col-xs-12" href="{{ url('division/'. $division->id .'/create') }}">
            Delete
        </a>
    </div>
</div>
<hr/>

@foreach ($division->divisions()->get() as $subdivision)
    @include('management.item.edit.division', ['division' => $subdivision, 'depth' => $depth + 1])
@endforeach