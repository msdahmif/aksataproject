@if ((count($values) !== 0) && (count(array_filter($values)) !== 0))
<div class="row item">
    <div class="col-xs-1">
        {!! $icon !!}
    </div>
    <div class="col-xs-11">
        <div class="row">
            <div class="col-xs-4 item-key">
                {{ $label }}
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
@endif
