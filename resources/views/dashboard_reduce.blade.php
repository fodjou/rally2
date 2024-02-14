@extends('layouts.app')

@section('title', 'dashboard_reduce')

@section('content')
    <div id="main">

        <a href="{{ route('dashboard') }}">
            <img id="bin" alt="" src="{{ asset('images/menu.png') }}">
        </a>

        @include('layouts.components.mini-box')

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
                        <a href="{{route('dashboard-detail')}}">
                            <img src= "{{ asset('images/expand(1).png') }}" alt="Image 2">
                        </a>
                </div>
            </div>

            <table>
                <thead>
                <tr>
                    <th></th>
                    <th>Pilotes</th>
                    <th>Marques</th>
                    <th>Véhicules</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($coureurs as $coureur)
                    <tr>
                        <td>
                            <img class="ellipse ellipse1" src="{{ asset('images/'.$coureur->image) }}">
                            <img class="ellipse ellipse2" src="{{ asset('images/'.$coureur->logo) }}">
                        </td>
                        <td>{{ $coureur->nom_conducteur }}</td>
                        <td>{{ $coureur->marque }}</td>
                        <td>{{ $coureur->nom_vehicule }}</td>
                        <td class="actions">
                            <div class="action action1">Début Course</div>
                            <div class="action action2">Fin Course</div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Ajoutez ici les liens de pagination fournis par Laravel -->
            {{ $coureurs->links() }}
        </div>

    </div>
@endsection

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
