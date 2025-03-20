@extends('layouts.layouts')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor mb-0 mt-0">Fiche de Projet</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">{{ $projet->nom_projet }} {{ $projet->chantier->acronyme }}</li>
            </ol>
        </div>
    </div>



    <section class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- En-tête cliquable amélioré -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <button class="btn btn-link text-dark p-0 position-relative overflow-hidden" type="button"
                        data-toggle="collapse" data-target="#projectDetails-{{ $projet->id }}" aria-expanded="true"
                        style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);">
                        <h4 class="m-0 animate__animated animate__fadeInLeft">
                            Détails du projet
                            <span class="toggle-icon" style="transition: transform 0.4s ease;">▼</span>
                        </h4>
                        <div class="hover-effect"
                            style="position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background: #007bff; transition: width 0.3s ease;">
                        </div>
                    </button>
                </div>

                <!-- Contenu pliable avec animations -->
                <div class="collapse show" id="projectDetails-{{ $projet->id }}"
                    style="transition: height 0.8s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.6s ease !important;">
                    <div class="card shadow-sm animate__animated animate__fadeInUp animate__faster"
                        style="transform: translateY(0); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <div class="card-body">
                            <!-- Animation du titre principal -->
                            <h2 class="animate__animated animate__fadeIn">{{ $projet->nom_projet }}</h2>

                            <!-- Dates avec animation en escalier -->
                            <div class="animate__animated animate__slideInRight">
                                <h5>
                                    <strong class="mr-5 pr-5">Date début : {{ $projet->date_debut_formatted }}</strong>
                                    <strong>Date fin : {{ $projet->date_fin_formatted }}</strong>
                                </h5>
                            </div>

                            <!-- Section Objectifs -->
                            <div class="animate__animated animate__fadeIn animate__delay-1s">
                                <h4><strong>OBJECTIFS :</strong></h4>
                                <p class="pop-in" style="opacity: 0; transform: translateY(20px);">{{ $projet->objectifs }}
                                </p>
                            </div>

                            <!-- Liste animée -->
                            <div class="animate__animated animate__fadeInLeft animate__delay-1s">
                                <h4><strong>SITUATION ACTUELLE :</strong></h4>
                                <ul class="staggered-list">
                                    @foreach (explode(';', $projet->situation_actuelle) as $index => $situation)
                                        <li class="animate__animated" style="opacity: 0; transform: translateX(-20px);">
                                            {{ trim($situation) }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Autre liste avec animation différente -->
                            <div class="animate__animated animate__fadeInUp animate__delay-2s">
                                <h4><strong><i class="fas fa-network-wired me-2"></i>PROCHAINES ÉTAPES :</strong></h4>
                                <div class="matrix-section mt-3">
                                    <ul class="network-list">
                                        @foreach (explode(';', $projet->prochaines_etapes) as $proch)
                                            <li class="node animate__animated">
                                                <div class="connection-line"></div>
                                                <div class="node-card bg-white p-3 rounded shadow-sm">
                                                    {{ trim($proch) }}
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('projet.detailJalonActivite')

    <style>
        /* Animation et style prochaines étapes*/
        .matrix-section {
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .network-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            position: relative;
        }

        .node {
            position: relative;
            list-style: none;
        }

        .node-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .connection-line {
            position: absolute;
            top: 50%;
            left: -25px;
            width: 25px;
            height: 2px;
            background: linear-gradient(90deg, #007bff 0%, #00b4ff 100%);
            opacity: 0.5;
            transition: all 0.3s ease;
        }

        .node:hover .node-card {
            transform: translateY(-3px) rotateZ(1deg);
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.15);
        }

        .node:hover .connection-line {
            width: 35px;
            left: -35px;
            opacity: 1;
        }

        @media (max-width: 768px) {
            .network-list {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .connection-line {
                height: 25px;
                width: 2px;
                top: -15px;
                left: 50%;
            }

            .node:hover .connection-line {
                height: 35px;
                top: -25px;
            }
        }




        /* Supprimer le soulignement du bouton */
        .btn.btn-link {
            text-decoration: none !important;
        }

        /* Supprimer le soulignement au hover/focus */
        .btn.btn-link:hover,
        .btn.btn-link:focus {
            text-decoration: none !important;
        }

        /* Animation personnalisée */
        @keyframes popIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .pop-in {
            animation: popIn 0.6s ease forwards;
            animation-delay: 0.8s;
        }

        .staggered-list li {
            animation: fadeInSlide 0.5s ease forwards;
        }

        @keyframes fadeInSlide {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Animation au survol */
        .card:hover {
            transform: translateY(-5px) !important;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
        }

        /* Rotation de l'icône */
        .collapsed .toggle-icon {
            transform: rotate(-90deg) !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animation des éléments de liste
            document.querySelectorAll('.staggered-list li').forEach((el, index) => {
                el.style.animationDelay = `${index * 0.15}s`;
                el.classList.add('animate__fadeIn');
            });

            // Animation du paragraphe
            document.querySelector('.pop-in').style.animationDelay = '0.6s';

            // Effet hover sur le bouton
            const buttons = document.querySelectorAll('[data-toggle="collapse"]');
            buttons.forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    this.querySelector('.hover-effect').style.width = '100%';
                });
                btn.addEventListener('mouseleave', function() {
                    this.querySelector('.hover-effect').style.width = '0';
                });
            });
        });
    </script>
@endsection
