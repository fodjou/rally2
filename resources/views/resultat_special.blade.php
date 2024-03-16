<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> resultat_speciale</title>
    <style>
        #main{
            position: absolute;
            top: -9px;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent linear-gradient(178deg, #548F74 0%, #FFD892E0 62%, #FFF2DBF5 73%, #FFFFFF 100%) 0 0 no-repeat padding-box;
            opacity: 1;
            z-index: 99;
        }

        #bin{
            width: 1.75%;
            position: absolute;
            top: 30px;
            left: 50px;
        }

        #logo{
            width: 5%;
            position: absolute;
            top: 23px;
            left: 70px;
            filter: invert(100%);
        }

        #sublogo{
            width: 3.5%;
            position: absolute;
            top: 10px;
            left: 30px;
            display: inline-block;
        }

        .title{
            text-align: left;
            font: normal normal normal 18px/34px Roboto;
            letter-spacing: 0;
            color: #FFFFFF;
            opacity: 1;
        }

        #title{
            position: absolute;
            top: 0;
            left: 150px;
        }

        #title2{
            position: relative;
            top: -5px;
            left: 90px;
            font-size: 21px;
        }

        #main1{
            position: absolute;
            top: -4px;
            left: 300px;
            width: 70%;
            height: 450px;
            background: transparent  url({{ asset('images/background1.png') }})0 0 no-repeat padding-box;
            background-size: 100%;
            opacity: 1;
        }

        #box{
            position: absolute;
            left: 50px;
            top: 125px;
            width: 1250px;
            height: 500px;
            background: #FFFFFF 0 0 no-repeat padding-box;
            box-shadow: 0 3px 6px #00000029;
            border: 1px solid #707070;
            border-radius: 25px;
            opacity: 1;

        }

        #subtitle{
            position: relative;
            top: -40px;
            left: 35px;
            width: 97%;
            height: 69px;
            background: #B9A955 0 0 no-repeat;
            border-radius: 20px;
        }

        #left{
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

        #close{
            position: relative;
            top: 1px;
            left: 10px;
            text-align: left;
            font: normal normal normal 25px/37px Roboto;
            color: #FFFFFF;
            opacity: 1;
        }
        #actions {
            display: flex;
            flex-direction: row;
            position: relative;
            top: -25px;
            left: 35px;
            width: 95%;
            border-bottom: 1px solid rgba(128, 128, 128, 25%);
        }

        #action-left{
            width: auto;
            display: flex;
            flex-direction: row;
        }

        #action-right{
            margin-left: 7px;
            width: 46%;
            text-align: end;
        }

        #action{
            font: normal normal bold 18px Roboto;
            letter-spacing: 0;
            color: #585859;
            opacity: 1;
            position: relative;
            right: 35px;
        }

        #lap1{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 350px;
            height: 40px;
            background: #585859 0 0 no-repeat padding-box;
            opacity: 1;
            font: normal normal normal 17px Roboto;
            letter-spacing: 0;
            color: #FFFFFF;
        }

        #lap2{
            margin-left: 10px;
            width: 350px;
            height: 40px;
            background: #707070 0 0 no-repeat padding-box;
            text-align: center;
            font: normal normal normal 17px Roboto;
            display: flex;
            justify-content: center;
            align-items: center;
            letter-spacing: 0;
            color: #FFFFFF;
            opacity: 1;
        }



        table{
            border-collapse: collapse;
        }

        th{
            background-color: #70707029;
            top: 203px;
            left: 87px;
            width: 1758px;
            height: 63px;
            opacity: 1;
            border-spacing: 0;
        }
        .trait {
            position: absolute;
            bottom: -10px;
            width: 100%;
            height: 5px;
            background-color:#707070;


        }


    </style>
</head>
<body>
<div id="main">
    <img id="bin" alt="" src="{{ asset('images/menu.png') }}">
    <img id="logo" alt="" src="{{ asset('images/logo1.png') }}">
    <h3 id="title" class="title"> / Resultat speciale </h3>

    <div id="main1"></div>

    <div id="box">
        <div id="subtitle">
            <div id="left">
                <img alt="" class="logo" id="sublogo" src="{{ asset('images/Groupe 480.png') }}">
                <p class="title" id="title2"> Evolution des speciales </p>
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

        <div id="actions">
            <div id="action-left">

                <div id="lap1"> Evolution des speciales 1</div>

                <a href="{{route('special2Result')}}">
                    <div id="lap2"> Evolution des speciales 2</div>
                </a>
            </div>
            <div id="action-right">
                <span id="action"> Actions </span>
            </div>
        </div>

        <table>
            <thead>
            <th>Rang</th>
            <th>Pilotes</th>
            <th>Marques</th>
            <th>Véhicules</th>
            <th>Total Kilométrage</th>
            <th>Heure Total Parcours</th>
            </thead>

            <tbody>
            @foreach($rankingSp1 as $index => $coureur)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div class="ellipse ellipse1"></div>
                        <div class="ellipse ellipse2"></div>
                        <span class="name">{{ $coureur['name'] }}</span>
                    </td>
                    <td><img src="{{ $coureur['image'] }}" alt="Image du conducteur"></td>
                    <td><img src="{{ $coureur['logo'] }}" alt="Logo de la marque"></td>
                    <td style="color: #79A07D">{{ $coureur['totalKm'] }} Km</td>
                    <td style="color: #79A07D">{{ formatTotalTime($coureur['totalTime']) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    <div class="trait"></div>
</div>
</body>
</html>
