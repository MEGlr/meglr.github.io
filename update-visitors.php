<?php
// Get visitor data from the request (simulating fetching location from frontend)
$visitorLat = isset($_GET['lat']) ? $_GET['lat'] : null;
$visitorLon = isset($_GET['lon']) ? $_GET['lon'] : null;
$visitorCity = isset($_GET['city']) ? $_GET['city'] : 'Unknown';
$visitorCountry = isset($_GET['country']) ? $_GET['country'] : 'Unknown';

if ($visitorLat && $visitorLon) {
    // Read the existing visitors.json file
    $data = file_get_contents('visitors.json');
    $visitors = json_decode($data, true);

    // Add the new visitor
    $visitors[] = [
        'lat' => $visitorLat,
        'lon' => $visitorLon,
        'city' => $visitorCity,
        'country' => $visitorCountry
    ];

    // Write back to visitors.json
    file_put_contents('visitors.json', json_encode($visitors, JSON_PRETTY_PRINT));
}

// Output the visitors JSON file content for the frontend
header('Content-Type: application/json');
echo file_get_contents('visitors.json');
?>
