@extends('layouts.app')
@section('css')


@section('title', 'map')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .ellipse {
            text-align: left;
        }

        #main {
            position: absolute;
            top: -9px;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent linear-gradient(178deg, #548F74 0%, #FFD892E0 62%, #FFF2DBF5 73%, #FFFFFF 100%) 0 0 no-repeat padding-box;
            opacity: 1;
            z-index: 99;
        }

        #bin {
            width: 1.75%;
            position: absolute;
            top: 30px;
            left: 50px;
        }

        #logo {
            width: 5%;
            position: absolute;
            top: 23px;
            left: 70px;
            filter: invert(100%);
        }

        #sublogo {
            width: 3.5%;
            position: absolute;
            top: 10px;
            left: 30px;
            display: inline-block;
        }

        .title {
            text-align: left;
            font: normal normal normal 18px/34px Roboto;
            letter-spacing: 0;
            color: #FFFFFF;
            opacity: 1;
        }

        #title {
            position: absolute;
            top: 0;
            left: 150px;
        }

        #title2 {
            position: relative;
            top: -5px;
            left: 90px;
            font-size: 21px;
        }

        #main1 {
            position: absolute;
            top: -4px;
            left: 300px;
            width: 70%;
            height: 450px;
            background: transparent url({{ asset('images/background1.png') }})0 0 no-repeat padding-box;
            background-size: 100%;
            opacity: 1;
        }


        #box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 1440px;
            height: 600px;
            background: #FFFFFF 0 0 no-repeat padding-box;
            box-shadow: 0 3px 6px #00000029;
            border: 1px solid #707070;
            border-radius: 25px;
            opacity: 1;
        }


        #subtitle {
            position: relative;
            top: -40px;
            left: 35px;
            width: 94%;
            height: 69px;
            background: #B9A955 0 0 no-repeat;
            border-radius: 20px;
        }

        #left {
            width: auto;
            flex-direction: row;
            display: inline-block;
        }

        #right{
            width: auto;
            flex-direction: row;
            display: inline-block;
            top: 15px;
            right: 35px;
            position: absolute;
        }

        .small-box{
            width: 35px;
            height: 35px;
            border: 0.5px solid #FFFFFF;
            border-radius: 4px;
            opacity: 1;
            display: inline-block;
            margin-left: 7px;
        }
        #right {
            display: flex;
        }

        .small-box {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .small-box img {
            max-width: 100%;
            max-height: 100%;
        }
        table {
            border-collapse: collapse;
            width: 400px;
            border: 1px solid #707070;
            opacity: 1;
            top: -500px; /* Remplacez 500px par la hauteur souhaitée */
            border-radius: 20px;
        }


        th {
            background-color: #70707029;
            opacity: 1;
            border-spacing: 0;
            height: 30px;
            text-align: left;
            padding-left: 35px;
            min-width: 100px;
            font: normal normal bold 17px Roboto;
            letter-spacing: 0;
            color: #585859;
        }

        tr {
            border-bottom: 1px solid rgba(128, 128, 128, 25%);
            font: normal normal normal 20px Roboto;
            letter-spacing: 0;
            color: #585859;
        }

        td:not(:has(.ellipse)) {
            text-align: center;
        }

        .ellipse {
            text-align: left;
            width: 55px;
            height: 55px;
            display: inline-block;
            position: relative;
            top: 4px;
            left: -10px;
            border-radius: 50%;
            background: transparent 0 0 no-repeat padding-box;
            border: 1px solid black;
            box-shadow: inset 0 3px 6px #00000029, 0 3px 6px #00000029;
            opacity: 1;
        }

        .ellipse1 {
            left: 35px;
            z-index: 2;
        }

        .ellipse2 {
            left: 10px;
            z-index: 1;
        }

        .first {
            width: 65px;
            height: 55px;
            display: inline-block;
            position: relative;
            top: 4px;
            bottom: 0;
            opacity: 1;
        }

        .rang {
            position: relative;
            left: 10%;
            width: 50px;
            height: 30px;
            display: flex;
            justify-content: center;
            font: normal normal bold 40px/48px Roboto;
            letter-spacing: 0;
        }

        .name {
            text-align: center;
            position: relative;
            left: 20px;
            bottom: 15px;
        }

        #map {
            margin-left: 500px;
        }
    </style>

    @section('content')

    @endsection

<div id="main">
    <img id="bin" alt="" src="{{ asset('images/menu.png') }}">
    <img id="logo" alt="" src="{{ asset('images/logo1.png') }}">
    <h4 class="title" id="title"> / resultat realtime  </h4>

    <div id="main1"></div>
    @include('layouts.components.logo')

    @include('layouts.components.sidebar')

    <div id="box">
        <div id="subtitle">
            <div id="left">
                <img id="sublogo" class="logo" alt="" src="{{ asset('images/Groupe 480.png') }}">
                <p class="title" id="title2"> Resultat realtime </p>
            </div>
            <div id="right">
                <div class="small-box" id="refresh-box">
                    <img src="{{ asset('images/rotate-cw(2).png') }}" alt="Image 1">
                </div>
                <div class="small-box" id="close-box">
                    <img src= "{{ asset('images/expand(1).png') }}" alt="Image 2">
                </div>
            </div>
        </div>

        <div id="map">

            <iframe src="https://hosting.wialon.com/locator/index.html?t=1f59b5fbd0b702d585a477e3a3d701bcDF92DAA8FB8372491B203513F80FB095C649571E&map=gurtam_maps" width="100%" height="500" frameborder="0"></iframe>

        </div>

        <table>
            <tbody>
            @php
                $rank = 1;
            @endphp
            @foreach ($ranking as $coureur)
                @if ($rank <= 5)
                    <tr>
                        <td>
                            <div class="rang">{{ $rank }}</div>
                            <div class="ellipse ellipse1">
                                <img src="{{ asset('images/'.$coureur['image']) }}" alt="visage">
                            </div>
                            <div class="ellipse ellipse2">
                                <img src="{{ asset('images/'.$coureur['logo']) }}" alt="Logo">
                            </div>

                            <span class="name"> {{ $coureur['name'] }}</span>

                        </td>
                    </tr>
                @endif
                @php
                    $rank++;
                @endphp
            @endforeach
            </tbody>
        </table>


    </div>

</div>
    @endsection
