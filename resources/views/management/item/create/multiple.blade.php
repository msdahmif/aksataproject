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

        @for ($i = 0; $i <= 1; $i++)
            <div class="row subitem" {!! $i== 0 ? 'style="display:none"' : '' !!}>
                <div class="col-xs-4 item-key">
                    <input type="text" class="form-control" name="{{ $id . '_nama_1' }}"
                           id="{{ $id . '_nama_1' }}"
                           placeholder="Nama">
                </div>
                <div class="col-xs-6 item-value">
                    <input type="text" class="form-control" name="{{ $id . '_nim_1' }}"
                           id="{{ $id . '_nim_1' }}"
                           placeholder="NIM Ketua">
                </div>
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
