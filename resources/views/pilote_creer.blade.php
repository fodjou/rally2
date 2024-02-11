<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> creer_pilote</title>
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
            width: 2%;
            position: absolute;
            top: 30px;
            left: 200px;
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
            left: 230px;
            top: 125px;
            width: 1300px;
            height: 700px;
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

        #slidbar{
            background: #FFFFFF 0 0 no-repeat padding-box;
            box-shadow: 0 3px 6px #00000029;
            position: absolute;
            top: 100px;
            width: 220px;
            height: 800px;
            border-radius: 25px;
            opacity: 1;

        }

        #profil {
            position: absolute;
            top: -60px;
            left: 50px;
            width: 120px;
            height: 120px;
        }
        h4{
            font-weight: normal;
            position: relative;
            right: -55px;
            margin-top:-20px ;
        }

        hr{
            margin-top:60px ;
            width: 75%;
        }
        h2.ti {
            position:relative;
            top: 40px;
            text-align: center;
            line-height: 1;
            font-weight: normal;
        }
        h2.ti + h2.ti {
            margin-top: -12px;
        }

        img[id="final"] {
            width: 12%;
            position: relative;
            left:35px;
        }
        img[id="dashbooard"] {
            position: relative;
            left:35px;
        }
        img[id="pilote"] {
            position: relative;
            left:35px;
        }
        img[id="lap"] {
            position: relative;
            left:35px;
        }
        img[id="time"] {
            position: relative;
            left:35px;
        }
        img[id="special"] {
            position: relative;
            left:35px;
        }

        h3 {

            top: 40px;
            margin-left: 45px;
        }

        #menu {

            background-color: #00000029;
            border-radius: 25px;
            margin-bottom: 25px;
            max-height: 35px;
            width: 200px;
            height: 50px;

        }
        #down img {
            position: relative;
            left: -30px;
            width: 120%;
            top: 30%
        }
        .container {
            display: flex;
            flex-direction: column;
        }
        .menu-item {
            display: flex;
            align-items: center;
            background-color: #585859;
            border-radius: 25px;
            /*margin-bottom: 25px;*/
            max-height: 38px;
            width: 200px;
            height: 260px;
            margin: 15px;

        }
        .menu-item.green-bg {
            background-color: green; /* Modifier la couleur selon votre choix */
        }
        .menu-item:hover {
            border: 1px solid blue;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 600px;
        }

        label {
            display: none; /* Pour masquer les labels */
        }

        input[type="file"] {
            width: 300px;
            padding: 10px;
            margin-bottom: 30px;
            border-radius: 20px;
            border: 1px solid #ccc;
            position: relative;
        }

        input[type="file"]::file-selector-button {
            position: absolute;
            bottom: 0;
            right: 2px;
            border-radius: 20px;
            background-color: #fff;
            padding: 15px 50px;
            border: 1px solid #ccc;

        }

        input[type="file"]:hover::file-selector-button {
            background-color: #eee;
        }

        input[type="text"],
        input[type="file"],
        input[type="submit"] {
            width: 600px;
            padding: 20px;
            margin-bottom: 25px;
            border-radius: 20px;
            border: 1px solid #ccc;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);

        }


        input[type="submit"] {
            background-color: #585859;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #40745F;
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
            top: -400px;
            margin-left: 760px;
        }

        #response {
            background-color: green;
            padding: 13px;
            border-radius: 5px;
            position: relative;
            /*top: 20px; !* Ajustez cette valeur selon vos préférences *!*/
            /*left: 20px; !* Ajustez cette valeur selon vos préférences *!*/
            width: 500px;
            margin-left: 700px;
        }

        #response h2 {
            color: white;
            font-size: 25px;
            margin: 0;
            padding: 5px 10px;
            display: flex;
            align-items: center;
        }







    </style>
</head>
<body>
<div id="main">
    <img id="bin" alt="" src="{{ asset('images/menu.png') }}">

    <div id="main1"></div>

    <div id="slidbar" class="container">
        <header>
            <img id=profil alt="" src="{{ asset('images/profil_picture.png') }}">
            <h2 class="ti"> Bienvenue</h2>
            <h2 class="ti"><strong>Yven Michel</strong></h2>
            <div id="logout">
                <hr>
                <img id="11" class="logo" alt="" src="{{ asset('images/sign_out.png') }}">
                <h4>Deconnexion!</h4>
            </div>

        </header>

        <div class="menu-item">
            <img id="dashbooard" class="logo" alt="" src="{{ asset('images/dashboard.png') }}">
            <h3> Dashboard</h3>
        </div>
        <div class="menu-item">
            <img id="final" class="logo" alt="" src="{{ asset('images/pilot_list.png') }}">
            <h3>Resultat final</h3>
        </div>
        <div class="menu-item">
            <img id="pilote" class="logo" alt="" src="{{ asset('images/list_user.png') }}">
            <h3>Creer un pilote</h3>
        </div>
        <div class="menu-item green-bg">
            <img id="lap" class="logo" alt=""  src="{{ asset('images/lap_result.png') }}">
            <h3>resultat lap</h3>
        </div>
        <div class="menu-item">
            <img id="time" class="logo" alt="" src="{{ asset('images/compteur_vitesse.png') }}">
            <h3>real Time</h3>
        </div>
        <div class="menu-item">
            <img id="special"class="logo" alt="" src="{{ asset('images/special_result.png') }}">
            <h3>Resultat Special</h3>
        </div>

        <div id="down">
            <img id="5" alt="" src="{{ asset('images/logo1.png') }}">


        </div>

    </div>

    <div id="box">
        <div id="subtitle">
            <div id="left">
                <img id="sublogo" class="logo" alt="" src="{{ asset('images/Groupe 480.png') }}">
                <p id="title2" class="title"> Creer un pilote </p>
            </div>
            <div id="right">
                <div class="small-box" id="refresh-box">  </div>
                <div class="small-box" id="close-box"> </div>
            </div>
        </div>
        <form>
            <label for="nom-pilote"></label>
            <input type="text" id="nom-pilote" name="nom-pilote" placeholder="Nom du pilote">

            <label for="photo-pilote"></label>
            <input type="file" id="photo-pilote" name="photo-pilote">

            <label for="sponsor"></label>
            <input type="text" id="sponsor" name="sponsor" placeholder="Sponsor">

            <label for="marque-vehicule"></label>
            <input type="text" id="marque-vehicule" name="marque-vehicule" placeholder="Marque de véhicule">

            <label for="photo-logo"></label>
            <input type="file" id="photo-pilote" name="logo">

            <label for="immatriculation"></label>
            <input type="text" id="immatriculation" name="immatriculation" placeholder="Immatriculation">

            <input type="submit" value="Valider">
        </form>
        <div id="response">
            <h2> 💡 profil pilote creer avec succes ×</h2>
        </div>

        <div id="course">
            <img id="cours" alt="" src="{{ asset('images/Groupe 1619.png') }}">
        </div>




    </div>
</div>
