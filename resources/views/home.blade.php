@extends('app')

@section('stylesheet')
    <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
    <style>
        .container > .row > .col-md-8 {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
            margin-bottom: 40px;
            font-family: 'Lato';
        }

        .title {
            font-size: 96px;
        }

        .subtitle {
            font-size: 24px;
            /*margin-bottom: 40px;*/
        }

        .quote {
            font-size: 24px;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="title">Aksata</div>
        <div class="subtitle">Sistem Informasi Manajemen Anggota HMIF ITB</div>
        {{--<div class="quote">{{ Inspiring::quote() }}</div>--}}
    </div>

    @include('search.form')

@endsection

@section('script')
    <script>$(function () {$('#q').focus()})</script>
@endsection