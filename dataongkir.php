<?php

$ekspedisi = $_POST["ekspedisi"];
$distrik = $_POST["distrik"];
$berat = $_POST["berat"];

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "origin=152&destination=" . $distrik . "&weight=" . $berat . "&courier=" . $ekspedisi,
    CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: cee127c76f3c96e79af0061cd32a3b5a"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    // dapatnya dalam bentuk JSON
    // Convert ke array
    $array_response = json_decode($response, true);
    $dataOngkir = $array_response["rajaongkir"]["results"]["0"]["costs"];

    echo "<option value=''>Paket Pengiriman</option>";

    foreach ($dataOngkir as $ongkir) {
        echo "<option
        paket='" . $ongkir["service"] . "'
        ongkir='" . $ongkir["cost"]["0"]["value"] . "'
        etd='" . $ongkir["cost"]["0"]["etd"] . "'
        >";
        echo $ongkir["service"] . " ";
        echo "Rp. " . number_format($ongkir["cost"]["0"]["value"], 0, ',', '.') . " ";
        echo $ongkir["cost"]["0"]["etd"];
        echo "</option>";
    }
}
