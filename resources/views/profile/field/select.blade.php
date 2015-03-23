<div class="row item">
    <div class="col-xs-1 item-icon">
        {!! $icon or '' !!}
    </div>
    <div class="col-xs-11">
        <div class="row">
            <div class="col-xs-4 item-key">
                <label for="{{ $id }}">
                    {{ $label }}
                </label>
            </div>
            <div class="col-xs-6 item-value">
                <select class="form-control" id="{{ $id }}" name="{{ $id }}" {{ isset($disabled) ? 'disabled' : '' }}>
                    @for ($i = 0; $i < count($values); $i++)
                        <option value="{{ $values[$i] }}" {{ $value == $values[$i] ? 'selected' : '' }}>
                            {{ $labelValues[$i] }}
                        </option>
                    @endfor
                </select>
            </div>
            @if (isset($hak_lihat))
                @include('profile.hak_lihat', ['id' => 'hak_lihat_' . $id, 'value' => $hak_lihat])
            @endif
        </div>
    </div>
</div>
