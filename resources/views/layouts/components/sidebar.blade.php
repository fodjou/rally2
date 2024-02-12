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

        <div class="menu-item" onclick="location.href='{{ route('coureurs.top-final') }}'">
            <img id="final" class="logo" alt="" src="{{ asset('images/pilot_list.png') }}">
            <h3>Resultat final</h3>
        </div>
        <div class="menu-item " onclick="location.href='{{ route('coureurs.create') }}'">
            <img id="pilote" class="logo" alt="" src="{{ asset('images/list_user.png') }}">
            <h3>Creer un pilote</h3>
        </div>
        <div class="menu-item" onclick="location.href='{{ route('lapsResult') }}'">
            <img id="lap" class="logo" alt=""  src="{{ asset('images/lap_result.png') }}">
            <h3>resultat lap</h3>
        </div>
        <div class="menu-item" onclick="location.href='{{ route('Map') }}'">
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