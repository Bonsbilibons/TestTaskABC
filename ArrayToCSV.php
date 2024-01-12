<?php


$data = [
    [
        'country_name' => 'USA',
        'country_code' => 'US',
        'city_name' => 'New York',
        'lat' => '40.7127753',
        'lng' => '-74.0059728',
    ],
    [
        'country_name' => 'USA',
        'country_code' => 'US',
        'city_name' => 'Los Angeles',
        'lat' => '34.0522342',
        'lng' => '-118.2436849',
    ],
    [
        'country_name' => 'Philippines',
        'country_code' => 'PH',
        'city_name' => 'Manila',
        'lat' => '14.5995124',
        'lng' => '120.9842195',
    ],
    [
        'country_name' => 'Philippines',
        'country_code' => 'PH',
        'city_name' => 'Cebu',
        'lat' => '10.3156993',
        'lng' => '123.8854377',
    ]
];

$fp = fopen('output.csv', 'w');
fputcsv($fp, ['Country name', 'Country code', 'Lat', 'Long']);

foreach ($data as $row) {
    fputcsv($fp, $row);
}

fclose($fp);


//$fp = fopen('output.csv', 'w');
//fputcsv($fp, ['Country name', 'Country code', 'City name', 'Lat', 'Long']);
//foreach ($data as $row) {
//    fputcsv($fp, [
//        $row['country_name'],
//        $row['country_code'],
//        $row['city_name'],
//        $row['lat'],
//        $row['lng'],
//    ]);
//}
//fclose($fp);