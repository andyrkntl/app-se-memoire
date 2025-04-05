@extends('layouts.layouts')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor mb-0 mt-0">Fiche de Projet</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">AGENDA PREA</li>
            </ol>
        </div>
    </div>



    <div class="button-group">
        <!-- Redirection vers votre agenda personnalisé -->
        <a href="{{ route('google.redirect') }}" class="custom-button">
            Design Agenda
        </a>

        <button onclick="openGoogleCalendar()" class="custom-button">Ouvrir Google Agenda</button>
    </div>









    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item"
            src="https://calendar.google.com/calendar/embed?src=appsereforme%40gmail.com&ctz=Africa%2FNairobi"
            frameborder="0" scrolling="no"></iframe>
    </div>


    <style>
        iframe {
            width: 100%;
            height: 90vh;
            border: none;
        }

        .button-group {
            margin: 15px;
            display: flex;
            gap: 10px;
        }

        .custom-button {
            padding: 12px 20px;
            background-color: #4285F4;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .custom-button:hover {
            background-color: #3367D6;
            color: white;
        }
    </style>


    <script>
        function openGoogleCalendar() {
            window.open('https://calendar.google.com', '_blank');
        }
    </script>
@endsection
