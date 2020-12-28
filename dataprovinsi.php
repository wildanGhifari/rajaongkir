<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
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
    $dataProvinsi = $array_response["rajaongkir"]["results"];

    echo "<option value=''>Pilih Provinsi</option>";

    foreach ($dataProvinsi as $provinsi) {
        echo "<option value='" . $provinsi["province_id"] . "' id_provinsi='" . $provinsi["province_id"] . "'>";
        echo $provinsi["province"];
        echo "</option>";
    }
}
