@extends('app')

@section('content')

    <!-- Nama Lengkap -->
    <h2>Pengaturan Akun</h2>

    <hr>

    <div class="row">
        @include ('errors.master')

        <form class="form-horizontal" method="post">
            {{ csrf_field() }}

            <div class="form-group">
                <label class="col-xs-2 control-label" for="email">Email</label>

                <div class="col-xs-7">
                    <input name="email" id="email" type="email" class="form-control" value="{{ $user->email }}">
                </div>
                @include('hint', ['placement' => 'right', 'hint' => "Email ini akan digunakan untuk password reset, berbeda dengan email pada profil Anda"])
            </div>

            <div class="form-group">
                <label class="col-xs-2 control-label" for="old_password">Password Lama</label>

                <div class="col-xs-7">
                    <input name="old_password" id="old_password" type="password" class="form-control"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-2 control-label" for="new_password">Password Baru</label>

                <div class="col-xs-7">
                    <input name="new_password" id="new_password" type="password" class="form-control"/>
                </div>
                @include('hint', ['placement' => 'right', 'hint' => "Kosongkan jika Anda tidak ingin mengubah password"])
            </div>

            <div class="form-group">
                <label class="col-xs-2 control-label" for="new_password_confirmation">Konfirmasi Password Baru</label>

                <div class="col-xs-7">
                    <input name="new_password_confirmation" id="new_password_confirmation" type="password" class="form-control"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-7 col-xs-offset-2">
                    <button type="submit" class="btn btn-default">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script>$(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })</script>
@endsection