<div class="row item">
    <div class="col-xs-1 item-icon">
        {!! $icon or '' !!}
    </div>
    <div class="col-xs-11">
        <div class="row">
            <div class="col-xs-4 item-key">
                {{ $label or '' }}
            </div>
        </div>

        @for ($i = 0; $i <= count($values); $i++)
            <div class="row subitem" {!! $i== 0 ? 'style="display:none"' : '' !!}>
                <div class="col-xs-4 item-key">
                    <input type="text" class="form-control" name="{{ $id . '_label_' . $i }}"
                           id="{{ $id . '_label_' . $i }}"
                           placeholder="Label" value="{{ $i > 0 ? $values[$i-1]->label : '' }}">
                </div>
                <div class="col-xs-6 item-value">
                    <input type="text" class="form-control" name="{{ $id . '_value_' . $i }}"
                           id="{{ $id . '_value_' . $i }}"
                           placeholder="Value" value="{{ $i > 0 ? $values[$i-1]->value : '' }}">
                </div>

                @if(isset($hak_lihat))
                    @include('profile.hak_lihat', ['id' => 'hak_lihat_' . $id . '_' . $i, 'value' => ($i > 0) ? $hak_lihat[$i-1] : 'private'])
                @endif
            </div>
            @endfor

                    <!-- Add Button -->
            <div class="row">
                <div class="col-xs-10">
                    <button type="button" class="btn btn-info pull-left add_button">
                        Tambah
                    </button>
                </div>
            </div>
            <!-- /Add Button -->

    </div>
</div>
