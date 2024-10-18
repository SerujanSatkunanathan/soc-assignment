<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"> 
    <title>Country Info</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #121212; 
            color: #fff; 
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #1c1c1c; 
            padding: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            max-width: 800px;
            margin: 3rem auto;
        }

        h2 {
            text-align: center;
            font-size: 2rem;
            color: #ff9800; 
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        h3 {
            color: #ff9800; 
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .form-select {
            font-size: 1rem;
            padding: 0.75rem;
            border-radius: 5px;
            border: 1px solid #ff9800; 
            background-color: #333; 
            color: #fff; 
            transition: all 0.3s ease;
        }

        .form-select:hover {
            background-color: #444; 
            border-color: #ff9800; 
        }

        .form-select:focus {
            border-color: #ff9800; 
            box-shadow: 0 0 5px rgba(255, 152, 0, 0.5);
        }

        #countryInfo {
            margin-top: 2rem;
            padding: 1.5rem;
            background-color: #1c1c1c; 
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        #countryInfo img {
            display: block;
            margin: 1rem auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        #countryInfo p {
            font-size: 1rem;
            margin-bottom: 0.75rem;
        }

        #countryInfo p strong {
            color: #ff9800; 
        }

        #map {
            margin-top: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            h2 {
                font-size: 1.75rem;
            }

            h3 {
                font-size: 1.25rem;
            }

            iframe {
                width: 100%;
                height: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Select a Country</h2>
        <select class="form-select" id="countrySelect" onchange="fetchCountryInfo()">
        </select>
        
        <div class="row mt-4">
            <div class="col-md-6" id="countryInfo">
            </div>
            <div class="col-md-6">
                <iframe id="map" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('https://restcountries.com/v3.1/all')
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById('countrySelect');
                    data.forEach(country => {
                        const option = document.createElement('option');
                        option.value = country.cca2;
                        option.textContent = country.name.common;
                        select.appendChild(option);
                    });
                });
        });

        function fetchCountryInfo() {
            const country = document.getElementById('countrySelect').value;
            fetch(`https://restcountries.com/v3.1/alpha/${country}`)
                .then(response => response.json())
                .then(data => {
                    const countryData = data[0];
                    const capital = countryData.capital ? countryData.capital[0] : "N/A";
                    document.getElementById('countryInfo').innerHTML = `
                        <h3>${countryData.name.official}</h3>
                        <p><strong>Capital:</strong> ${capital}</p>
                        <p><strong>Region:</strong> ${countryData.region}</p>
                        <p><strong>Subregion:</strong> ${countryData.subregion}</p>
                        <p><strong>Population:</strong> ${countryData.population}</p>
                        <p><strong>Area:</strong> ${countryData.area} sq km</p>
                        <img src="${countryData.flags.svg}" width="200">`;
                    
                    document.getElementById('map').src = `https://www.google.com/maps/embed/v1/place?key=APIKEY=${countryData.latlng[0]},${countryData.latlng[1]}`;
                });
        }
    </script>
</body>
</html>
