@if(isset($navbar))
    @if (!Request::is('/') && !Request::is('search'))
        <form method="get" action="{{ url('search') }}" class="navbar-form">
            <div style="display: inline;">
                <input type="text" class="form-control" name="q" id="q" placeholder="Search" value="{{ $q or '' }}"
                       style="display: table; width: 50%;">
            </div>
        </form>
    @endif
@else
    <form method="get" action="{{ url('search') }}">
        <input type="text" class="form-control" id="q" name="q" value="{{ $q or '' }}">
    </form>
@endif
