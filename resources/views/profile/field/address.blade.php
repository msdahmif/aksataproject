<div class="row item">
    <div class="col-xs-4 item-key">
        <label for="{{ $id . '_jalan' }}">
            {{ $label or '' }}
        </label>
    </div>
    <div class="col-xs-6 item-value">
        <input type="text" class="form-control" name="{{ $id . '_jalan' }}" id="{{ $id . '_jalan' }}"
               placeholder="Jalan" value="{{ $value->jalan }}">
        <input type="text" class="form-control" name="{{ $id . '_kota' }}" id="{{ $id . '_kota' }}"
               placeholder="Kota" value="{{ $value->kota }}">
        <input type="text" class="form-control" name="{{ $id . '_provinsi' }}" id="{{ $id . '_provinsi' }}"
               placeholder="Provinsi" value="{{ $value->provinsi }}">
        <input type="text" class="form-control" name="{{ $id . '_kodepos' }}" id="{{ $id . '_kodepos' }}"
               placeholder="Kode Pos" value="{{ $value->kodepos }}">

        <div class="input-group">
            <input type="text" class="form-control" name="{{ $id . '_geolocation' }}"
                   id="{{ $id . '_geolocation' }}" placeholder="(Latitude, Longitude)"
                   value="{{ $value->geolocation or '' }}">
											<span class="input-group-btn">
												<button type="button" class="btn btn-info" title="Buka Google Maps"
                                                        data-toggle="modal" data-target="#gmaps_modal">
                                                    <span class="glyphicon glyphicon-map-marker"/>
                                                </button>
											</span>
        </div>
    </div>
    @if (isset($hak_lihat))
        @include('profile.hak_lihat', ['id' => 'hak_lihat_' . $id, 'value' => $hak_lihat])
    @endif
</div>