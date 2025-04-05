<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">





<div class="calendar-container container-fluid" id="calendarToExport">
    <div class="button-group">
        <div class="header-controls d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
            <!-- Nouveau wrapper pour les boutons -->
            <div class="d-flex flex-column flex-md-row align-items-center mr-md-3">
                <div class="theme-controls position-static position-md-relative mb-2 mb-md-0 mr-md-2 mt-2">
                    <!-- Votre sélecteur existant -->
                    <select id="themeSelector" class="theme-selector form-control" onchange="toggleTheme(this.value)">
                        <option value="dark">Thème Original</option>
                        <option value="barbie">Thème Barbie</option>
                        <option value="forest">Thème Forêt</option>
                        <option value="cyberpunk">Thème Cyberpunk</option>
                        <option value="midnight-blue">Nuit Bleue</option>
                        <option value="sunrise"> Sunrise</option>
                    </select>
                </div>

                <!-- Déplacement du bouton export dans ce wrapper -->
                <div id="exportButtonWrapper" class="mt-2 mt-md-0">
                    <button id="exportButton" onclick="exportToPNG()" class="export-button btn btn-primary mt-2">
                        <i class="bi bi-download"></i>
                    </button>

                </div>
                <button id="whatsappButton" onclick="exportAndShareWhatsApp()"
                    class="export-button btn btn-success mt-2">
                    <i class="bi bi-whatsapp"></i>
                </button>
            </div>

            <!-- Conteneur semaine inchangé -->
            <div class="week-header d-flex flex-column flex-md-row align-items-center w-100 mt-2 mt-md-0">
                <h2 class="mb-0 mr-md-3">{{ $weekLabel }}</h2>
            </div>
        </div>
    </div>

    <div class="calendar-grid">
        @php
            $daysOfWeek = [
                'LUNDI' => $days['monday']->format('Y-m-d'),
                'MARDI' => $days['tuesday']->format('Y-m-d'),
                'MERCREDI' => $days['wednesday']->format('Y-m-d'),
                'JEUDI' => $days['thursday']->format('Y-m-d'),
                'VENDREDI' => $days['friday']->format('Y-m-d'),
            ];
            $events = collect($events)->groupBy('date');
        @endphp

        <div class="calendar-row row no-gutters">
            @foreach ($daysOfWeek as $dayName => $date)
                @php
                    $dayNumber = Carbon\Carbon::parse($date)->isoFormat('D');
                @endphp

                <div class="calendar-cell col border-right">
                    <div class="day-header p-3">
                        <div class="day-name h5">{{ $dayName }}</div>
                        <div class="day-number display-4">{{ $dayNumber }}</div>
                    </div>

                    <div class="events-container p-3">
                        @if ($events->has($date))
                            @foreach ($events[$date] as $event)
                                <div class="event-item mb-3">
                                    <div class="event-titre font-weight-bold">{{ $event['titre'] }}</div>
                                    <div class="event-date ">{{ $event['timeAndLocation'] }}</div>
                                    @if (!empty($event['description']))
                                        <div class="event-description small">{{ $event['description'] }}</div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>








