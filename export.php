<?php

include "Medoo.php";

use Medoo\Medoo;

$db = new Medoo([
    'type' => 'mysql',
    'host' => 'localhost',
    'database' => 'wilayah_indonesia',
    'username' => 'wilayah',
    'password' => 'indonesia',
]);

$provs = $db->select("t_provinsi", ['id', 'nama', 'latitude', 'longitude'], ['ORDER' => ['id' => 'ASC']]);

file_put_contents("provinsi.json", json_encode($provs));
file_put_contents("propinsi.json", json_encode($provs));
echo "Provinsi data has been saved to provinsi.json and propinsi.json\n";

foreach($provs as $p) {
    echo "$p[id] $p[nama]\n";
    $kota = $db->select("t_kota", ['id', 'nama', 'latitude', 'longitude'], ['id[~]'=>$p['id'].'%', 'ORDER' => ['id' => 'ASC']]);
    file_put_contents("kota/$p[id].json", json_encode($kota));
    file_put_contents("kabupaten/$p[id].json", json_encode($kota));
    foreach ($kota as $k) {
        echo "$k[id] $k[nama]\n";
        $kecamatan = $db->select("t_kecamatan", ['id', 'nama', 'latitude', 'longitude'], ['id[~]'=>$k['id'].'%', 'ORDER' => ['id' => 'ASC']]);
        file_put_contents("kecamatan/$k[id].json", json_encode($kecamatan));
        foreach ($kecamatan as $kec) {
            echo "$kec[id] $kec[nama]\n";
            $kelurahan = $db->select("t_kelurahan", ['id', 'nama', 'latitude', 'longitude'], ['id[~]'=>$kec['id'].'%', 'ORDER' => ['id' => 'ASC']]);
            file_put_contents("kelurahan/$kec[id].json", json_encode($kelurahan));
        }
    }
}

$data = $db->select("t_kota", ['id', 'nama', 'latitude', 'longitude'], ['ORDER' => ['id' => 'ASC']]);
foreach ($data as $d) {
    echo "$d[id] $d[nama]\n";
    file_put_contents("kota/$d[id].json", json_encode($d));
    file_put_contents("kabupaten/$d[id].json", json_encode($d));
}
$data = $db->select("t_kecamatan", ['id', 'nama', 'latitude', 'longitude'], ['ORDER' => ['id' => 'ASC']]);
foreach ($data as $d) {
    echo "$d[id] $d[nama]\n";
    file_put_contents("kecamatan/$d[id].json", json_encode($d));
}
$data = $db->select("t_kelurahan", ['id', 'nama', 'latitude', 'longitude'], ['ORDER' => ['id' => 'ASC']]);
foreach ($data as $d) {
    echo "$d[id] $d[nama]\n";
    file_put_contents("kelurahan/$d[id].json", json_encode($d));
}