<div class="row item">
    <div class="col-xs-3">
        @for($i=0; $i<$depth; $i++)
            &emsp;
        @endfor
        {{ $division->nama }}
    </div>
    <div class="col-xs-5">
        <a href="{!! url('profile', $division->nim_ketua) !!}">{{ $division->leader()->get()->first()->nama_lengkap }}</a>
    </div>
</div>

@foreach ($division->divisions()->get() as $subdivision)
    @include('management.item.view.division', ['division' => $subdivision, 'role' => $role, 'depth' => $depth + 1])
@endforeach