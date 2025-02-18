<?php

/**
 * Lokasi didapatkan dari data BMKG
 */

include "Medoo.php";

use Medoo\Medoo;

$db = new Medoo([
    'type' => 'mysql',
    'host' => 'localhost',
    'database' => 'wilayah_indonesia',
    'username' => 'wilayah',
    'password' => 'indonesia',
]);

// provinsi
$data = $db->select("t_provinsi", ['id', 'nama', 'latitude', 'longitude'], ['latitude' => 0, 'longitude' => 0]);
foreach ($data as $d) {
    $url = "https://api.bmkg.go.id/publik/prakiraan-cuaca?adm1=" . $d['id'];
    echo "get $url\n";
    $bmkg = file_get_contents($url);
    $bmkg = json_decode($bmkg, true);
    if (!empty($bmkg['lokasi']['lat'])) {
        echo $d['nama'] . " latitude " . $bmkg['lokasi']['lat'] . ", longitude " . $bmkg['lokasi']['lon'] . "\n";
        $db->update("t_provinsi", ['latitude' => $bmkg['lokasi']['lat'], 'longitude' => $bmkg['lokasi']['lon']], ['id' => $d['id']]);
        if (count($bmkg['data']) > 0) {
            foreach ($bmkg['data'] as $sd) {
                if (!empty($sd['lokasi']['lat'])) {
                    $id = numeric($sd['lokasi']['adm2']);
                    echo "$id " . $sd['lokasi']['provinsi'] . ", " . $sd['lokasi']['kotkab'] . " latitude " . $sd['lokasi']['lat'] . ", longitude " . $sd['lokasi']['lon'] . "\n";
                    $db->update("t_kota", ['latitude' => $sd['lokasi']['lat'], 'longitude' => $sd['lokasi']['lon']], ['id' => $id]);
                }
            }
        }
    }
}


// kota
$data = $db->select("t_kota", ['id', 'nama', 'latitude', 'longitude'], ['latitude' => 0, 'longitude' => 0]);
foreach ($data as $d) {
    $url = "https://api.bmkg.go.id/publik/prakiraan-cuaca?adm2=" . substr($d['id'], 0, 2) . '.' . substr($d['id'], 2, 2);
    echo "$d[id] get $url\n";
    $bmkg = file_get_contents($url);
    $bmkg = json_decode($bmkg, true);
    if (!empty($bmkg['lokasi']['lat'])) {
        echo $d['nama'] . " latitude " . $bmkg['lokasi']['lat'] . ", longitude " . $bmkg['lokasi']['lon'] . "\n";
        $db->update("t_kota", ['latitude' => $bmkg['lokasi']['lat'], 'longitude' => $bmkg['lokasi']['lon']], ['id' => $d['id']]);
        if (count($bmkg['data']) > 0) {
            foreach ($bmkg['data'] as $sd) {
                if (!empty($sd['lokasi']['lat'])) {
                    $id = numeric($sd['lokasi']['adm3']);
                    echo "$id " . $sd['lokasi']['provinsi'] . ", " . $sd['lokasi']['kotkab'] . ", " . $sd['lokasi']['kecamatan'] . " latitude " . $sd['lokasi']['lat'] . ", longitude " . $sd['lokasi']['lon'] . "\n";
                    $db->update("t_kecamatan", ['latitude' => $sd['lokasi']['lat'], 'longitude' => $sd['lokasi']['lon']], ['id' => $id]);
                }
            }
        }
    }
}

// kecamatan
$data = $db->select("t_kecamatan", ['id', 'nama', 'latitude', 'longitude'], ['latitude' => 0, 'longitude' => 0]);
foreach ($data as $d) {
    $url = "https://api.bmkg.go.id/publik/prakiraan-cuaca?adm3=" . substr($d['id'], 0, 2) . '.' . substr($d['id'], 2, 2) . '.' . substr($d['id'], 4, 2);
    echo "$d[id] get $url\n";
    $bmkg = file_get_contents($url);
    $bmkg = json_decode($bmkg, true);
    if (!empty($bmkg['lokasi']['lat'])) {
        echo $d['nama'] . " latitude " . $bmkg['lokasi']['lat'] . ", longitude " . $bmkg['lokasi']['lon'] . "\n";
        $db->update("t_kecamatan", ['latitude' => $bmkg['lokasi']['lat'], 'longitude' => $bmkg['lokasi']['lon']], ['id' => $d['id']]);
        if (count($bmkg['data']) > 0) {
            foreach ($bmkg['data'] as $sd) {
                if (!empty($sd['lokasi']['lat'])) {
                    $id = numeric($sd['lokasi']['adm4']);
                    echo "$id " . $sd['lokasi']['provinsi'] . ", " . $sd['lokasi']['kotkab'] . ", " . $sd['lokasi']['kecamatan'] . ", " . $sd['lokasi']['kelurahan'] . " latitude " . $sd['lokasi']['lat'] . ", longitude " . $sd['lokasi']['lon'] . "\n";
                    $db->update("t_kelurahan", ['latitude' => $sd['lokasi']['lat'], 'longitude' => $sd['lokasi']['lon']], ['id' => $id]);
                }
            }
        }
    }
}
die();


// kelurahan
$data = $db->select("t_kelurahan", ['id', 'nama', 'latitude', 'longitude'], ['latitude' => 0, 'longitude' => 0]);
foreach ($data as $d) {
    $url = "https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4=" . substr($d['id'], 0, 2) . '.' . substr($d['id'], 2, 2) . '.' . substr($d['id'], 4, 2) . '.' . substr($d['id'], 6);
    echo "$d[id] get $url\n";
    $bmkg = file_get_contents($url);
    $bmkg = json_decode($bmkg, true);
    if (!empty($bmkg['lokasi']['lat'])) {
        echo $d['nama'] . " latitude " . $bmkg['lokasi']['lat'] . ", longitude " . $bmkg['lokasi']['lon'] . "\n";
        $db->update("t_kelurahan", ['latitude' => $bmkg['lokasi']['lat'], 'longitude' => $bmkg['lokasi']['lon']], ['id' => $d['id']]);
    }
}


//function alphanumeric
function alphanumeric($string)
{
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}

// function numeric only
function numeric($string)
{
    return preg_replace('/[^0-9]/', '', $string);
}