<style>
    .header-controls {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        /* Espace entre les éléments */
    }


    .theme-controls,
    .week-header {
        display: flex;
        align-items: center;
    }

    .theme-selector {
        margin-right: 10px;
        /* Pour séparer le sélecteur du bouton */
    }

    .export-button {
        padding: 5px 10px;
        margin-left: 10px;
        /* Pour séparer du label de la semaine */
        cursor: pointer;
    }



    /* Ajouts/modifications pour le menu déroulant */
    .theme-controls {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 1000;
    }

    .theme-selector {
        padding: 8px 35px 8px 15px;
        border: none;
        border-radius: 25px;
        background-color: var(--button-bg);
        color: white;
        font-weight: bold;
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white'%3e%3cpath d='M7 10l5 5 5-5z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 12px;
        transition: all 0.3s ease;
        font-size: 0.9em;
    }

    .theme-selector:hover {
        background-color: var(--button-hover);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .theme-selector option {
        background-color: var(--header-bg);
        color: var(--text-color);
        padding: 10px;
    }









    :root {
        /* Variables par défaut - Thème Original */
        --bg-color: #4a4a4a;
        --header-bg: #8B4513;
        --day-header-bg: #333;
        --event-bg: #555;
        --text-color: #ffffff;
        --accent-color: #ffa500;
        --border-color: #666;
        --button-bg: #8B4513;
        --button-hover: #8B4513;
    }

    /* Thème Barbie */
    .theme-barbie {
        --bg-color: #ff69b4;
        --header-bg: #ff1493;
        --day-header-bg: #ff85c2;
        --event-bg: #ffb6c1;
        --text-color: #8a1041;
        --accent-color: #ffffff;
        --border-color: #ff007f;
        --button-bg: #ff007f;
        --button-hover: #ff0055;
    }

    /* Thème Forêt */
    .theme-forest {
        --bg-color: #2d5a27;
        --header-bg: #4a752c;
        --day-header-bg: #617c42;
        --event-bg: #a3be8c;
        --text-color: #e8f5e9;
        --accent-color: #c8e6c9;
        --border-color: #3b5249;
        --button-bg: #4CAF50;
        --button-hover: #45a049;
    }

    /* Thème Cyberpunk */
    .theme-cyberpunk {
        --bg-color: #1e1e1e;
        /* Fond global sombre mais doux */
        --header-bg: #3a3a3a;
        /* En-tête sobre et élégant */
        --day-header-bg: #2d2d2d;
        /* Fond des jours légèrement plus clair */
        --event-bg: #4a90e2;
        /* Bleu professionnel pour les événements */
        --text-color: #f5f5f5;
        /* Texte clair et lisible */
        --accent-color: #0d0e0f;
        /* Bleu accentué pour attirer l'attention */
        --border-color: #3a3a3a;
        /* Bordure discrète et moderne */
        --button-bg: #005f99;
        /* Bouton avec un bleu plus foncé */
        --button-hover: #004d7a;
        /* Effet de survol plus marqué */
    }

    /* Thème Midnight Blue */
    .theme-midnight-blue {
        --bg-color: #0f1a2f;
        --header-bg: #1a2f4f;
        --day-header-bg: #2a3f5f;
        --event-bg: #3a4f7f;
        --text-color: #c0d0ff;
        --accent-color: #ffd700;
        --border-color: #1a2f4f;
        --button-bg: #4a6fa5;
        --button-hover: #3a5f95;
    }

    /* Thème Sunrise */
    .theme-sunrise {
        --bg-color: linear-gradient(135deg, #ff7f50, #ffd700);
        --header-bg: #ff4500;
        --day-header-bg: #ff8c00;
        --event-bg: #fffacd;
        --text-color: #2f4f4f;
        --accent-color: #ff4500;
        --border-color: #ff8c00;
        --button-bg: #ff4500;
        --button-hover: #cc3700;
    }

    .calendar-container {
        background: var(--bg-color);
        color: var(--text-color);
        padding: 20px;
        font-family: 'Arial', sans-serif;
        transition: all 0.5s ease;
        position: relative;
    }

    .theme-controls {
        position: absolute;
        top: 20px;
        right: 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        z-index: 1000;
        max-width: 300px;
    }

    .theme-button {
        padding: 8px 15px;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.3s ease;
        background: var(--button-bg, #28a745);
        color: white;
        font-size: 0.9em;
        border: 2px solid transparent;
    }

    .theme-button:hover {
        transform: scale(1.05);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        background: var(--button-hover, #218838);
    }

    .week-header {
        background: var(--header-bg);
        padding: 15px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .calendar-grid {
        border: 2px solid var(--border-color);
        border-radius: 8px;
        overflow: hidden;
    }

    .calendar-row {
        display: flex;
        width: 100%;
    }

    .calendar-cell {
        flex: 1;
        border-right: 2px solid var(--border-color);
        min-height: 250px;
        background: rgba(255, 255, 255, 0.05);
    }

    .calendar-cell:last-child {
        border-right: none;
    }

    .day-header {
        background: var(--day-header-bg);
        padding: 15px;
        border-bottom: 2px solid var(--border-color);
    }

    .day-name {
        font-weight: bold;
        font-size: 1.3em;
        text-transform: uppercase;
    }

    .day-number {
        font-size: 2.5em;
        font-weight: 900;
        text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
    }

    .events-container {
        padding: 15px;
    }

    .event-item {
        background: var(--event-bg);
        margin-bottom: 12px;
        padding: 12px;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
    }

    .event-item:hover {
        transform: translateX(5px);
    }

    .event-date {
        color: var(--accent-color);
        font-weight: 700;
        font-size: 0.95em;
        margin-bottom: 8px;
    }

    .event-titre {
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 1.1em;
    }

    .event-description {
        font-size: 0.9em;
        line-height: 1.4;
        color: var(--text-color);
        opacity: 0.9;
    }

    .export-button {
        background: var(--button-bg);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 30px;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1em;
    }

    .export-button:hover {
        background: var(--button-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
</style>

<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>
    // Gestion des thèmes
    function toggleTheme(theme) {
        const container = document.querySelector('.calendar-container');

        // Retirer toutes les classes de thème
        ['dark', 'barbie', 'forest', 'cyberpunk', 'midnight-blue', 'sunrise'].forEach(t => {
            container.classList.remove(`theme-${t}`);
        });

        // Appliquer le nouveau thème si différent de dark
        if (theme !== 'dark') {
            container.classList.add(`theme-${theme}`);
        }

        // Sauvegarder dans localStorage
        localStorage.setItem('calendarTheme', theme);

        // Mettre à jour le sélecteur
        document.getElementById('themeSelector').value = theme;
    }

    // Charger le thème au démarrage
    window.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('calendarTheme') || 'dark';
        toggleTheme(savedTheme);
    });

    // Export PNG
    function exportToPNG() {
        const element = document.getElementById('calendarToExport');
        const exportButton = document.getElementById('exportButton');

        exportButton.style.opacity = '0';
        exportButton.style.pointerEvents = 'none';

        html2canvas(element, {
            scale: 2,
            useCORS: true,
            logging: false,
            backgroundColor: null,
            onclone: (clonedDoc) => {
                clonedDoc.getElementById('whatsappButton').style.display = 'none';
                clonedDoc.getElementById('exportButton').style.display = 'none';
                clonedDoc.querySelector('.theme-controls').style.display = 'none';
            }
        }).then(canvas => {
            const link = document.createElement('a');
            const dateString = new Date().toLocaleDateString('fr-FR').replaceAll('/', '-');
            link.download = `Agenda-${dateString}.png`;
            link.href = canvas.toDataURL('image/png');
            link.click();

            exportButton.style.opacity = '1';
            exportButton.style.pointerEvents = 'auto';
        }).catch(error => {
            console.error('Erreur:', error);
            exportButton.style.opacity = '1';
            exportButton.style.pointerEvents = 'auto';
        });
    }



    //envoyer sur whatsapp
    function exportAndShareWhatsApp() {
        const element = document.getElementById('calendarToExport');

        // Cacher les boutons pendant la capture
        document.getElementById('themeSelector').style.display = 'none';
        document.getElementById('exportButton').style.display = 'none';
        document.getElementById('whatsappButton').style.display = 'none';

        html2canvas(element, {
                scale: 2,
                useCORS: true,
                backgroundColor: null
            })
            .then(canvas => {
                // Réafficher les boutons
                document.getElementById('themeSelector').style.display = 'inline-block';
                document.getElementById('exportButton').style.display = 'inline-block';
                document.getElementById('whatsappButton').style.display = 'inline-block';

                // Convertir l'image en base64
                const imageData = canvas.toDataURL("image/png");

                // Créer un blob à partir de l'image
                fetch(imageData)
                    .then(res => res.blob())
                    .then(blob => {
                        const file = new File([blob], "calendrier.png", {
                            type: "image/png"
                        });

                        // Vérifier si Web Share API est supportée
                        if (navigator.canShare && navigator.canShare({
                                files: [file]
                            })) {
                            navigator.share({
                                files: [file],
                                title: "Calendrier",
                                text: "Voici le calendrier exporté.",
                            }).catch(error => console.log("Erreur de partage :", error));
                        } else {
                            alert("Votre navigateur ne supporte pas le partage d'images.");
                        }
                    });
            });
    }
</script>
