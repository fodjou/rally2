<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Dashboard_laps</title>

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
            left: 50px;
            top: 125px;
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
            width: 97%;
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

        #close {
            position: relative;
            top: 1px;
            left: 10px;
            text-align: left;
            font: normal normal normal 25px/37px Roboto;
            color: #FFFFFF;
            opacity: 1;
        }
        table {
            border-collapse: collapse;
            position: relative;
            top: -30px;
            left: 35px;
            width: 1380px;
        }
        th {
            background-color: #70707029;
            opacity: 1;
            border-spacing: 0;
            text-align: center;
            min-width: 170px;
            height: 30px;
        }
        tr {
            text-align: center;
            border-bottom: 1px solid rgba(128, 128, 128, 25%);
        }
        .ellipse {
            width: 55px;
            height: 55px;
            display: inline-block;
            position: relative;
            top: 4px;
            bottom: 0;
            border-radius: 50%;
            background: transparent 0 0 no-repeat padding-box;
            border: 1px solid black;
            box-shadow: inset 0 3px 6px #00000029, 0 3px 6px #00000029;
            opacity: 1;
        }
        .ellipse1 {
            z-index: 2;
        }
        .ellipse2 {
            right: 25px;
            z-index: 1;
        }
        .actions {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }
        .action {
            width: 180px;
            height: 35px;
            top: 15px;
            display: flex;
            position: relative;
            box-shadow: 0 3px 6px #00000029;
            border-radius: 21px;
            opacity: 1;
            justify-content: center;
            align-items: center;
            color: #FFFFFF;
        }
        .action1 {
            background: #585859 0 0 no-repeat padding-box;
        }
        .action2 {
            right: -40px;
            background: #8C8C8C 0 0 no-repeat padding-box;
        }
        .action {

            background-color: #8C8C8C;
        }

        .action#action1 {
            background-color: #585859;
        }
    </style>
</head>
<body>
<div id="main">
    <a href="{{ route('dashboard') }}">
        <img id="bin" alt="" src="{{ asset('images/menu.png') }}">
    </a>
    <img id="logo" alt="" src="{{ asset('images/logo1.png') }}">
    <h4 class="title" id="title"> / Dashboard </h4>


    <div id="main1"></div>

    <div id="box">
        <div id="subtitle">
            <div id="left">
                <img id="sublogo" class="logo" alt="" src="{{ asset('images/Groupe 480.png') }}">
                <p class="title" id="title2"> Liste des pilotes </p>
            </div>
            <div id="right">
                <div class="small-box" id="refresh-box">
                    <img src="{{ asset('images/rotate-cw(2).png') }}" alt="Image 1">
                </div>
                <div class="small-box" id="close-box">
                    <a href="{{ route('dashboard')}}" >
                        <img src= "{{ asset('images/x.png') }}" alt="Image 2">
                    </a>

                </div>
            </div>
        </div>


        <table>
            <thead>
            <th></th>
            <th>Pilotes</th>
            <th>Marques</th>
            <th>Véhicules</th>
            <th>Actions</th>
            </thead>
            @foreach($coureurs as $coureur)

                <tr>
                    <td>
                        <img
                            class="ellipse ellipse1"
                            src="{{ asset('images/'.$coureur->image) }}"
                        >

                        <img
                            class="ellipse ellipse2"
                            src="{{ asset('images/'.$coureur->logo) }}"
                        >
                    </td>
                    <td>{{ $coureur->nom_conducteur }}</td>
                    <td>{{ $coureur->marque }}</td>
                    <td>{{ $coureur->matricule}}</td>
{{--                    <td class="actions">--}}
{{--                        <div class="action action1">Début Course</div>--}}
{{--                        <div class="action action2">Fin Course</div>--}}
{{--                        <button class="btn btn-danger" onclick="window.location.href='/delete/{{ $coureur->id }}'">delete</button>--}}
{{--                    </td>--}}

{{--                    <td>--}}
{{--                        <a href="{{ route('coureurs.show', $coureur->id) }}">Voir</a>--}}
{{--                        <a href="{{ route('coureurs.edit', $coureur->id) }}">Modifier</a>--}}
{{--                    </td>--}}

                    <td class="actions">



                        <a href="{{ route('maps') }}">
                            <div
                            class="action"
                            id="action1"
                            onclick="changeColor(this)"
                            style="background-color: #585859">
                            Début Course
                        </div>
                        </a>

                        <div
                            class="action"
                            id="action2"
                            onclick="changeColor(this)"
                            style="background-color: #8C8C8C">
                            Fin Course
                        </div>

                        <script>
                            function changeColor(el) {

                                var color1 = '#585859';
                                var color2 = '#8C8C8C';

                                var otherEl = document.getElementById(
                                    el.id === 'action1' ? 'action2' : 'action1'
                                );

                                // Changer seulement le fond
                                el.style.backgroundColor = color2;
                                otherEl.style.backgroundColor = color1;

                            }
                        </script>

                    </td>


                </tr>

            @endforeach

        </table>

    </div>

    @section('styles')
        <style>
            .small-box {
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: white;
            }

            .small-box img {
                max-width: 100%;
                max-height: 100%;
            }
        </style>
    @endsection

</div>
</body>
</html>
