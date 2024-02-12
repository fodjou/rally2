<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <style>

        /* Styles CSS */

        body {
            margin: 0;
            padding: 0;
        }


        .background-image {
            background: linear-gradient(178deg, #548F74 0%, #FFD892E0 62%, #FFF2DBF5 73%, #FFFFFF 100%),
            url({{ asset('images/background1.png') }}) no-repeat;
            position: absolute;
            background-size: cover;
            height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {

            background-color: rgb(255, 255, 255);
            padding: 20px;
            border-radius: 60px 0px 60px 10px;
            text-align: center;
            border: 1px solid #707070; /* Nouvelle couleur de bordure */
            top: 145px; /* Nouvelle position top */
            left: 612px; /* Nouvelle position left */
            width: 697px; /* Nouvelle largeur */
            height: 741px; /* Nouvelle hauteur*/

        }

        h1 {
            margin-top: 0;
        }

        img {
            top: 150px;
            left: 791px;
            width: 337px;
            height: 188px;
            opacity: 1;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            top: 590px;
            left: 714px;
            width: 515px;
            height: 71px;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #707070; /* Nouvelle couleur de bordure */
            border-radius: 36px;
        }

        button[type="submit"] {
            top: 590px;
            left: 714px;
            width: 515px;
            height: 71px;
            background-color: #548F74; /* Nouvelle couleur de fond */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 36px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #FF9800; /* Nouvelle couleur de fond au survol */
            top: 590px;
            left: 714px;
            width: 515px;
            height: 71px;
            border-radius: 36px;
        }

    </style>
</head>
<body>
<div class="background-image">

    <div class="form-container">
        <img src="{{ asset('images/logo1.png') }}" alt="Logo">
        <h1>login</h1>
        <form action="/" method="POST">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>


            <button type="submit">Connexion!</button>
        </form>
    </div>
</div>
</body>
</html>
