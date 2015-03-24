<div class="row item">
    <div class="col-xs-1">
        {!! $icon !!}
    </div>
    <div class="col-xs-11">
        <div class="row">
            <div class="col-xs-4 item-key">
                {{ $label }}
            </div>
            <div class="col-xs-8 item-value">
                @if (count($values) == 0)
                    @include('profile.item.view.nodata')
                @elseif (count(array_filter($values)) == 0)
                    @include('profile.item.view.hidden')
                @endif
            </div>
        </div>
        @foreach ($values as $value)
            @if ($value !== null)
                <div class="row">
                    <div class="col-xs-4">
                        {{ $value->label }}
                    </div>
                    <div class="col-xs-8 item-value">
                        @if ($value->value !== null)
                            {{ $value->value }}
                        @else
                            @include('profile.item.view.hidden')
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
