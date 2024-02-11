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

        .minibox{

            background: #FFFFFF 0% 0% no-repeat padding-box;
            border-radius: 32px;
            opacity: 0.6;
            width: 1400px;
            height: 300px;
            position: relative;
            left: 250px;
            top: 100px;
            display: flex;
            box-sizing: border-box;
        }

        .boite{
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 3px 6px #00000029;
            border: 1px solid #70707029;
            border-radius: 20px;
            opacity: 1;
            flex: 1;
            width: 490px;
            height: 200px;
            margin-left: 50px;
            position: relative;
            top: 15%;




        }
        .pilote{
            width: 400px;
            height: 50px;
            background-color: #058147;
            margin-left: 5px;
            border-radius: 13px;
            position: absolute;
            top: -23px;
            left: 0;
            box-shadow: 0px 3px 6px #00000029;
            border: 1px solid #70707029;
            margin-bottom: auto;


        }
        .pilote p{
            text-align: left;
            font: normal normal normal 22px/27px Roboto;
            color: #FFFFFF;
            opacity: 1;
            position: absolute;
            left: 28%;
            top: -15%;

        }
        .boite h2{

            vertical-align: middle;
            text-align: center;
            margin-bottom: auto;
            font: normal normal normal 50px/61px Roboto;
            color: #585859;
            opacity: 1;
            margin-top: 20%;


        }

        /*bas de page */
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
            left: 250px;
            top: 450px;
            width: 1440px;
            height: 440px;
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




    </style>

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
        <div class="menu-item green-bg" onclick="location.href='{{ route('dashboard') }}'">
            <img id="dashboard" class="logo" alt="" src="{{ asset('images/dashboard.png') }}">
            <h3>Dashboard</h3>
        </div>

        <div class="menu-item" onclick="location.href='{{ route('top_final') }}'">
            <img id="final" class="logo" alt="" src="{{ asset('images/pilot_list.png') }}">
            <h3>Resultat final</h3>
        </div>
        <div class="menu-item " onclick="location.href='{{ route('creer_pilote') }}'">
            <img id="pilote" class="logo" alt="" src="{{ asset('images/list_user.png') }}">
            <h3>Creer un pilote</h3>
        </div>
        <div class="menu-item" onclick="location.href='{{ route('resultat_laps') }}'">
            <img id="lap" class="logo" alt=""  src="{{ asset('images/lap_result.png') }}">
            <h3>resultat lap</h3>
        </div>
        <div class="menu-item" onclick="location.href='{{ route('map') }}'">
            <img id="time" class="logo" alt="" src="{{ asset('images/compteur_vitesse.png') }}">
            <h3>real Time</h3>
        </div>
        <div class="menu-item" onclick="location.href='{{ route('resultat_special') }}'">
            <img id="special"class="logo" alt="" src="{{ asset('images/special_result.png') }}">
            <h3>Resultat Special</h3>
        </div>

        <div id="down">
            <img id="5" alt="" src="{{ asset('images/logo1.png') }}">

        </div>

    </div>

    <div class="minibox">

        <div class="boite">
            <div class="pilote">
                <p>Nombre de pilote</p>
            </div>
            <h2>18</h2>
        </div>

        <div class="boite">
            <div class="pilote">
                <p>Distance Total</p>
            </div>
            <h2>108km</h2>
        </div>

        <div class="boite">
            <div class="pilote">
                <p>Durée Total</p>
            </div>
            <h2>6h 45min 05</h2>
        </div>

    </div>

    <div id="box">
        <div id="subtitle">
            <div id="left">
                <img id="sublogo" class="logo" alt="" src="{{ asset('images/Groupe 480.png') }}">
                <p class="title" id="title2"> Liste des pilotes </p>
            </div>
            <div id="right">
                <div class="small-box" id="refresh-box"></div>
                <div class="small-box" id="close-box"></div>
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

            <tbody>
            <tr>
                <td>
                    <div class="ellipse ellipse1"></div>
                    <div class="ellipse ellipse2"></div>
                </td>
                <td> Olivier Ramdam</td>
                <td> OPEL</td>
                <td> LT 705454-X</td>
                <td class="actions">
                    <div class="action action1">Début Course</div>
                    <div class="action action2">Fin Course</div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="ellipse ellipse1"></div>
                    <div class="ellipse ellipse2"></div>
                </td>
                <td> Christelle Wamou</td>
                <td> BUGATI</td>
                <td> LT 705454-X</td>
                <td class="actions">
                    <div class="action action1">Début Course</div>
                    <div class="action action2">Fin Course</div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="ellipse ellipse1"></div>
                    <div class="ellipse ellipse2"></div>
                </td>
                <td> Rian Cober</td>
                <td> WOLVAGEN</td>
                <td> LT 705454-X</td>
                <td class="actions">
                    <div class="action action1">Début Course</div>
                    <div class="action action2">Fin Course</div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="ellipse ellipse1"></div>
                    <div class="ellipse ellipse2"></div>
                </td>
                <td> Brian Epee</td>
                <td> BMW</td>
                <td> LT 705454-X</td>
                <td class="actions">
                    <div class="action action1">Début Course</div>
                    <div class="action action2">Fin Course</div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="ellipse ellipse1"></div>
                    <div class="ellipse ellipse2"></div>
                </td>
                <td> Rian Tinen</td>
                <td> PEUGEOT</td>
                <td> LT 705454-X</td>
                <td class="actions">
                    <div class="action action1">Début Course</div>
                    <div class="action action2">Fin Course</div>
                </td>
            </tr>



        </table>
    </div>

    </div>


</body>
</html>
