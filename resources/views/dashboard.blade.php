@extends('layouts.app')
@section('title', 'Créer Pilote')
@section('content')
    @include('layouts.components.mini-box')

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
            @foreach($coureurs as $coureur)
                <div class="ellipse ellipse1"></div>
                <div class="ellipse ellipse2"></div>
                </td>
                <td>{{ $coureur->nom_conducteur }}</td>
                <td>{{ $coureur->marque }}</td>
                <td>{{ $coureur->nom_vehicule }}</td>
                <td class="actions">
                    <div class="action action1">Début Course</div>
                    <div class="action action2">Fin Course</div>
                        <button class="action action3" onclick="window.location.href='/delete/{{ $coureur->id }}'">Supprimer</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- Ajoutez ici les liens de pagination fournis par Laravel -->
        {{ $coureurs->links() }}
    </div>


@endsection
