@extends('app')

@section('stylesheet')
    <link href="{{ asset('assets/css/bootstrap-datepicker.css') }}" rel="stylesheet">
@endsection

@section('content')
    <h2>Edit Profil</h2>
    <hr>

    <!-- Edit Profile Form -->
    <form method="POST" action="{{ url(Request::url()) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- row -->
        <div class="row">

            <!-- Profile Picture -->
            <div class="col-md-3">
                <img src="{{ asset('assets/images/anonim.png') }}" width=100%>
                <a href="#">Ganti gambar</a>
                <input type="hidden" name="foto_url" id="foto_url">
            </div>
            <!--/Profile Picture -->

            <div class="col-md-9">
                <legend>
                    Personal Information
                </legend>

                {{--Nama Lengkap--}}
                @include('profile.field.single', ['label' => 'Nama Lengkap', 'id' => 'nama_lengkap', 'value' => $profile->nama_lengkap, 'icon' => '<i class="fa fa-lg fa-user"></i>'])

                {{--Nama Panggilan--}}
                @include('profile.field.single', ['label' => 'Nama Panggilan', 'id' => 'nama_panggilan', 'value' => $profile->nama_panggilan])

                {{--NIM Jurusan--}}
                @include('profile.field.single', ['label' => 'NIM', 'id' => 'nim', 'value' => $profile->nim, 'disabled' => true])

                {{--Jenis Kelamin--}}
                @include('profile.field.select', ['label' => 'Jenis Kelamin', 'id' => 'jenis_kelamin', 'value' => $profile->jenis_kelamin, 'values' => ['laki-laki', 'perempuan'], 'labelValues' => ['Laki-laki', 'Perempuan']])

                {{--Tempat, Tanggal Lahir--}}
                @include('profile.field.single', ['label' => 'Tempat Lahir', 'id' => 'tempat_lahir', 'value' => $profile->tempat_lahir, 'hak_lihat' => $profile->hak_lihat->tempat_lahir])
                @include('profile.field.single', ['label' => 'Tanggal Lahir', 'id' => 'tanggal_lahir', 'value' => $profile->tanggal_lahir->format('m/d/Y'), 'hak_lihat' => $profile->hak_lihat->tanggal_lahir])

                {{--Telepon--}}
                @include('profile.field.multiple', ['label' => 'Nomor Telepon', 'id' => 'telepon', 'values' => $profile->telepon, 'hak_lihat' => $profile->hak_lihat->telepon, 'icon' => '<i class="fa fa-lg fa-phone"></i>'])

                {{--E-mail--}}
                @include('profile.field.multiple', ['label' => 'Email', 'id' => 'email', 'values' => $profile->email, 'hak_lihat' => $profile->hak_lihat->email, 'icon' => '<i class="fa fa-lg fa-envelope"></i>'])

                {{--Alamat--}}
                <div class="row">
                    <div class="col-xs-1 item-icon">
                        <i class="fa fa-lg fa-map-marker"></i>
                    </div>
                    <div class="col-xs-11">
                        <div class="row">
                            <div class="col-xs-4 item-key">
                                Alamat
                            </div>
                        </div>

                        @include('profile.field.address', ['label' => 'Alamat Bandung', 'id' => 'alamat_bandung', 'value' => $profile->alamat_bandung, 'hak_lihat' => $profile->hak_lihat->alamat_bandung])
                        @include('profile.field.address', ['label' => 'Alamat Asal', 'id' => 'alamat_asal', 'value' => $profile->alamat_asal, 'hak_lihat' => $profile->hak_lihat->alamat_asal])

                    </div>
                </div>

                <!-- Google Maps Modal -->
                <div class="modal fade" id="gmaps_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Location Picker</h4>
                            </div>
                            <div class="modal-body">
                                <div id="geo_1" style="width:100%; height: 300px"></div>
                                <input type="hidden" id="geo_lat_1">
                                <input type="hidden" id="geo_long_1">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Google Maps Modal -->

                <legend>
                    Additional Information
                </legend>

                {{--NIM TPB--}}
                @include('profile.field.single', ['label' => 'NIM TPB', 'id' => 'nim_tpb', 'value' => $profile->nim_tpb, 'hak_lihat' => $profile->hak_lihat->nim_tpb])

                {{--Golongan Darah--}}
                @include('profile.field.select', ['label' => 'Golongan Darah', 'id' => 'golongan_darah', 'value' => $profile->golongan_darah, 'values' => ['A', 'B', 'AB', 'O'], 'labelValues' => ['A', 'B', 'AB', 'O'], 'hak_lihat' => $profile->hak_lihat->golongan_darah, 'icon' => '<i class="fa fa-lg fa-tint"></i>'])

                {{--Penyakit--}}
                @include('profile.field.single', ['label' => 'Penyakit', 'id' => 'penyakit', 'value' => $profile->penyakit, 'hak_lihat' => $profile->hak_lihat->penyakit, 'icon' => '<i class="fa fa-lg fa-medkit"></i>'])

                {{--MBTI--}}
                <div class="row item">
                    <div class="col-xs-1 item-icon">
                        <i class="fa fa-lg fa-star"></i>
                    </div>
                    <div class="col-xs-11">
                        <div class="row">
                            <div class="col-xs-4 item-key">
                                <label for="mbti">
                                    MBTI
                                </label>
                            </div>
                            <div class="col-xs-6 item-value">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mbti" id="mbti"
                                           value="{{ $profile->mbti }}">
											<span class="input-group-btn">
												<a class="btn btn-info" href="//www.google.com/search?q=mbti+test"
                                                   target="_blank" title="Ambil Tes MBTI">
                                                    <i class="fa fa-check"></i>
                                                </a>
											</span>
                                </div>
                            </div>
                            @include('profile.hak_lihat', ['id' => 'hak_lihat_mbti', 'value' => $profile->hak_lihat->mbti])
                        </div>
                    </div>
                </div>

                {{--Social Media--}}
                @include('profile.field.multiple', ['label' => 'Media Sosial', 'id' => 'media_sosial', 'values' => $profile->media_sosial, 'hak_lihat' => $profile->hak_lihat->media_sosial, 'icon' => '<i class="fa fa-lg fa-facebook-official"></i>'])

                {{--Emergency Contact--}}
                {{--                @include('profile.field.multiple', ['label' => 'Nomor Darurat', 'id' => 'nomor_darurat', 'values' => $profile->nomor_darurat, 'hak_lihat' => $profile->hak_lihat->nomor_darurat, 'icon' => '<i class="fa fa-lg fa-exclamation-sign"></i>'])--}}

                <hr>

                <!-- Buttons -->
                <div class="row">
                    <div class="col-xs-6">
                        <button class="btn btn-primary col-xs-12">
                            Simpan
                        </button>
                    </div>
                    <div class="col-xs-6">
                        <a class="btn btn-danger col-xs-12" id="_batal_button"
                           href="{{ url('profile/' . $profile->nim) }}">
                            Batal
                        </a>
                    </div>
                </div>
                <!-- /Buttons -->

                <hr>

            </div>
            <!--/col-span-9-->

        </div>
        <!-- /row -->

    </form>
    <!-- /Edit Profile Form -->
@endsection('content')

@section('script')
    <!-- JQuery UI -->
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap Datepicker -->
    <script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
    <script>$('#tanggal_lahir').datepicker({autoclose: true})</script>

    <!-- Own script -->
    <script src="{{ asset('assets/js/edit-profile.aksata.js') }}"></script>
@endsection

