<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <title>China Provinces - COVID-19 Statistics</title>

    <style>
        
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #121212; 
            color: #ffffff; 
            margin: 0;
            padding: 0;
        }

       
        .container {
            background-color: #1e1e1e; 
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 1000px;
            margin: 3rem auto;
        }

        
        h2 {
            text-align: center;
            color: #ff9800; 
            font-weight: 700;
            margin-bottom: 2rem;
        }

        
        .china-logo {
            display: block;
            margin: 0 auto 1.5rem;
            width: 150px;
        }

        
        .table {
            background-color: #1e1e1e;
            color: #ffffff; 
            border: 1px solid #ff9800; 
        }

        .table th, .table td {
            border-color: #ff9800; 
            padding: 1rem;
        }

        .table thead th {
            background-color: #ff9800; 
            color: #121212; 
            text-align: center;
        }

        .table tbody td {
            text-align: center;
            font-weight: 500;
        }

        
        .table tbody tr:hover {
            background-color: #333333;
        }

        
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            .table th, .table td {
                padding: 0.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Provinces in China - COVID-19 Statistics</h2>
        <img class="china-logo" src="https://cdn2.hubspot.net/hub/70169/file-2581551965-jpg/china-feat.jpg" alt="China Flag"> <!-- China Flag -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Province</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                </tr>
            </thead>
            <tbody>
                <?php
               
                $url = 'https://covid-19-statistics.p.rapidapi.com/provinces?iso=CHN';
                $options = [
                    "http" => [
                        "header" => "X-RapidAPI-Key: cba10c0273msh04059d5b9f86f60p1a0869jsn188474ef4a24\r\n",
                    ]
                ];
                $context = stream_context_create($options);
                $response = file_get_contents($url, false, $context);
                $data = json_decode($response, true);
                
                foreach ($data['data'] as $province) {
                    echo "<tr>
                            <td>{$province['province']}</td>
                            <td>{$province['lat']}</td>
                            <td>{$province['long']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
