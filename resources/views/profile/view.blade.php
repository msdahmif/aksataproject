@extends('app')

@section('content')

    <?php $hidden_field = '<span class="label label-default">Hidden</span>'; ?>

    <!-- Nama Lengkap -->
    <h2>{{ $profile->nama_lengkap }}</h2>

    <hr>

    <div class="row">

        <!-- Photo -->
        <div class="col-md-3">
            @if ($profile->media_sosial[0])
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

            <div class="row item">
                <div class="col-xs-1">
                    <span class="glyphicon glyphicon-user"/>
                </div>
                <div class="col-xs-11">
                    <div class="row">
                        <div class="col-xs-4 item-key">
                            Nama Panggilan
                        </div>
                        <div class="col-xs-8 item-value">
                            @if ($profile->nama_panggilan !== null)
                                {{ $profile->nama_panggilan }}
                            @else
                                {!! $hidden_field !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Nama Panggilan -->

            <!-- NIM -->
            <div class="row item">
                <div class="col-xs-1">
                    <!-- <span class="glyphicon glyphicon-envelope"/> -->
                </div>
                <div class="col-xs-11">
                    <div class="row">
                        <div class="col-xs-4 item-key">
                            NIM
                        </div>
                        <div class="col-xs-8 item-value">
                            @if ($profile->nim !== null)
                                {{ $profile->nim }}
                            @else
                                {!! $hidden_field !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /NIM -->

            <!-- Jenis Kelamin -->
            <div class="row item">
                <div class="col-xs-1">
                    <!-- <span class="glyphicon glyphicon-envelope"/> -->
                </div>
                <div class="col-xs-11">
                    <div class="row">
                        <div class="col-xs-4 item-key">
                            Jenis Kelamin
                        </div>
                        <div class="col-xs-8 item-value">
                            @if ($profile->jenis_kelamin !== null)
                                {{ ucwords($profile->jenis_kelamin) }}
                            @else
                                {!! $hidden_field !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Jenis Kelamin -->

            <!-- Tempat Tanggal Lahir -->
            <div class="row item">
                <div class="col-xs-1">
                    <!-- <span class="glyphicon glyphicon-envelope"/> -->
                </div>
                <div class="col-xs-11">
                    <div class="row">
                        <div class="col-xs-4 item-key">
                            Tempat, Tanggal Lahir
                        </div>
                        <div class="col-xs-8 item-value">
                            @if ($profile->tempat_lahir !== null && $profile->tanggal_lahir !== null)
                                {{ $profile->tempat_lahir }}, {{ $profile->tanggal_lahir->formatLocalized('%e %B %Y') }}
                            @elseif ($profile->tempat_lahir !== null)
                                {{ $profile->tempat_lahir }}
                            @elseif ($profile->tanggal_lahir !== null)
                                {{ $profile->tanggal_lahir->formatLocalized('%e %B %Y') }}
                            @else
                                {!! $hidden_field !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Tempat Tanggal Lahir -->

            <!-- Nomor Telepon -->
            <div class="row item">
                <div class="col-xs-1">
                    <span class="glyphicon glyphicon-earphone"/>
                </div>
                <div class="col-xs-11">
                    <div class="row">
                        <div class="col-xs-4 item-key">
                            Nomor Telepon
                        </div>
                    </div>
                    @foreach ($profile->telepon as $nomor)
                        @if ($nomor !== null)
                            <div class="row">
                                <div class="col-xs-4">
                                    {{ $nomor->label }}
                                </div>
                                <div class="col-xs-8 item-value">
                                    {{ $nomor->value }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- /Nomor Telepon -->

            <!-- Email -->
            <div class="row item">
                <div class="col-xs-1">
                    <span class="glyphicon glyphicon-envelope"/>
                </div>
                <div class="col-xs-11">
                    <div class="row">
                        <div class="col-xs-4 item-key">
                            Email
                        </div>
                    </div>
                    @foreach ($profile->email as $email)
                        @if ($email !== null)
                            <div class="row">
                                <div class="col-xs-4">
                                    {{ $email->label }}
                                </div>
                                <div class="col-xs-8 item-value">
                                    {{ $email->value }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- /Email -->

            <!-- Alamat -->
            <div class="row item">
                <div class="col-xs-1">
                    <span class="glyphicon glyphicon-map-marker"/>
                </div>
                <div class="col-xs-11">
                    <div class="row">
                        <div class="col-xs-4 item-key">
                            Alamat
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            Alamat Bandung
                        </div>
                        <div class="col-xs-8 item-value">
                            @if ($profile->alamat_bandung !== null)
                                {{ $profile->alamat_bandung->jalan }}
                            @else
                                {!! $hidden_field !!}
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            Alamat Asal
                        </div>
                        <div class="col-xs-8 item-value">
                            @if ($profile->alamat_asal !== null)
                                {{ $profile->alamat_asal->jalan }}
                            @else
                                {!! $hidden_field !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Alamat -->

            <legend>
                Additional Information
            </legend>

            <!-- NIM TPB -->
            <div class="row item">
                <div class="col-xs-1">
                    <!-- <span class="glyphicon glyphicon-envelope"/> -->
                </div>
                <div class="col-xs-11">
                    <div class="row">
                        <div class="col-xs-4 item-key">
                            NIM TPB
                        </div>
                        <div class="col-xs-8 item-value">
                            @if ($profile->nim_tpb !== null)
                                {{ $profile->nim_tpb }}
                            @else
                                {!! $hidden_field !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /NIM TPB -->

            <!-- Golongan Darah -->
            <div class="row item">
                <div class="col-xs-1">
                    <span class="glyphicon glyphicon-tint"/>
                </div>
                <div class="col-xs-11">
                    <div class="row">
                        <div class="col-xs-4 item-key">
                            Golongan Darah
                        </div>
                        <div class="col-xs-8 item-value">
                            @if ($profile->golongan_darah !== null)
                                {{ $profile->golongan_darah }}
                            @else
                                {!! $hidden_field !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Golongan Darah -->

            <!-- Penyakit -->
            <div class="row item">
                <div class="col-xs-1">
                    <!-- <span class="glyphicon glyphicon-envelope"/> -->
                </div>
                <div class="col-xs-11">
                    <div class="row">
                        <div class="col-xs-4 item-key">
                            Penyakit
                        </div>
                        <div class="col-xs-8 item-value">
                            @if ($profile->penyakit !== null)
                                {{ $profile->penyakit }}
                            @else
                                {!! $hidden_field !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Penyakit -->

            <!-- MBTI -->
            <div class="row item">
                <div class="col-xs-1">
                    <span class="glyphicon glyphicon-star"></span>
                </div>
                <div class="col-xs-11">
                    <div class="row">
                        <div class="col-xs-4 item-key">
                            MBTI
                        </div>
                        <div class="col-xs-8 item-value">
                            @if ($profile->mbti !== null)
                                {{ $profile->mbti }}
                            @else
                                {!! $hidden_field !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /MBTI -->

            <!-- Media Sosial -->
            <div class="row item">
                <div class="col-xs-1">
                    <span class="glyphicon glyphicon-thumbs-up"/>
                </div>
                <div class="col-xs-11">
                    <div class="row">
                        <div class="col-xs-4 item-key">
                            Media Sosial
                        </div>
                    </div>
                    @foreach ($profile->media_sosial as $media)
                        @if ($media !== null)
                            <div class="row">
                                <div class="col-xs-4">
                                    {{ $media->label }}
                                </div>
                                <div class="col-xs-8 item-value">
                                    {{ $media->value }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- /Media Sosial -->

            <!-- Nomor Darurat -->
            {{--<div class="row item">--}}
            {{--<div class="col-xs-1">--}}
            {{--<span class="glyphicon glyphicon-exclamation-sign"/>--}}
            {{--</div>--}}
            {{--<div class="col-xs-11">--}}
            {{--<div class="row">--}}
            {{--<div class="col-xs-4 item-key">--}}
            {{--Nomor Darurat--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            <!-- /Nomor Darurat -->

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
