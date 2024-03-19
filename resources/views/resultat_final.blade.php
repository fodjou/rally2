<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> resultat</title>
    <style>
        #main{
            position: absolute;
            top: -9px;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent  linear-gradient(178deg, #548F74 0%, #FFD892E0 62%, #FFF2DBF5 73%, #FFFFFF 100%) 0 0 no-repeat padding-box;
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
            width: 1440px;
            height: 600px;
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

        #close{
            position: relative;
            top: 1px;
            left: 10px;
            text-align: left;
            font: normal normal normal 25px/37px Roboto;
            color: #FFFFFF;
            opacity: 1;
        }
        #winner {
            width: 80%;
            position: relative;
            z-index: 1;
            display:inline-block;
            top: -200px;
        }
        #face, #win {
            /*height: 0;*/
            background-size: 100%;
            position: static;
            object-fit: cover;
        }

        #face {
            position: absolute;
            border-radius: 100%;
            margin-top: 25px;
            top: 200px;
            left: 170px;
            width: 100px;
            height: 100px;
            background: #fff;
            z-index: 1;


        }
        #win {
            position: absolute;
            top: 260px;
            left: 40px;
            margin-top: 25px;
            width: 30%;
            margin-left: 0px;


        }

        table {
            position: relative;
            top: 0;
            left: -50px;
            z-index: 5;
            padding: 0;
            margin: 0;
            width: 35%;
        }



        table, th, td {
            color: black;
            align-items: center;
        }
        tr {
            display: flex;
            justify-content: space-between;
        }

        td {
            width: 80%;
            padding: 20px;
            font-size: 22px;

        }
        table {
            margin-top: 50px;
            margin-left: 500px;

        }
        tbody tr td:first-child {
            font-weight: bold;
        }

        #course{
            margin-top: -60px;
        }

        #cours{
            width: 38%;
            padding: 0;
            position: relative;
            z-index: 1;
            display:inline-block;
            top: -300px;
            margin-left: 890px;
        }





    </style>
</head>
<body>
<div id="main">
    <img id="bin" alt="" src="{{ asset('images/menu.png') }}">
    <img id="logo" alt="" src="{{ asset('images/logo1.png') }}">
    <h3 id="title" class="title"> / Resultat Finale </h3>

    <div id="main1"></div>

    <div id="box">
        <div id="subtitle">
            <div id="left">
                <img id="sublogo" class="logo" alt="" src="{{ asset('images/Groupe 480.png') }}">
                <p id="title2" class="title"> WINNER RALLYE GT 2024 </p>
            </div>
            <div id="right">
                <div class="small-box" id="refresh-box">  </div>
                <div class="small-box" id="close-box"> </div>
            </div>
        </div>


        <div id="winner">
            <img id="face" alt="" src="{{ asset('images/img.png') }}">
            <img id="win" alt="" src="{{ asset('images/Groupe 601.png') }}">

        </div>

        <table>
            <tbody>

            <tr>
                <td>Pilotes</td>
                <td>{{$coureur->nom_conducteur}}</td>
            </tr>

            <tr>
                <td>Sponsors</td>
                <td>{{$coureur->sponsors}}</td>
            </tr>

            <tr>
                <td>Marques</td>
                <td>{{$coureur->marque}}</td>
            </tr>

            <tr>
                <td>Vehicules</td>
                <td>{{$coureur->matricule}}</td>
            </tr>

            <tr>
                <td>Distance Total</td>
                <td>105 Km</td>
            </tr>

            <tr>
                <td>Heurs Total Parcours</td>
                <td>4h 45min 5s</td>
            </tr>

            </tbody>

        </table>
        <div id="course">
            <img id="cours" alt="" src="{{ asset('images/Groupe 1619.png') }}">

        </div>

    </div>

</div>


</body>
</html>
