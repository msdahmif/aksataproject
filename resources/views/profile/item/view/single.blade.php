@if ($value !== null)
<div class="row item">
    <div class="col-xs-1">
        @if (isset($icon))
            {!! $icon !!}
        @endif
    </div>
    <div class="col-xs-11">
        <div class="row">
            <div class="col-xs-4 item-key">
                {{ $label }}
            </div>
            <div class="col-xs-8 item-value">
                {{ $value }}
            </div>
        </div>
    </div>
</div>
@endif