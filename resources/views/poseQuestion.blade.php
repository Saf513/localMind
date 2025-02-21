<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <style>
        .form-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: linear-gradient(145deg, #ffffff, #f5f5f5);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
            outline: none;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        #map {
            height: 400px;
            width: 100%;
            border-radius: 10px;
            margin: 1rem 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .search-container {
            position: relative;
            margin-bottom: 1rem;
        }

        #searchResults {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
        }

        .search-result {
            padding: 0.75rem;
            cursor: pointer;
            transition: background-color 0.2s;
            border-bottom: 1px solid #f0f0f0;
        }

        .search-result:hover {
            background-color: #f5f5f5;
        }

        .location-details {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
        }

        .section-title {
            font-size: 1.25rem;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e1e1e1;
        }

        .suggestion-tag {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            margin: 0.25rem;
            background: #e1e1e1;
            border-radius: 20px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .suggestion-tag:hover {
            background: #d1d1d1;
        }

        .suggestions-container {
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form  method="POST" action="{{ route('store')}}" id="luxuryForm">
            @csrf
            <!-- Section Question -->
            <div class="form-group">
                <h2 class="section-title">Votre Question</h2>
                <label class="form-label">Titre de la question</label>
                <input type="text" class="form-control" id="questionTitle" name="questionTitle" placeholder="Entrez le titre de votre question " required>
            </div>

            <div class="form-group">
                <label class="form-label">Détails de la question</label>
                <textarea class="form-control" id="questionDetails" name="questionDetails" placeholder="Décrivez votre question en détail..." required></textarea>
            </div>

            <!-- Section Localisation -->
            <h2 class="section-title">Localisation</h2>
            <div class="form-group">
                <label class="form-label">Rechercher un lieu</label>
                <div class="search-container">
                    <input type="text" id="searchInput" class="form-control" placeholder="Commencez à taper un lieu...">
                    <div id="searchResults"></div>
                    <div class="suggestions-container">
                        <div class="suggestion-tag">Paris</div>
                        <div class="suggestion-tag">Lyon</div>
                        <div class="suggestion-tag">Marseille</div>
                        <div class="suggestion-tag">Bordeaux</div>
                        <div class="suggestion-tag">Toulouse</div>
                    </div>
                </div>
            </div>

            <div id="map"></div>

            <div class="location-details">
                <div class="form-group">
                    <label class="form-label">Adresse sélectionnée</label>
                    <input type="text" id="location_display" class="form-control" readonly>
                </div>
                
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
                <input type="hidden" id="location_name" name="location_name">
                <button type="submit">creer</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configuration de la carte
            var map = L.map('map', {
                center: [46.2276, 2.2137],
                zoom: 6,
                zoomControl: true
            });

            // Tuiles OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);

            // Marker
            var marker = L.marker([46.2276, 2.2137], {
                draggable: true
            }).addTo(map);

            // Gestion des suggestions
            document.querySelectorAll('.suggestion-tag').forEach(tag => {
                tag.addEventListener('click', function() {
                    searchInput.value = this.textContent;
                    searchLocation(this.textContent);
                });
            });

            // Fonction de recherche
            const searchInput = document.getElementById('searchInput');
            const searchResults = document.getElementById('searchResults');

            function searchLocation(query) {
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${query}&limit=5`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            const result = data[0];
                            const lat = parseFloat(result.lat);
                            const lon = parseFloat(result.lon);
                            marker.setLatLng([lat, lon]);
                            map.setView([lat, lon], 13);
                            updateLocationDetails(lat, lon);
                        }
                    });
            }

            searchInput.addEventListener('input', debounce(function() {
                if (this.value.length < 3) {
                    searchResults.innerHTML = '';
                    return;
                }

                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${this.value}&limit=5`)
                    .then(response => response.json())
                    .then(data => {
                        searchResults.innerHTML = '';
                        data.forEach(result => {
                            const div = document.createElement('div');
                            div.className = 'search-result';
                            div.textContent = result.display_name;
                            div.addEventListener('click', () => {
                                const lat = parseFloat(result.lat);
                                const lon = parseFloat(result.lon);
                                marker.setLatLng([lat, lon]);
                                map.setView([lat, lon], 13);
                                updateLocationDetails(lat, lon);
                                searchResults.innerHTML = '';
                                searchInput.value = result.display_name;
                            });
                            searchResults.appendChild(div);
                        });
                    });
            }, 300));

            // Fonction de mise à jour des détails
            function updateLocationDetails(lat, lon) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lon;

                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
                    .then(response => response.json())
                    .then(data => {
                        const locationName = data.display_name || 'Localisation non identifiée';
                        document.getElementById('location_name').value = locationName;
                        document.getElementById('location_display').value = locationName;
                    })
                    .catch(error => {
                        console.error('Erreur de géocodage:', error);
                    });
            }

            // Événements de la carte
            marker.on('dragend', function(event) {
                const position = marker.getLatLng();
                updateLocationDetails(position.lat, position.lng);
            });

            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                updateLocationDetails(e.latlng.lat, e.latlng.lng);
                map.setView(e.latlng, map.getZoom());
            });

            // Fonction utilitaire debounce
            function debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func.apply(this, args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }

            // Mise à jour initiale
            updateLocationDetails(46.2276, 2.2137);
        });
    </script>
</body>
</html>