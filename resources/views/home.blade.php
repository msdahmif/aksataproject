@extends('app')

@section('stylesheet')
    <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
@endsection

@section('content')
    <style>
        /*body {*/
            /*margin: 0;*/
            /*padding: 0;*/
            /*width: 100%;*/
            /*height: 100%;*/
            /*color: #B0BEC5;*/
            /*display: table;*/
            /*font-weight: 100;*/
            /*font-family: 'Lato';*/
        /*}*/

        /*.container {*/
            /*text-align: center;*/
            /*display: table-cell;*/
            /*vertical-align: middle;*/
        /*}*/

        .container > .row > .col-md-8 {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
            font-family: 'Lato';
        }

        .title {
            font-size: 96px;
        }

        .subtitle {
            font-size: 24px;
            margin-bottom: 40px;
        }

        .quote {
            font-size: 24px;
        }
    </style>
    <div class="content">
        <div class="title">Aksata</div>
        <div class="subtitle">Proudly built with Laravel 5</div>
        <div class="quote">{{ Inspiring::quote() }}</div>
    </div>
@endsection
