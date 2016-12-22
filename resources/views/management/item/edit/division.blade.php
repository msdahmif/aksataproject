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
        <a class="btn btn-warning col-xs-12" href="{{ url('division/'. $division->id .'/edit') }}">
            Edit
        </a>
    </div>
    <div class="col-xs-2">
        <form method="POST" action="{{ url('division/'. $division->id .'/delete') }}" >
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-danger col-xs-12" href="{{ url('division/'. $division->id .'/delete') }}">
                Delete
            </button>
        </form>
    </div>
</div>
<hr/>

@foreach ($division->divisions()->get() as $subdivision)
    @include('management.item.edit.division', ['division' => $subdivision, 'depth' => $depth + 1])
@endforeach
