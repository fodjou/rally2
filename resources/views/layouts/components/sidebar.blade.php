<div id="slidbar" class="container">
        <header>
            <img id=profil alt="" src="{{ asset('images/profil_picture.png') }}">
            <h2 class="ti"> Bienvenue</h2>
            <h2 class="ti"><strong>{{Auth::user()->name}}</strong></h2>
            <hr>
            <div id="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="display: flex; justify-content: center">
                <img id="11" class="logo" alt="" src="{{ asset('images/sign_out.png') }}" style="margin-right: 10px"> Deconnexion!
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </header>
        <div class="menu-item green-bg" onclick="location.href='{{ route('dashboard') }}'" style="margin-left: 25px">
            <img class="logo" alt="" src="{{ asset('images/dashboard.png') }}" style="margin-right: 10px">Dashboard
        </div>

        <div class="menu-item" onclick="location.href='{{ route('coureurs.top-final') }}'" style="margin-left: 25px">
            <img class="logo" alt="" src="{{ asset('images/pilot_list.png') }}" style="width: 12%; margin-right: 10px">Resultat final
        </div>
        <div class="menu-item " onclick="location.href='{{ route('coureurs.create') }}'" style="margin-left: 25px">
            <img class="logo" alt="" src="{{ asset('images/list_user.png') }}" style="margin-right: 10px">Creer un pilote
        </div>
        <div class="menu-item" onclick="location.href='{{ route('lapsResult') }}'" style="margin-left: 25px">
            <img class="logo" alt=""  src="{{ asset('images/lap_result.png') }}" style="margin-right: 10px">resultat lap
        </div>
        <div class="menu-item" onclick="location.href='{{ route('Map') }}'" style="margin-left: 25px">
            <img class="logo" alt="" src="{{ asset('images/compteur_vitesse.png') }}" style="margin-right: 10px">real Time
        </div>
        <div class="menu-item" onclick="location.href='{{ route('resultat_special') }}'" style="margin-left: 25px">
            <img class="logo" alt="" src="{{ asset('images/special_result.png') }}" style="margin-right: 10px">Resultat Special
        </div>

        <div id="down">
            <img id="5" alt="" src="{{ asset('images/logo1.png') }}">

        </div>

    </div>
