@extends('layouts.app')

@section('title', 'Resultat final')

@section('css')
<style>
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

    #right {
        width: auto;
        flex-direction: row;
        display: inline-block;
        top: 15px;
        right: 35px;
        position: absolute;
    }

    .small-box {
        width: 35px;
        height: 35px;
        border: 0.5px solid #FFFFFF;
        border-radius: 4px;
        opacity: 1;
        display: inline-block;
        margin-left: 7px;
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
        height: 30px;
        text-align: left;
        padding-left: 35px;
        min-width: 100px;
        font: normal normal bold 17px Roboto;
        letter-spacing: 0px;
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
        background: #058147 0 0 no-repeat padding-box;
    }

    .action2 {
        background: #546E7A 0 0 no-repeat padding-box;
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
        left: 20%;
        width: 50px;
        height: 50px;
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

</style>
@endsection

@section('content')
<div id="main">

 @include('layouts.components.logo')

 @include('layouts.components.sidebar')

 <div id="box">
        <div id="subtitle">
            <div id="left">
                <img id="sublogo" class="logo" alt="" src="{{ asset('images/Groupe 480.png') }}">
                <p class="title" id="title2"> Top 8 de Winners </p>
            </div>
            <div id="right">
                <div class="small-box" id="refresh-box"></div>
                <div class="small-box" id="close-box"></div>
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
            <th>Actions</th>
            </thead>

            <tbody>
            <tr>
                <td><img alt="" class="first" src="{{ asset('images/Groupe 601.png') }}"></td>
                <td>
                    <div class="ellipse ellipse1"></div>
                    <div class="ellipse ellipse2"></div>
                    <span class="name">Olivier Ramdam</span></td>
                <td> OPEL</td>
                <td> LT 705454-X</td>
                <td style="color: #79A07D">105 Km</td>
                <td style="color: #79A07D">4h 45min 5s</td>
                <td class="actions">
                    <div class="action action1">Winner Detail</div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="rang">2</div>
                </td>
                <td>
                    <div class="ellipse ellipse1"></div>
                    <div class="ellipse ellipse2"></div>
                    <span class="name">Christelle Wamou</span></td>
                <td> BUGATI</td>
                <td> LT 705454-X</td>
                <td>125 Km</td>
                <td>5h 45min 5s</td>
                <td class="actions">
                    <div class="action action2">Detail</div>
                </td>
            </tr>


            </tbody>
        </table>
    </div>





 @endsection
