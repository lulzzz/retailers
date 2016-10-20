@extends('carter::shopify.embedded')

@section('content')
    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
        }
    </style>
    <div class="container">
        <div class="content">
            <div class="title">Carter</div>
        </div>
    </div>
@stop