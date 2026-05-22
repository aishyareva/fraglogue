<?php
$host = "localhost"; 
$user = "root";      
$pass = "";          
$db   = "db_fraglogue"; 

$koneksi = mysqli_connect($host, $user, $pass, $db); // [cite: 81, 82]

if (!$koneksi) { 
    die("Koneksi ke database gagal: " . mysqli_connect_error()); // [cite: 84, 93]
}

function fetchFragellaAPI($endpoint, $perfume_id = null) {
    $apiKey = "FRAGELLA_MOCK_SECRET_KEY_2026"; 
    $base_url = "https://api.fragella.com/v1"; 
    
    if ($perfume_id) {
        return [
            'status' => 'success',
            'image_fallback' => 'https://images.unsplash.com/photo-1541643600914-78b084683601?w=500'
        ];
    }
    return [];
}
?>