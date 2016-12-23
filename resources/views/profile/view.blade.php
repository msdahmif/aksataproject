@extends('app')

@section('content')

    <!-- Nama Lengkap -->
    <h2>{{ $profile->nama_lengkap }}</h2>

    <hr>

    <div class="row">

        <!-- Photo -->
        <div class="col-md-3">
            @if ($profile->foto_url != 'assets/images/anonim.png')
                <img src="{{ asset($profile->foto_url) }}" width=100%>
            @elseif (count($profile->media_sosial) && $profile->media_sosial[0])
                <img src="{{ str_replace('facebook', 'graph.facebook', $profile->media_sosial[0]->value) . "/picture?width=150&height=150" }}"
                     width=100%>
            @else
                <img src="{{ asset($profile->foto_url) }}" width=100%>
            @endif
        </div>
        <!-- /Photo -->

        <!-- Profile -->
        <div class="col-md-9">
            <legend>
                Personal Information
            </legend>

            {{--Nama Panggilan--}}
            @include('profile.item.view.single', ['label' => 'Nama Panggilan', 'value' => $profile->nama_panggilan, 'icon' => '<i class="fa fa-user"></i>'])

            {{--NIM--}}
            @include('profile.item.view.single', ['label' => 'NIM', 'value' => $profile->nim])

            {{--Jenis Kelamin--}}
            @include('profile.item.view.single', ['label' => 'Jenis Kelamin', 'value' => ucwords($profile->jenis_kelamin)])

            {{--Tempat, Tanggal Lahir--}}
            @include('profile.item.view.single', ['label' => 'Tempat, Tanggal Lahir', 'value' => ($profile->tempat_lahir === null && $profile->tanggal_lahir === null) ? null :  ($profile->tempat_lahir === null ? '' : $profile->tempat_lahir) . (($profile->tempat_lahir !== null && $profile->tanggal_lahir !== null) ? ', ' : '') . ($profile->tanggal_lahir === null ? '' : $profile->tanggal_lahir->formatLocalized('%e %B %Y'))])

            {{--Nomor Telepon--}}
            @include('profile.item.view.multiple', ['label' => 'Nomor Telepon', 'values' => $profile->telepon, 'icon' => '<i class="fa fa-phone"></i>'])

            {{--Email--}}
            @include('profile.item.view.multiple', ['label' => 'Email', 'values' => $profile->email, 'icon' => '<i class="fa fa-envelope"></i>'])

            {{--Alamat--}}
			@if (($profile->alamat_bandung !== null) && ($profile->alamat_asal !== null))
            <div class="row item">
                <div class="col-xs-1">
                    <i class="fa fa-map-marker"></i>
                </div>
                <div class="col-xs-11">
                    <div class="row">
                        <div class="col-xs-4 item-key">
                            Alamat
                        </div>
                    </div>
					@if ($profile->alamat_bandung !== null)
                    <div class="row">
                        <div class="col-xs-4">
                            Alamat Bandung
                        </div>
                        <div class="col-xs-8 item-value">
							{{ $profile->alamat_bandung->jalan . ', ' . $profile->alamat_bandung->kota . ', ' . $profile->alamat_bandung->provinsi . ' ' . $profile->alamat_bandung->kodepos }}
							<a class="button pull-right show_location" href="#" title="Lihat lokasi" data-position="{{ $profile->alamat_bandung->geolocation }}"><i class="fa fa-lg fa-map-marker"></i></a>
                        </div>
                    </div>
					@endif
					@if ($profile->alamat_asal !== null)
                    <div class="row">
                        <div class="col-xs-4">
                            Alamat Asal
                        </div>
                        <div class="col-xs-8 item-value">
							{{ $profile->alamat_asal->jalan . ', ' . $profile->alamat_asal->kota . ', ' . $profile->alamat_asal->provinsi . ' ' . $profile->alamat_asal->kodepos }}
							<a class="button pull-right show_location" href="#" title="Lihat lokasi" data-position="{{ $profile->alamat_asal->geolocation }}"><i class="fa fa-lg fa-map-marker"></i></a>
                        </div>
                    </div>
					@endif
                </div>
            </div>
			@endif

            <!-- Google Maps Modal -->
            <div class="modal fade" id="gmaps_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Location</h4>
                        </div>
                        <div class="modal-body">
                            <div id="map-canvas" style="width:100%; height: 300px"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Google Maps Modal -->

			@if (($profile->nim_tpb !== null) && ($profile->golongan_darah !== null) && ($profile->penyakit !== null) && ($profile->mbti !== null) && ($profile->media_sosial !== null))
            <legend>
                Additional Information
            </legend>
			@endif

            {{--NIM TPB--}}
            @include('profile.item.view.single', ['label' => 'NIM TPB', 'value' => $profile->nim_tpb])

            {{--Golongan Darah--}}
            @include('profile.item.view.single', ['label' => 'Golongan Darah', 'value' => $profile->golongan_darah, 'icon' => '<i class="fa fa-tint"></i>'])

            {{--Penyakit--}}
            @include('profile.item.view.single', ['label' => 'Penyakit', 'value' => $profile->penyakit, 'icon' => '<i class="fa fa-medkit"></i>'])

            <!-- MBTI -->
            @include('profile.item.view.single', ['label' => 'MBTI', 'value' => $profile->mbti, 'icon' => '<i class="fa fa-star"></i>'])

            {{--Media Sosial--}}
            @include('profile.item.view.multiple', ['label' => 'Media Sosial', 'values' => $profile->media_sosial, 'icon' => '<i class="fa fa-facebook-official"></i>'])

            <hr>

            <p><em title="{{ $profile->updated_at->toRfc2822String() }}">Last
                    updated: {{ $profile->updated_at->diffForHumans() }}</em></p>

            <!-- Buttons -->
            @if ($profile->getViewerRole() == 'admin')
                <div class="row">
                    <div class="col-xs-6">
                        <a class="btn btn-default col-xs-12" href="{{ url(Request::url() . '/edit') }}">
                            Ubah
                        </a>
                    </div>
                    <div class="col-xs-6">
                        <a class="btn btn-primary col-xs-12" href="{{ url(Request::url() . '/confirm') }}">
                            Konfirmasi
                        </a>
                    </div>
                </div>
                @endif
                        <!-- /Buttons -->

                <hr>

        </div>
        <!--/Profile -->
    </div>

@endsection

@section('script')
    <script>$(function () {$('[data-toggle="tooltip"]').tooltip()})</script>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCF2S-uLxntyh6PxPPSp20gup2tl3DnoWg"></script>
    <script type="text/javascript">
        $(function() {
            // initializing the map
            var map, marker;
            google.maps.event.addDomListener(window, 'load', function() {
                map = new google.maps.Map(document.getElementById('map-canvas'), {
                    center: { lat: 0, lng: 0},
                    zoom: 8
                });
                marker = new google.maps.Marker({
                    map: map
                });
            });

            $('.show_location').click(function() {
                var data = $(this).data('position').replace(/[()\s ]+/g, '').split(',');
                var lat = 0, lng = 0;
                if (data.length == 2) {
                    lat = parseFloat(data[0]);
                    lng = parseFloat(data[1]);
                }
                marker.setPosition({lat: lat, lng: lng});
                $('#gmaps_modal').modal('show');

                return false;
            });

            $('#gmaps_modal').on('shown.bs.modal', function () {
                google.maps.event.trigger(map, 'resize');
                map.panTo(marker.position);
            });
        });
    </script>
@endsection